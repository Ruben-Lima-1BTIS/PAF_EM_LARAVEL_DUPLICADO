<?php

namespace App\Services;

use App\Models\User;
use App\Models\Company;
use App\Models\ClassModel;
use App\Models\Internship;
use App\Models\Hour;
use App\Models\Report;

class DashboardService
{
    public function getStats(User $user): array
    {
        return match ($user->role) {
            User::ROLE_ADMIN => $this->getAdminStats(),
            User::ROLE_COORDINATOR => $this->getCoordinatorStats(),
            User::ROLE_SUPERVISOR => $this->getSupervisorStats(),
            User::ROLE_STUDENT => $this->getStudentStats(),
            default => [],
        };
    }

    private function getAdminStats(): array
    {
        return [
            'totalUsers' => User::where('role', '!=', User::ROLE_ADMIN)->count(),
            'totalCoordinators' => User::where('role', User::ROLE_COORDINATOR)->count(),
            'totalSupervisors' => User::where('role', User::ROLE_SUPERVISOR)->count(),
            'totalStudents' => User::where('role', User::ROLE_STUDENT)->count(),
            'totalCompanies' => Company::count(),
            'totalClasses' => ClassModel::count(),
            'totalInternships' => Internship::count(),
        ];
    }

    private function getCoordinatorStats(): array
    {
        return [
            'myStudents' => User::where('role', User::ROLE_STUDENT)
                ->where('coordinator_id', auth()->id())
                ->count(),
            'myClasses' => ClassModel::where('coordinator_id', auth()->id())->count(),
        ];
    }

    private function getStudentStats(): array
    {
        $studentId = auth()->id();

        $internship = Internship::whereHas('studentAssignment', function ($q) use ($studentId) {
            $q->where('user_id', $studentId);
        })->first();

        $minutesByStatus = Hour::where('student_id', $studentId)
            ->selectRaw('status, SUM(GREATEST(TIMESTAMPDIFF(MINUTE, start_time, end_time) - 60, 0)) as total_minutes')
            ->groupBy('status')
            ->pluck('total_minutes', 'status');

        $approvedHours = round(($minutesByStatus['approved'] ?? 0) / 60, 1);
        $pendingHours = round(($minutesByStatus['pending'] ?? 0) / 60, 1);
        $rejectedHours = round(($minutesByStatus['rejected'] ?? 0) / 60, 1);

        $totalHoursRequired = $internship?->total_hours_required ?? 0;
        $remainingHours = max($totalHoursRequired - $approvedHours - $pendingHours - $rejectedHours, 0);

        $weeklyHours = Hour::where('student_id', $studentId)
            ->whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()])
            ->selectRaw('DAYOFWEEK(date) as day, SUM(GREATEST(TIMESTAMPDIFF(MINUTE, start_time, end_time) - 60, 0)) / 60 as hours')
            ->groupBy('day')
            ->pluck('hours', 'day');

        return [
            'myInternships' => $internship ? 1 : 0,
            'totalHoursRequired' => $totalHoursRequired,
            'approvedHours' => $approvedHours,
            'pendingHours' => $pendingHours,
            'rejectedHours' => $rejectedHours,
            'remainingHours' => $remainingHours,
            'reportsSubmitted' => Report::where('student_id', $studentId)->count(),
            'weeklyHours' => [
                round($weeklyHours[2] ?? 0, 1),
                round($weeklyHours[3] ?? 0, 1),
                round($weeklyHours[4] ?? 0, 1),
                round($weeklyHours[5] ?? 0, 1),
                round($weeklyHours[6] ?? 0, 1),
            ],
        ];
    }

    private function getSupervisorStats(): array
    {
        return [
            'myInterns' => Internship::whereHas('supervisorAssignment', function ($q) {
                $q->where('user_id', auth()->id());
            })->count(),
        ];
    }
}