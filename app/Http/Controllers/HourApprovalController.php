<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Hour;
use App\Models\User;

class HourApprovalController extends Controller
{
    private function isAuthorized($studentId)
    {
        $companyId = Auth::user()->company_id;

        return User::where('id', $studentId)
            ->where('role', 'student')
            ->whereHas('internships.company', fn($q) => $q->where('id', $companyId))
            ->exists();
    }

    public function index(Request $request)
{
    $user = Auth::user();

    $supervisedStudents = User::where('role', 'student')
        ->whereHas('internships.company', fn ($q) => 
            $q->where('id', $user->company_id)
        )
        ->distinct()
        ->get();

    $selectedStudentId = $request->integer('student_id');

    $pendingHours = collect();
    $approvedHours = collect();
    $stats = null;

    if ($selectedStudentId && $this->isAuthorized($selectedStudentId)) {

        $baseQuery = Hour::with(['student', 'internship'])
            ->forStudent($selectedStudentId);

        $pendingHours = (clone $baseQuery)
            ->where('status', 'pending')
            ->orderByDesc('date')
            ->get();

        $approvedHours = (clone $baseQuery)
            ->where('status', 'approved')
            ->orderByDesc('reviewed_at')
            ->get();

        $totalRejected = (clone $baseQuery)
            ->where('status', 'rejected')
            ->count();

        $totalHoursLogged = (clone $baseQuery)
            ->sum('duration_hours');

        $approvedHoursCount = (clone $baseQuery)
            ->where('status', 'approved')
            ->sum('duration_hours');

        $student = User::find($selectedStudentId);

        $stats = [
            'student'            => $student,
            'totalPending'       => $pendingHours->count(),
            'totalApproved'      => $approvedHours->count(),
            'totalRejected'      => $totalRejected,
            'totalHoursLogged'   => round($totalHoursLogged, 2),
            'approvedHoursCount' => round($approvedHoursCount, 2),
        ];
    }

    $studentOptions = $supervisedStudents
        ->map(fn ($student) => [
            'id' => $student->id,
            'name' => $student->name,
        ])
        ->values()
        ->toArray();

    return view('supervisor.hours_approval.index', compact(
        'supervisedStudents',
        'selectedStudentId',
        'pendingHours',
        'approvedHours',
        'stats',
        'studentOptions'
    ));
}

    public function approve($id, Request $request)
    {
        $hour = Hour::find($id);

        if (!$hour) {
            return back()->with('error', 'Hour not found');
        }

        if (!$this->isAuthorized($hour->student_id)) {
            return back()->with('error', 'Not authorized');
        }

        $hour->update([
            'status' => 'approved',
            'supervisor_reviewed_by' => Auth::id(),
            'supervisor_comment' => $request->comment,
            'reviewed_at' => now(),
        ]);

        return back()->with('success', 'Hour approved');
    }

    public function reject($id, Request $request)
    {
        $hour = Hour::find($id);

        if (!$hour) {
            return back()->with('error', 'Hour not found');
        }

        if (!$this->isAuthorized($hour->student_id)) {
            return back()->with('error', 'Not authorized');
        }

        $request->validate([
            'comment' => 'string|max:1000',
        ]);

        $hour->update([
            'status' => 'rejected',
            'supervisor_reviewed_by' => Auth::id(),
            'supervisor_comment' => $request->comment,
            'reviewed_at' => now(),
        ]);

        return back()->with('success', 'Hour rejected');
    }
}
