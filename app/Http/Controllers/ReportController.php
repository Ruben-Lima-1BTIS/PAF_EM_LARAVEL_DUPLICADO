<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Show the reports page.
     */
    public function index()
    {
        $student = Auth::user();

        // Get the student's active internship
        $internship = $student->internships()->first();

        // Fetch reports for this student + internship
        $reports = Report::where('student_id', $student->id)
            ->where('internship_id', $internship->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('student.reports.index', [
            'reports'       => $reports,
            'internship'    => $internship,
            'totalReports'  => $reports->count(),
        ]);
    }

    /**
     * Store a new report.
     */
    public function store(Request $request)
    {
        $request->validate([
            'internship_id' => 'required|exists:internships,id',
            'report_file'   => 'required|file|max:5120', // 5MB
        ]);

        $student = Auth::user();

        // Store file
        $file     = $request->file('report_file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path     = $file->storeAs('reports', $filename, 'public');

        // Create report entry
        Report::create([
            'student_id'            => $student->id,
            'internship_id'         => $request->internship_id,
            'file_path'             => 'storage/' . $path,
            'original_name'         => $file->getClientOriginalName(),
            'status'                => 'pending',
            'supervisor_reviewed_by'=> null,
            'supervisor_comment'    => null,
            'created_at'            => now(),
        ]);

        return back()->with('success', 'Report submitted successfully.');
    }
}
