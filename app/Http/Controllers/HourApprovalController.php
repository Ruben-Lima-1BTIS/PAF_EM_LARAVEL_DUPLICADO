<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use App\Models\Hour;
use App\Models\User;

class HourApprovalController extends Controller
{
    private function isAuthorized(int $studentId): bool
    {
        return User::where('id', $studentId)
            ->where('role', 'student')
            ->whereHas('internships.company', fn($q) => $q->where('id', Auth::user()->company_id))
            ->exists();
    }

    private function formatHours(Collection $hours): string
    {
        $totalMinutes = $hours->sum(function ($hour) {
            [$h, $m] = explode(':', $hour->duration_hours);
            return ((int) $h * 60 + (int) $m);
        });

        return sprintf('%02d:%02d', intdiv($totalMinutes, 60), $totalMinutes % 60);
    }

    private function updateHourStatus(Hour $hour, string $status, ?string $comment = null): void
    {
        $hour->update([
            'status'                 => $status,
            'supervisor_reviewed_by' => Auth::id(),
            'supervisor_comment'     => $comment,
            'reviewed_at'            => now(),
        ]);
    }

    public function index(Request $request)
    {
        $user = Auth::user();

        $supervisedStudents = User::where('role', 'student')
            ->whereHas('internships.company', fn($q) => $q->where('id', $user->company_id))
            ->with('userClass.classModel')
            ->distinct()
            ->get();

        $cleanedStudents = $supervisedStudents->map(fn($s) => [
            'id'   => $s->id,
            'name' => $s->name . ' (' . ($s->userClass?->classModel?->sigla ?? 'No Class') . ')',
        ])->all();

        $selectedStudentId = $request->integer('student_id');
        $pendingHours      = collect();
        $approvedHours     = collect();
        $stats             = null;

        if ($selectedStudentId && $this->isAuthorized($selectedStudentId)) {
            $baseQuery = Hour::with(['student', 'internship'])->forStudent($selectedStudentId);

            $pendingHours  = (clone $baseQuery)->where('status', 'pending')->orderByDesc('date')->get();
            $approvedHours = (clone $baseQuery)->where('status', 'approved')->orderByDesc('reviewed_at')->get();
            $totalRejected = (clone $baseQuery)->where('status', 'rejected')->count();
            $allHours      = $baseQuery->get();

            $stats = [
                'student'            => User::find($selectedStudentId),
                'totalPending'       => $pendingHours->count(),
                'totalApproved'      => $approvedHours->count(),
                'totalRejected'      => $totalRejected,
                'totalHoursLogged'   => $this->formatHours($allHours),
                'approvedHoursCount' => $this->formatHours($approvedHours),
            ];
        }

        return view('supervisor.hours_approval.index', compact(
            'cleanedStudents',
            'selectedStudentId',
            'pendingHours',
            'approvedHours',
            'stats',
        ));
    }

    public function approve(int $id, Request $request)
    {
        $hour = Hour::find($id);

        if (!$hour)
            return back()->with('error', 'Hour not found');
        if (!$this->isAuthorized($hour->student_id))
            return back()->with('error', 'Not authorized');

        $this->updateHourStatus($hour, 'approved', $request->comment);

        return back()->with('success', 'Hour approved');
    }

    public function reject(int $id, Request $request)
    {
        $hour = Hour::find($id);

        if (!$hour)
            return back()->with('error', 'Hour not found');
        if (!$this->isAuthorized($hour->student_id))
            return back()->with('error', 'Not authorized');

        $request->validate(['comment' => 'nullable|string|max:1000']);

        $this->updateHourStatus($hour, 'rejected', $request->comment);

        return back()->with('success', 'Hour rejected');
    }
}