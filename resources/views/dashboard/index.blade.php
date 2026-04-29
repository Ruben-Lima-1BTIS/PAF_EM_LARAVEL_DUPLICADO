@extends('layouts.auth')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Welcome, {{ $user->name }}</h1>

    @if ($user->isAdmin())
        <div class="mb-8">
            <h2 class="text-xl font-semibold text-gray-800 tracking-tight mb-1">System Overview</h2>
            <p class="text-gray-600 text-sm">Key statistics and system metrics</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <x-stat-card title="Total Users" value="{{ $stats['totalUsers'] }}" icon="fas-users" />
            <x-stat-card title="Coordinators" value="{{ $stats['totalCoordinators'] }}" icon="fas-user-tie" />
            <x-stat-card title="Supervisors" value="{{ $stats['totalSupervisors'] }}" icon="fas-user-check" />
            <x-stat-card title="Students" value="{{ $stats['totalStudents'] }}" icon="fas-user-graduate" />
            <x-stat-card title="Companies" value="{{ $stats['totalCompanies'] }}" icon="fas-building" />
            <x-stat-card title="Classes" value="{{ $stats['totalClasses'] }}" icon="fas-chalkboard" />
            <x-stat-card title="Internships" value="{{ $stats['totalInternships'] }}" icon="fas-briefcase" />
        </div>
    @elseif($user->isCoordinator())
        @php
            $classOptions = collect($stats['classes'])
                ->map(fn($c) => ['id' => $c['id'], 'name' => $c['sigla'] . ' — ' . $c['course']])
                ->toArray();
        @endphp

        <div class="space-y-8 w-full">

            <div class="flex flex-col sm:flex-row gap-8 w-full">
                <div class="flex-1">
                    <x-stat-card title="My Classes" value="{{ $stats['myClasses'] }}" icon="fas-chalkboard-teacher" />
                </div>
                <div class="flex-1">
                    <x-stat-card title="My Students" value="{{ $stats['myStudents'] }}" icon="fas-user-graduate" />
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6" x-data="{ selectedId: {{ $stats['classes'][0]['id'] ?? 'null' }} }">

                <h3 class="text-xl font-bold text-gray-800 mb-4">Class Overview</h3>

                <x-select name="class_picker" :options="$classOptions" x-model="selectedId" />

                @foreach ($stats['classes'] as $class)
                    <div x-show="selectedId == {{ $class['id'] }}">
                        @if (count($class['students']) === 0)
                            <p class="text-gray-400 text-center py-8">No students in this class.</p>
                        @else
                            <table class="w-full text-sm text-left text-gray-700">
                                <thead class="text-xs uppercase bg-gray-50 text-gray-500 border-b">
                                    <tr>
                                        <th class="px-4 py-3">Student</th>
                                        <th class="px-4 py-3">Internship</th>
                                        <th class="px-4 py-3 text-center">Approved</th>
                                        <th class="px-4 py-3 text-center">Pending</th>
                                        <th class="px-4 py-3 text-center">Remaining</th>
                                        <th class="px-4 py-3 text-center">Reports</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($class['students'] as $student)
                                        <tr class="border-b hover:bg-gray-50">
                                            <td class="px-4 py-3 text-slate-900 font-semibold">
                                                {{ $student['name'] }}</td>
                                            <td class="px-4 py-3 text-slate-900 font-semibold">
                                                {{ $student['internship'] ?? '—' }}</td>
                                            <td class="px-4 py-3 text-center text-slate-900 font-semibold">
                                                {{ $student['approved_hours'] }}h</td>
                                            <td class="px-4 py-3 text-center text-slate-900 font-semibold">
                                                {{ $student['pending_hours'] }}h</td>
                                            <td class="px-4 py-3 text-center text-slate-900 font-semibold">
                                                {{ $student['remaining_hours'] }}h</td>
                                            <td class="px-4 py-3 text-center text-slate-900 font-semibold">
                                                {{ $student['reports_submitted'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                @endforeach

            </div>

        </div>
    @elseif($user->isSupervisor())
        <p>Supervisor dashboard content here</p>
    @elseif($user->isStudent())
        <div class="space-y-8 w-full">

            <div class="flex flex-col sm:flex-row gap-8 w-full">
                <div class="flex-1">
                    <x-stat-card title="Hours Completed" value="{{ $stats['approvedHours'] }}" icon="fas-clock" />
                </div>

                <div class="flex-1">
                    <x-stat-card title="Submitted Reports" value="{{ $stats['reportsSubmitted'] }}" icon="fas-file-alt" />
                </div>
            </div>

            <div class="flex flex-col xl:flex-row gap-8 w-full">

                <div
                    class="flex-1 bg-white rounded-lg shadow-md border border-gray-200 hover:shadow-lg transition-shadow p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-6 text-center">
                        Hour Distribution
                    </h3>

                    <div class="relative w-full h-[320px]">
                        <canvas id="hoursPieChart" class="w-full h-full"></canvas>
                    </div>
                </div>

                <div
                    class="flex-1 bg-white rounded-lg shadow-md border border-gray-200 hover:shadow-lg transition-shadow p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-6 text-center">
                        Weekly Progress
                    </h3>

                    <div class="relative w-full h-[320px]">
                        <canvas id="hoursBarChart" class="w-full h-full"></canvas>
                    </div>
                </div>

            </div>

        </div>

        @php $weeklyHours = $stats['weeklyHours'] ?? [0, 0, 0, 0, 0]; @endphp
        <script>
            window.dashboardStats = {
                approvedHours: {{ (int) ($stats['approvedHours'] ?? 0) }},
                remainingHours: {{ (int) ($stats['remainingHours'] ?? 0) }},
                pendingHours: {{ (int) ($stats['pendingHours'] ?? 0) }},
                weeklyHours: @json($weeklyHours),
                minHoursDay: 6
            };
        </script>



        @push('scripts')
            @vite('resources/js/dashboard.js')
        @endpush
        </div>
    @else
        <p>Unknown role</p>
    @endif
@endsection
