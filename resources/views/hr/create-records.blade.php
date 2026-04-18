@extends('layouts.auth')

@section('content')

    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-800 tracking-tight">Management Tools</h2>
        <p class="text-sm text-gray-400 mt-0.5">Create and manage system resources</p>
    </div>

    <x-tabs :tabs="[
            'tabUser' => 'Create User',
            'tabCompany' => 'Create Company',
            'tabClass' => 'Create Class',
            'tabInternship' => 'Create Internship',
            'tabAssign' => 'Assign Internship',
        ]" default="tabUser">

        <div id="tabUser" class="tab-content hidden">
            <x-ih-card title="Create User" icon="fas-user-plus" action="{{ route('hr.user.create') }}">

                <x-select name="role" label="Role" id="roleSelectUser" required :options="[
                        ['id' => App\Models\User::ROLE_COORDINATOR, 'name' => 'Coordinator'],
                        ['id' => App\Models\User::ROLE_SUPERVISOR,  'name' => 'Supervisor'],
                        ['id' => App\Models\User::ROLE_STUDENT,     'name' => 'Student'],
                    ]" />

                <x-input name="name" label="Name" required />
                <x-input name="email" label="Email" type="email" required />
                <x-input name="password" label="Initial Password" type="password" required />

                <div id="classSelectWrapper" class="hidden">
                    <x-select name="class_id" label="Class" :options="$classes->map(fn($c) => ['id' => $c->id, 'name' => $c->sigla])" />
                </div>

                <div id="companySelectWrapper" class="hidden">
                    <x-select name="company_id" label="Company" :options="$companies->map(fn($c) => ['id' => $c->id, 'name' => $c->name])" />
                </div>

            </x-ih-card>
        </div>

        <div id="tabCompany" class="tab-content hidden">
            <x-ih-card title="Create Company" icon="fas-building" action="{{ route('hr.company.create') }}">

                <x-input name="name" label="Company's Name" required />
                <x-input name="address" label="Address" required />
                <x-input name="email" label="Email" type="email" required />
                <x-input name="phone" label="Phone Number" type="tel" required />

            </x-ih-card>
        </div>

        <div id="tabClass" class="tab-content hidden">
            <x-ih-card title="Create Class" icon="fas-chalkboard" action="{{ route('hr.class.create') }}">

                <x-input name="course" label="Course's Name" required />
                <x-input name="sigla" label="Acronym" required />
                <x-input name="year" label="Year" type="number" required />

                <x-select name="user_id" label="Coordinator" required
                    :options="$coordinators->map(fn($c) => ['id' => $c->id, 'name' => $c->name])" />

            </x-ih-card>
        </div>

        <div id="tabInternship" class="tab-content hidden">
            <x-ih-card title="Create Internship" icon="fas-briefcase" action="{{ route('hr.internship.create') }}">

                <x-input name="title" label="Internship Title" required />

                <x-select name="company_id" label="Company" required
                    :options="$companies->map(fn($c) => ['id' => $c->id, 'name' => $c->name])" />

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-input name="start_date" label="Start Date" type="date" required />
                    </div>
                    <div>
                        <x-input name="end_date" label="End Date" type="date" required />
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-input name="total_hours_required" label="Total Hours Required" type="number" required />
                    </div>
                    <div>
                        <x-input name="min_hours_day" label="Minimum Hours Per Day" type="number" required />
                    </div>
                </div>

            </x-ih-card>
        </div>

        <div id="tabAssign" class="tab-content hidden">
            <x-ih-card title="Assign Internship" icon="fas-link" action="{{ route('hr.user.assignUser') }}">

                <x-select name="role" label="User's Role" id="roleSelect" required :options="[
                        ['id' => 'student',    'name' => 'Student'],
                        ['id' => 'supervisor', 'name' => 'Supervisor'],
                    ]" />

                <div id="studentWrapper" class="hidden">
                    <x-select name="student_id" label="Student" :options="$students->map(fn($s) => ['id' => $s->id, 'name' => $s->name])" />
                </div>

                <div id="supervisorWrapper" class="hidden">
                    <x-select name="supervisor_id" label="Supervisor" :options="$supervisors->map(fn($s) => ['id' => $s->id, 'name' => $s->name])" />
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

            bindRoleSelect("roleSelectUser", {
                "{{ App\Models\User::ROLE_STUDENT }}": document.getElementById("classSelectWrapper"),
                "{{ App\Models\User::ROLE_SUPERVISOR }}": document.getElementById("companySelectWrapper"),
            });

            bindRoleSelect("roleSelect", {
                "student": document.getElementById("studentWrapper"),
                "supervisor": document.getElementById("supervisorWrapper"),
            });

        });
    </script>

@endsection