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

        $logs = Hour::where('student_id', $studentId)
                    ->orderByDesc('date')
                    ->get()
                    ->map(function ($log) {
                        $start = Carbon::parse($log->start_time);
                        $end = Carbon::parse($log->end_time);
                        $log->hours_worked = max($start->floatDiffInHours($end) - 1, 0);
                        return $log;
                    });

        $totalHours = $logs->sum('hours_worked');
        
        return view('student.hours.index', compact('logs', 'totalHours'));
    }

    public function store(Request $request)
    {
        $studentId = Auth::id();
        $internshipsIds = UserInternship::where('user_id', $studentId)->pluck('internship_id');

        $internship = Internship::whereIn('id', $internshipsIds)
            ->where('status', 'active')
            ->first();

        $validated = $request->validate([
            'date' => [
                'required',
                'date',
                'after_or_equal:' . $internship->start_date,
            ],
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);

        $start = Carbon::parse($validated['start_time']);
        $end = Carbon::parse($validated['end_time']);
        $hoursWorked = $start->floatDiffInHours($end) - 1;

        if ($hoursWorked < 4) {
            return back()->withErrors('As horas logadas devem ser no mínimo 4 horas, descontando 1 hora de almoço.');
        }

        $validated['student_id'] = Auth::id();
        $validated['internship_id'] = $internship->id;

        try {
            Hour::create($validated);
            return back()->with('success', 'Horas logadas com sucesso!');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
