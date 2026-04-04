@extends('layouts.auth')

@section('content')

<div class="mb-6">
    <h2 class="text-2xl font-semibold text-gray-800 tracking-tight">Management Tools</h2>
    <p class="text-sm text-gray-400 mt-0.5">Create and manage system resources</p>
</div>

<x-tabs
    :tabs="[
            'tabUser'       => 'Create User',
            'tabCompany'    => 'Create Company',
            'tabClass'      => 'Create Class',
            'tabInternship' => 'Create Internship',
            'tabAssign'     => 'Assign Internship',
        ]"
    default="tabUser">

    <div id="tabUser" class="tab-content hidden">

        <div class="ih-card">
            <div class="ih-card-header">
                <span class="ih-card-icon">
                    <x-dynamic-component :component="'fas-user-plus'" class="w-4 h-4" />
                </span>
                <h2 class="ih-card-title">Create User</h2>
            </div>

            <form action="{{ route('hr.user.create') }}" method="POST" class="ih-form">
                @csrf

                <x-select
                    name="role"
                    label="Role"
                    id="roleSelectUser"
                    required
                    :options="[
                        ['id' => App\Models\User::ROLE_COORDINATOR, 'name' => 'Coordinator'],
                        ['id' => App\Models\User::ROLE_SUPERVISOR,  'name' => 'Supervisor'],
                        ['id' => App\Models\User::ROLE_STUDENT,     'name' => 'Student'],
                    ]" />

                <x-input name="name" label="Name" required />
                <x-input name="email" label="Email" type="email" required />
                <x-input name="password" label="Inicial Password" type="password" required />

                <div id="classSelectWrapper" class="hidden">
                    <x-select
                        name="class_id"
                        label="Class"
                        :options="$classes->map(fn($c) => ['id' => $c->id, 'name' => $c->sigla])" />
                </div>

                <div id="companySelectWrapper" class="hidden">
                    <x-select
                        name="company_id"
                        label="Company"
                        :options="$companies->map(fn($company) => ['id' => $company->id, 'name' => $company->name])" />
                </div>

                <div class="ih-form-footer">
                    <button type="submit" class="ih-btn">
                        <x-dynamic-component :component="'fas-user-plus'" class="w-3.5 h-3.5" />
                        Create User
                    </button>
                </div>
            </form>
        </div>

    </div>

    <div id="tabCompany" class="tab-content hidden">

        <div class="ih-card">
            <div class="ih-card-header">
                <span class="ih-card-icon">
                    <x-dynamic-component :component="'fas-building'" class="w-4 h-4" />
                </span>
                <h2 class="ih-card-title">Create Company</h2>
            </div>

            <form action="{{ route('hr.company.create') }}" method="POST" class="ih-form">
                @csrf

                <x-input name="name" label="Company's Name" required />
                <x-input name="address" label="Adress" required />
                <x-input name="email" label="Email" type="email" required />
                <x-input name="phone" label="Phone Number" type="tel" required />

                <div class="ih-form-footer">
                    <button type="submit" class="ih-btn">
                        <x-dynamic-component :component="'fas-building'" class="w-3.5 h-3.5" />
                        Create Company
                    </button>
                </div>
            </form>
        </div>

    </div>

    <div id="tabClass" class="tab-content hidden">

        <div class="ih-card">
            <div class="ih-card-header">
                <span class="ih-card-icon">
                    <x-dynamic-component :component="'fas-chalkboard'" class="w-4 h-4" />
                </span>
                <h2 class="ih-card-title">Create Class</h2>
            </div>

            <form action="{{ route('hr.class.create') }}" method="POST" class="ih-form">
                @csrf

                <x-input name="course" label="Course's Name" required />
                <x-input name="sigla" label="Acronym" required />
                <x-input name="year" label="Year" type="number" required />

                <x-select
                    name="user_id"
                    label="Coordinator"
                    required
                    :options="$coordinators->map(fn($coord) => ['id' => $coord->id, 'name' => $coord->name])" />

                <div class="ih-form-footer">
                    <button type="submit" class="ih-btn">
                        <x-dynamic-component :component="'fas-chalkboard'" class="w-3.5 h-3.5" />
                        Create Class
                    </button>
                </div>
            </form>
        </div>

    </div>

    <div id="tabInternship" class="tab-content hidden">

        <div class="ih-card">
            <div class="ih-card-header">
                <span class="ih-card-icon">
                    <x-dynamic-component :component="'fas-briefcase'" class="w-4 h-4" />
                </span>
                <h2 class="ih-card-title">Create Internship</h2>
            </div>

            <form action="{{ route('hr.internship.create') }}" method="POST" class="ih-form">
                @csrf

                <x-input name="title" label="Internship Title" required />

                <x-select
                    name="company_id"
                    label="Company"
                    required
                    :options="$companies->map(fn($company) => ['id' => $company->id, 'name' => $company->name])" />

                <div class="ih-form-grid">
                    <x-input name="start_date" label="Start Date" type="date" required />
                    <x-input name="end_date" label="End Date" type="date" required />
                </div>

                <div class="ih-form-grid">
                    <x-input name="total_hours_required" label="Total Hours Required" type="number" required />
                    <x-input name="min_hours_day" label="Minimum Hours Per Day" type="number" required />
                </div>

                <div class="ih-form-footer">
                    <button type="submit" class="ih-btn">
                        <x-dynamic-component :component="'fas-briefcase'" class="w-3.5 h-3.5" />
                        Create Internship
                    </button>
                </div>
            </form>
        </div>

    </div>

    <div id="tabAssign" class="tab-content hidden">

        <div class="ih-card">
            <div class="ih-card-header">
                <span class="ih-card-icon">
                    <x-dynamic-component :component="'fas-link'" class="w-4 h-4" />
                </span>
                <h2 class="ih-card-title">Assign Internship</h2>
            </div>

            <form action="{{ route('hr.user.assignUser') }}" method="POST" class="ih-form">
                @csrf

                <x-select
                    name="role"
                    label="User's Role"
                    id="roleSelect"
                    required
                    :options="[
                        ['id' => 'student',    'name' => 'Student'],
                        ['id' => 'supervisor', 'name' => 'Supervisor'],
                    ]" />

                <div id="studentWrapper" class="hidden">
                    <x-select
                        name="student_id"
                        label="Student"
                        :options="$students->map(fn($s) => ['id' => $s->id, 'name' => $s->name])" />
                </div>

                <div id="supervisorWrapper" class="hidden">
                    <x-select
                        name="supervisor_id"
                        label="Supervisor"
                        :options="$supervisors->map(fn($sup) => ['id' => $sup->id, 'name' => $sup->name])" />
                </div>

                <x-select
                    name="internship_id"
                    label="Internship"
                    required
                    :options="$internships->map(fn($i) => ['id' => $i->id, 'name' => $i->title])" />

                <div class="ih-form-footer">
                    <button type="submit" class="ih-btn">
                        <x-dynamic-component :component="'fas-link'" class="w-3.5 h-3.5" />
                        Assign Internship
                    </button>
                </div>
            </form>
        </div>

    </div>

</x-tabs>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        const roleSelectUser = document.getElementById("roleSelectUser");
        const classWrapper = document.getElementById("classSelectWrapper");
        const companyWrapper = document.getElementById("companySelectWrapper");

        function updateUserFields() {
            const role = roleSelectUser.value;

            classWrapper.classList.add("hidden");
            companyWrapper.classList.add("hidden");

            if (role == "{{ App\Models\User::ROLE_STUDENT }}") {
                classWrapper.classList.remove("hidden");
            }

            if (role == "{{ App\Models\User::ROLE_SUPERVISOR }}") {
                companyWrapper.classList.remove("hidden");
            }
        }

        roleSelectUser.addEventListener("change", updateUserFields);

        const roleSelect = document.getElementById("roleSelect");
        const studentWrapper = document.getElementById("studentWrapper");
        const supervisorWrapper = document.getElementById("supervisorWrapper");

        function updateAssignFields() {
            const role = roleSelect.value;

            studentWrapper.classList.add("hidden");
            supervisorWrapper.classList.add("hidden");

            if (role === "student") studentWrapper.classList.remove("hidden");
            if (role === "supervisor") supervisorWrapper.classList.remove("hidden");
        }

        roleSelect.addEventListener("change", updateAssignFields);
    });
</script>

@endsection