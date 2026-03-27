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

        $logs = Hour::where('student_id', $studentId)->orderByDesc('date')->get();

        $totalHours = $logs->sum(function ($log) {
            return Carbon::parse($log->start_time)->floatDiffInHours(Carbon::parse($log->end_time));
        });

        return view('student.hours.index', compact('logs', 'totalHours'));
    }

    public function store(Request $request)
    {
        $studentId = Auth::id();
        $internshipsIds = UserInternship::where('user_id', $studentId)->pluck('internship_id');

        $internship = Internship::whereIn('id', $internshipsIds)->where('status', 'active')->first();

        $validated = $request->validate([
            'date' => [
                'required',
                'date',
                'after_or_equal:' . $internship->start_date,
            ],
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);
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
