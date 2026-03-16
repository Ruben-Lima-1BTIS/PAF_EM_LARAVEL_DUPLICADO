@extends('layouts.auth')

@section('content')

<x-tabs 
    :tabs="[
        'tabUser' => 'Criar Utilizador',
        'tabCompany' => 'Criar Empresa',
        'tabClass' => 'Criar Turma',
        'tabInternship' => 'Criar Estágio',
        'tabAssign' => 'Atribuir Estágio',
    ]"
    default="tabUser"
>

    <!-- TAB: Criar Utilizador -->
    <div id="tabUser" class="tab-content hidden">
        <h2 class="text-xl font-bold ">Criar Utilizador</h2>

        <form action="{{route('hr.user.create')}}" method="POST" class="mb-6 bg-white p-4 rounded shadow">
            @csrf

            <x-select 
                name="role" 
                label="Profissão" 
                id="roleSelectUser"
                required
                :options="[
                    ['id' => App\Models\User::ROLE_COORDINATOR, 'name' => 'Coordenador'],
                    ['id' => App\Models\User::ROLE_SUPERVISOR, 'name' => 'Supervisor'],
                    ['id' => App\Models\User::ROLE_STUDENT, 'name' => 'Aluno'],
                ]"
            />

            <x-input name="name" label="Nome" required />
            <x-input name="email" label="Email" type="email" required />
            <x-input name="password" label="Password Inicial" type="password" required />

            <div id="classSelectWrapper" style="display:none;">
                <x-select 
                    name="class_id" 
                    label="Turma"
                    :options="$classes->map(fn($c) => ['id' => $c->id, 'name' => $c->sigla])"
                />
            </div>

            <div id="companySelectWrapper" style="display:none;">
                <x-select 
                    name="company_id" 
                    label="Empresa" 
                    :options="$companies->map(fn($company) => [
                        'id' => $company->id,
                        'name' => $company->name
                    ])"
                />
            </div>

            <button class="bg-teal-600 text-white px-4 py-2 rounded">
                Criar Utilizador
            </button>
        </form>
    </div>

    <!-- TAB: Criar Empresa -->
    <div id="tabCompany" class="tab-content hidden">
        <h2 class="text-xl font-bold mb-2">Criar Empresa</h2>

        <form action="{{route('hr.company.create')}}" method="POST" class="mb-6 bg-white p-4 rounded shadow">
            @csrf

            <x-input name="name" label="Nome da Empresa" required />
            <x-input name="address" label="Morada" required />
            <x-input name="email" label="Email" type="email" required />
            <x-input name="phone" label="Phone" type="tel" required />

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Criar Empresa
            </button>
        </form>
    </div>

    <!-- TAB: Criar Turma -->
    <div id="tabClass" class="tab-content hidden">
        <h2 class="text-xl font-bold mb-2">Criar Turma</h2>

        <form action="{{route('hr.class.create')}}" method="POST" class="mb-6 bg-white p-4 rounded shadow">
            @csrf

            <x-input name="course" label="Nome do Curso" required />
            <x-input name="sigla" label="Sigla" required />
            <x-input name="year" label="Ano" type="number" required />

            <x-select 
                name="user_id" 
                label="Coordenador" 
                required
                :options="$coordinators->map(fn($coord) => [
                    'id' => $coord->id,
                    'name' => $coord->name
                ])"
            />

            <button class="bg-purple-600 text-white px-4 py-2 rounded">
                Criar Turma
            </button>
        </form>
    </div>

    <!-- TAB: Criar Estágio -->
    <div id="tabInternship" class="tab-content hidden">
        <h2 class="text-xl font-bold mb-2">Criar Estágio</h2>

        <form action="{{route('hr.internship.create')}}" method="POST" class="mb-6 bg-white p-4 rounded shadow">
            @csrf

            <x-input name="title" label="Título do Estágio" required />

            <x-select 
                name="company_id" 
                label="Empresa" 
                required
                :options="$companies->map(fn($company) => [
                    'id' => $company->id,
                    'name' => $company->name
                ])"
            />

            <x-input name="start_date" label="Data de Início" type="date" required />
            <x-input name="end_date" label="Data de Fim" type="date" required />
            <x-input name="total_hours_required" label="Horas Necessárias" type="number" required />
            <x-input name="min_hours_day" label="Horas Mínimas por dia" type="number" required />

            <button class="bg-orange-600 text-white px-4 py-2 rounded">
                Criar Estágio
            </button>
        </form>
    </div>

    <!-- TAB: Atribuir Estágio -->
    <div id="tabAssign" class="tab-content hidden">
        <h2 class="text-xl font-bold mb-2">Atribuir Estágio</h2>

        <form action="{{ route('hr.user.assignUser') }}" method="POST" class="mb-6 bg-white p-4 rounded shadow">
            @csrf

            <x-select 
                name="role" 
                label="Tipo de Utilizador" 
                id="roleSelect" 
                required
                :options="[
                    ['id' => 'student', 'name' => 'Aluno'],
                    ['id' => 'supervisor', 'name' => 'Supervisor'],
                ]"
            />

            <div id="studentWrapper" style="display:none;">
                <x-select 
                    name="student_id" 
                    label="Aluno"
                    :options="$students->map(fn($s) => [
                        'id' => $s->id,
                        'name' => $s->name
                    ])"
                />
            </div>

            <div id="supervisorWrapper" style="display:none;">
                <x-select 
                    name="supervisor_id" 
                    label="Supervisor"
                    :options="$supervisors->map(fn($sup) => [
                        'id' => $sup->id,
                        'name' => $sup->name
                    ])"
                />
            </div>

            <x-select 
                name="internship_id" 
                label="Estágio" 
                required
                :options="$internships->map(fn($i) => [
                    'id' => $i->id,
                    'name' => $i->title
                ])"
            />

            <button class="bg-purple-600 text-white px-4 py-2 rounded">
                Atribuir Estágio
            </button>
        </form>
    </div>

</x-tabs>


<script>
document.addEventListener("DOMContentLoaded", function () {

    const roleSelectUser = document.getElementById("roleSelectUser");
    const classWrapper = document.getElementById("classSelectWrapper");
    const companyWrapper = document.getElementById("companySelectWrapper");

    function updateUserFields() {

        const role = roleSelectUser.value;

        classWrapper.style.display = "none";
        companyWrapper.style.display = "none";

        // Student → show class
        if (role == "{{ App\Models\User::ROLE_STUDENT }}") {
            classWrapper.style.display = "block";
        }

        // Supervisor → show company
        if (role == "{{ App\Models\User::ROLE_SUPERVISOR }}") {
            companyWrapper.style.display = "block";
        }
    }

    roleSelectUser.addEventListener("change", updateUserFields);

});

const roleSelect = document.getElementById("roleSelect");
const studentWrapper = document.getElementById("studentWrapper");
const supervisorWrapper = document.getElementById("supervisorWrapper");

function updateAssignFields() {

    const role = roleSelect.value;

    studentWrapper.style.display = "none";
    supervisorWrapper.style.display = "none";

    if (role === "student") {
        studentWrapper.style.display = "block";
    }

    if (role === "supervisor") {
        supervisorWrapper.style.display = "block";
    }
}

roleSelect.addEventListener("change", updateAssignFields);
</script>

@endsection
