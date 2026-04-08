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
    public function index(Request $request)
    {
        $studentId = $request->user()->id;

        // Fetch hours and approved hours in a single query per type
        $logs = Hour::where('student_id', $studentId)
            ->orderByDesc('date')
            ->get();

        // Map hours worked for each log
        $logs->transform(fn($log) => tap($log, fn($l) => $l->hours_worked = $this->calculateWorkedHours($l->start_time, $l->end_time)));

        // Sum approved hours efficiently
        $totalHours = $logs->where('status', 'approved')->sum(fn($log) => $log->hours_worked);

        return view('student.hours.index', compact('logs', 'totalHours'));
    }

    public function store(Request $request)
    {
        $studentId = Auth::id();
        $internship = $this->getActiveInternship($studentId);

        $validated = $request->validate([
            'date' => ['required', 'date', 'after_or_equal:' . $internship->start_date],
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);

        $hoursWorked = $this->calculateWorkedHours($validated['start_time'], $validated['end_time']);

        if ($hoursWorked < 4) {
            return back()->withErrors('As horas logadas devem ser no mínimo 4 horas, descontando 1 hora de almoço.');
        }

        // Direct creation with only needed fields
        Hour::create([
            'student_id' => $studentId,
            'internship_id' => $internship->id,
            'date' => $validated['date'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'duration_hours' => round($hoursWorked, 2),
        ]);

        return back()->with('success', 'Horas logadas com sucesso!');
    }

    /**
     * Calculate hours worked subtracting 1h lunch.
     */
    private function calculateWorkedHours(string $startTime, string $endTime): float
    {
        $start = Carbon::parse($startTime);
        $end = Carbon::parse($endTime);
        return max($start->floatDiffInHours($end) - 1, 0);
    }

    /**
     * Get active internship for a student.
     */
    private function getActiveInternship(int $studentId): Internship
    {
        $internshipIds = UserInternship::where('user_id', $studentId)->pluck('internship_id');

        return Internship::whereIn('id', $internshipIds)
            ->where('status', 'active')
            ->firstOrFail();
    }
}