@extends('layouts.auth')

@section('content')

    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-800 tracking-tight">Management Tools</h2>
        <p class="text-sm text-gray-400 mt-0.5">View and delete system resources</p>
    </div>

    <x-tabs :tabs="[
        'tabStudents'     => 'Students',
        'tabSupervisors'  => 'Supervisors',
        'tabCoordinators' => 'Coordinators',
        'tabCompanies'    => 'Companies',
        'tabClasses'      => 'Classes',
        'tabInternships'  => 'Internships',
        'tabUnassign'     => 'Unassign Internship',
    ]" default="tabStudents">

        {{-- STUDENTS --}}
        <div id="tabStudents" class="tab-content hidden">
            <x-list-card title="Students" icon="fas-user-graduate">

                <x-select name="classFilter" id="classFilter" label="Filter by Class"
                    :options="$classes->map(fn($c) => ['id' => $c->id, 'name' => $c->sigla . ' — ' . $c->course])" />

                <div id="studentList">
                    @forelse($students as $student)
                        <div class="student-row flex items-center justify-between py-3 border-b border-gray-100 last:border-0"
                            data-class-id="{{ $student->userClass?->class_id }}">
                            <div>
                                <p class="text-sm font-medium text-gray-800">{{ $student->name }}</p>
                                <p class="text-xs text-gray-400">{{ $student->email }}</p>
                            </div>
                            <form method="POST" action="{{ route('hr.student.delete') }}"
                                onsubmit="return confirm('Delete {{ $student->name }}?')">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $student->id }}">
                                <x-submit-button type="submit" color="bg-red-50 hover:bg-red-100 text-red-600">
                                    <x-fas-trash class="w-3 h-3" /> Delete
                                </x-submit-button>
                            </form>
                        </div>
                    @empty
                        <p class="text-sm text-gray-400 text-center py-4">No students found.</p>
                    @endforelse
                    <p id="noStudentsMsg" class="text-sm text-gray-400 text-center py-4 hidden">No students in this class.</p>
                </div>

            </x-list-card>
        </div>

        {{-- SUPERVISORS --}}
        <div id="tabSupervisors" class="tab-content hidden">
            <x-list-card title="Supervisors" icon="fas-user-tie">
                @forelse($supervisors as $supervisor)
                    <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-0">
                        <div>
                            <p class="text-sm font-medium text-gray-800">{{ $supervisor->name }}</p>
                            <p class="text-xs text-gray-400">{{ $supervisor->email }}</p>
                        </div>
                        <form method="POST" action="{{ route('hr.supervisor.delete') }}"
                            onsubmit="return confirm('Delete {{ $supervisor->name }}?')">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $supervisor->id }}">
                            <x-submit-button type="submit" color="bg-red-50 hover:bg-red-100 text-red-600">
                                <x-fas-trash class="w-3 h-3" /> Delete
                            </x-submit-button>
                        </form>
                    </div>
                @empty
                    <p class="text-sm text-gray-400 text-center py-4">No supervisors found.</p>
                @endforelse
            </x-list-card>
        </div>

        {{-- COORDINATORS --}}
        <div id="tabCoordinators" class="tab-content hidden">
            <x-list-card title="Coordinators" icon="fas-chalkboard-user">
                @forelse($coordinators as $coordinator)
                    <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-0">
                        <div>
                            <p class="text-sm font-medium text-gray-800">{{ $coordinator->name }}</p>
                            <p class="text-xs text-gray-400">{{ $coordinator->email }}</p>
                        </div>
                        <form method="POST" action="{{ route('hr.coordinator.delete') }}"
                            onsubmit="return confirm('Delete {{ $coordinator->name }}?')">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $coordinator->id }}">
                            <x-submit-button type="submit" color="bg-red-50 hover:bg-red-100 text-red-600">
                                <x-fas-trash class="w-3 h-3" /> Delete
                            </x-submit-button>
                        </form>
                    </div>
                @empty
                    <p class="text-sm text-gray-400 text-center py-4">No coordinators found.</p>
                @endforelse
            </x-list-card>
        </div>

        {{-- COMPANIES --}}
        <div id="tabCompanies" class="tab-content hidden">
            <x-list-card title="Companies" icon="fas-building">
                @forelse($companies as $company)
                    <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-0">
                        <div>
                            <p class="text-sm font-medium text-gray-800">{{ $company->name }}</p>
                            <p class="text-xs text-gray-400">{{ $company->email }}</p>
                        </div>
                        <form method="POST" action="{{ route('hr.company.delete') }}"
                            onsubmit="return confirm('Delete {{ $company->name }}?')">
                            @csrf
                            <input type="hidden" name="company_id" value="{{ $company->id }}">
                            <x-submit-button type="submit" color="bg-red-50 hover:bg-red-100 text-red-600">
                                <x-fas-trash class="w-3 h-3" /> Delete
                            </x-submit-button>
                        </form>
                    </div>
                @empty
                    <p class="text-sm text-gray-400 text-center py-4">No companies found.</p>
                @endforelse
            </x-list-card>
        </div>

        {{-- CLASSES --}}
        <div id="tabClasses" class="tab-content hidden">
            <x-list-card title="Classes" icon="fas-chalkboard">
                @forelse($classes as $class)
                    <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-0">
                        <div>
                            <p class="text-sm font-medium text-gray-800">{{ $class->sigla }}</p>
                            <p class="text-xs text-gray-400">{{ $class->course }} — {{ $class->year }}</p>
                        </div>
                        <form method="POST" action="{{ route('hr.class.delete') }}"
                            onsubmit="return confirm('Delete {{ $class->sigla }}?')">
                            @csrf
                            <input type="hidden" name="class_id" value="{{ $class->id }}">
                            <x-submit-button type="submit" color="bg-red-50 hover:bg-red-100 text-red-600">
                                <x-fas-trash class="w-3 h-3" /> Delete
                            </x-submit-button>
                        </form>
                    </div>
                @empty
                    <p class="text-sm text-gray-400 text-center py-4">No classes found.</p>
                @endforelse
            </x-list-card>
        </div>

        {{-- INTERNSHIPS --}}
        <div id="tabInternships" class="tab-content hidden">
            <x-list-card title="Internships" icon="fas-briefcase">
                @forelse($internships as $internship)
                    <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-0">
                        <div>
                            <p class="text-sm font-medium text-gray-800">{{ $internship->title }}</p>
                            <p class="text-xs text-gray-400">{{ $internship->start_date }} → {{ $internship->end_date }}</p>
                        </div>
                        <form method="POST" action="{{ route('hr.internship.delete') }}"
                            onsubmit="return confirm('Delete {{ $internship->title }}?')">
                            @csrf
                            <input type="hidden" name="internship_id" value="{{ $internship->id }}">
                            <x-submit-button type="submit" color="bg-red-50 hover:bg-red-100 text-red-600">
                                <x-fas-trash class="w-3 h-3" /> Delete
                            </x-submit-button>
                        </form>
                    </div>
                @empty
                    <p class="text-sm text-gray-400 text-center py-4">No internships found.</p>
                @endforelse
            </x-list-card>
        </div>

        {{-- UNASSIGN --}}
        <div id="tabUnassign" class="tab-content hidden">
            <x-ih-card title="Unassign Internship" icon="fas-link-slash" action="{{ route('hr.unassign') }}">

                <x-select name="role" label="User's Role" id="roleSelectUnassign" required :options="[
                    ['id' => 'student',    'name' => 'Student'],
                    ['id' => 'supervisor', 'name' => 'Supervisor'],
                ]" />

                <div id="unassignStudentWrapper" class="hidden">
                    <x-select name="student_id" label="Student"
                        :options="$students->map(fn($s) => ['id' => $s->id, 'name' => $s->name])" />
                </div>

                <div id="unassignSupervisorWrapper" class="hidden">
                    <x-select name="supervisor_id" label="Supervisor"
                        :options="$supervisors->map(fn($s) => ['id' => $s->id, 'name' => $s->name])" />
                </div>

                <x-select name="internship_id" label="Internship" required
                    :options="$internships->map(fn($i) => ['id' => $i->id, 'name' => $i->title])" />

            </x-ih-card>
        </div>

    </x-tabs>

    <script>
        document.addEventListener("DOMContentLoaded", function () {

            function bindRoleSelect(selectId, wrapperMap) {
                const select = document.getElementById(selectId);
                if (!select) return;

                const wrappers = Object.values(wrapperMap);

                select.addEventListener("change", function () {
                    wrappers.forEach(el => el.classList.add("hidden"));
                    wrapperMap[this.value]?.classList.remove("hidden");
                });
            }

            bindRoleSelect("roleSelectUnassign", {
                "student":    document.getElementById("unassignStudentWrapper"),
                "supervisor": document.getElementById("unassignSupervisorWrapper"),
            });

            const classFilter = document.getElementById('classFilter');
            if (classFilter) {
                classFilter.addEventListener('change', function () {
                    const selected = this.value;
                    const rows = document.querySelectorAll('.student-row');
                    let visible = 0;

                    rows.forEach(row => {
                        const match = !selected || row.dataset.classId === selected;
                        row.classList.toggle('hidden', !match);
                        if (match) visible++;
                    });

                    document.getElementById('noStudentsMsg').classList.toggle('hidden', visible > 0);
                });
            }

        });
    </script>

@endsection