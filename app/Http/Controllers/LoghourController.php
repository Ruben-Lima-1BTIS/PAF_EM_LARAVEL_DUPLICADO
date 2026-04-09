<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Hour;
use App\Models\Internship;
use App\Models\UserInternship;
use Carbon\Carbon;

class LoghourController extends Controller
{

    private function hasLoggedForDate(int $studentId, string $date): bool
    {
        return Hour::where('student_id', $studentId)
            ->whereDate('date', $date)
            ->exists();
    }

    private function formatHours(float $hours): string
    {
        $h = (int) $hours;
        $m = (int) round(($hours - $h) * 60);
        return sprintf('%02d:%02d', $h, $m);
    }

    private function calculateWorkedHours(string $startTime, string $endTime): float
    {
        $start = Carbon::parse($startTime);
        $end = Carbon::parse($endTime);
        return max($start->floatDiffInHours($end) - 1, 0);
    }

    private function getActiveInternship(int $studentId): Internship
    {
        $internshipIds = UserInternship::where('user_id', $studentId)->pluck('internship_id');

        return Internship::whereIn('id', $internshipIds)
            ->where('status', 'active')
            ->firstOrFail();
    }

    public function index(Request $request)
    {
        $studentId = $request->user()->id;

        $logs = Hour::where('student_id', $studentId)
            ->orderByDesc('date')
            ->get();

        $totalHours = $logs->where('status', 'approved')
            ->whereNotNull('duration_hours')
            ->sum(fn($log) => (float) $log->duration_hours);

        $totalHoursFormatted = $this->formatHours($totalHours);

        return view('student.hours.index', compact('logs', 'totalHoursFormatted'));
    }

    public function store(Request $request)
    {
        $studentId = Auth::id();
        $internship = $this->getActiveInternship($studentId);

        if ($this->hasLoggedForDate($studentId, $request->input('date'))) {
            return back()->withErrors('You already logged hours for this day.');
        }

        $validated = $request->validate([
            'date' => ['required', 'date', 'after_or_equal:' . $internship->start_date],
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        $hoursWorked = $this->calculateWorkedHours($validated['start_time'], $validated['end_time']);

        if ($hoursWorked < 4) {
            return back()->withErrors('Logged hours must be at least 4 hours, excluding 1 hour for lunch.');
        }

        Hour::create([
            'student_id' => $studentId,
            'internship_id' => $internship->id,
            'date' => $validated['date'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'duration_hours' => round($hoursWorked, 2),
        ]);

        return back()->with('success', 'Hours logged successfully!');
    }


}