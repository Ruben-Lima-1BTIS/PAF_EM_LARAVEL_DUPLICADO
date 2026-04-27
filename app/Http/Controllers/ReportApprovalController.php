<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use App\Models\UserClass;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportApprovalController extends Controller
{

    // --- Private helpers ---

    private function handleReview(int $id, string $status): RedirectResponse
    {
        $report = Report::findOrFail($id);

        if (!$this->isAuthorized($report)) {
            return back()->with('error', 'Not authorized to review this report.');
        }

        $report->update([
            'status'                  => $status,
            'coordinator_reviewed_by' => Auth::id(),
            'reviewed_at'             => now(),
        ]);

        $label = ucfirst($status);

        return back()->with('success', "Report {$label} successfully.");
    }

    private function getCoordinatorClass()
    {
        return UserClass::where('user_id', Auth::id())
            ->with('classModel')
            ->first()
            ?->classModel;
    }

    private function isAuthorized(Report $report): bool
    {
        $class = $this->getCoordinatorClass();

        return $class && UserClass::where('class_id', $class->id)
            ->where('user_id', $report->student_id)
            ->exists();
    }

    public function index(Request $request)
    {
        $coordinatorClass = $this->getCoordinatorClass();

        if (!$coordinatorClass) {
            return back()->with('error', 'You are not assigned to any class.');
        }

        $classStudentIds = UserClass::where('class_id', $coordinatorClass->id)->pluck('user_id');

        $classStudents = User::whereIn('id', $classStudentIds)
            ->where('role', 'student')
            ->get(['id', 'name']);

        $cleanedStudents = $classStudents->map(fn($s) => [
            'id'   => $s->id,
            'name' => $s->name,
        ])->all();

        $selectedStudentId = $request->integer('student_id');
        $isValidSelection  = $selectedStudentId && $classStudents->pluck('id')->contains($selectedStudentId);

        $pendingReports  = collect();
        $approvedReports = collect();
        $rejectedReports = collect();
        $stats           = null;

        if ($isValidSelection) {
            $baseQuery = Report::with(['student', 'internship', 'reviewer'])
                ->where('student_id', $selectedStudentId);

            $pendingReports  = (clone $baseQuery)->where('status', 'pending')->latest()->get();
            $approvedReports = (clone $baseQuery)->where('status', 'approved')->latest('reviewed_at')->get();
            $rejectedReports = (clone $baseQuery)->where('status', 'rejected')->latest('reviewed_at')->get();

            $stats = [
                'student'       => $classStudents->find($selectedStudentId),
                'totalPending'  => $pendingReports->count(),
                'totalApproved' => $approvedReports->count(),
                'totalRejected' => $rejectedReports->count(),
            ];
        }

        return view('coordinator.reports.index', compact(
            'cleanedStudents',
            'selectedStudentId',
            'pendingReports',
            'approvedReports',
            'rejectedReports',
            'stats',
        ));
    }

    public function approve(int $id): RedirectResponse
    {
        return $this->handleReview($id, 'approved');
    }

    public function reject(int $id): RedirectResponse
    {
        return $this->handleReview($id, 'rejected');
    }

    
}