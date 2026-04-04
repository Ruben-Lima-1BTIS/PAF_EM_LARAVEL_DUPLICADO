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
            ->whereHas('internships.company', fn($q) => $q->where('id', $user->company_id))
            ->distinct()
            ->get();

        $selectedStudentId = $request->student_id;

        $pendingHours = collect();
        $approvedHours = collect();
        $stats = null;

        if ($selectedStudentId && $this->isAuthorized($selectedStudentId)) {

            $hours = Hour::with(['student', 'internship'])
                ->forStudent($selectedStudentId)
                ->get();

            $pendingHours = $hours->where('status', 'pending')->sortByDesc('date');
            $approvedHours = $hours->where('status', 'approved')->sortByDesc('reviewed_at');

            $stats = [
                'student'           => $hours->first()?->student,
                'totalPending'      => $pendingHours->count(),
                'totalApproved'     => $approvedHours->count(),
                'totalRejected'     => $hours->where('status', 'rejected')->count(),
                'totalHoursLogged'  => round($hours->sum('duration_hours'), 2),
                'approvedHoursCount' => round($approvedHours->sum('duration_hours'), 2),
            ];
        }

        return view('supervisor.hours_approval.index', compact(
            'user',
            'supervisedStudents',
            'selectedStudentId',
            'pendingHours',
            'approvedHours',
            'stats'
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
            'comment' => 'required|string|max:1000',
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
