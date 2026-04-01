@extends('layouts.auth')

@section('content')


    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-800 tracking-tight">Cenas fixes de HR</h1>
        <p class="text-sm text-gray-400 mt-0.5">Criação de users, empresas, turmas e estágios</p>
    </div>

    <x-tabs
        :tabs="[
            'tabUser'       => 'Criar Utilizador',
            'tabCompany'    => 'Criar Empresa',
            'tabClass'      => 'Criar Turma',
            'tabInternship' => 'Criar Estágio',
            'tabAssign'     => 'Atribuir Estágio',
        ]"
        default="tabUser"
    >

    <div id="tabUser" class="tab-content hidden">

        <div class="ih-card">
            <div class="ih-card-header">
                <span class="ih-card-icon">
                    <x-dynamic-component :component="'fas-user-plus'" class="w-4 h-4" />
                </span>
                <h2 class="ih-card-title">Criar Utilizador</h2>
            </div>

            <form action="{{ route('hr.user.create') }}" method="POST" class="ih-form">
                @csrf

                <x-select
                    name="role"
                    label="Profissão"
                    id="roleSelectUser"
                    required
                    :options="[
                        ['id' => App\Models\User::ROLE_COORDINATOR, 'name' => 'Coordenador'],
                        ['id' => App\Models\User::ROLE_SUPERVISOR,  'name' => 'Supervisor'],
                        ['id' => App\Models\User::ROLE_STUDENT,     'name' => 'Aluno'],
                    ]"
                />

                <x-input name="name"     label="Nome"            required />
                <x-input name="email"    label="Email"           type="email"    required />
                <x-input name="password" label="Password Inicial" type="password" required />

                <div id="classSelectWrapper" class="hidden">
                    <x-select
                        name="class_id"
                        label="Turma"
                        :options="$classes->map(fn($c) => ['id' => $c->id, 'name' => $c->sigla])"
                    />
                </div>

                <div id="companySelectWrapper" class="hidden">
                    <x-select
                        name="company_id"
                        label="Empresa"
                        :options="$companies->map(fn($company) => ['id' => $company->id, 'name' => $company->name])"
                    />
                </div>

                <div class="ih-form-footer">
                    <button type="submit" class="ih-btn">
                        <x-dynamic-component :component="'fas-user-plus'" class="w-3.5 h-3.5" />
                        Criar Utilizador
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
                <h2 class="ih-card-title">Criar Empresa</h2>
            </div>

            <form action="{{ route('hr.company.create') }}" method="POST" class="ih-form">
                @csrf

                <x-input name="name"    label="Nome da Empresa" required />
                <x-input name="address" label="Morada"          required />
                <x-input name="email"   label="Email"           type="email" required />
                <x-input name="phone"   label="Telefone"        type="tel"   required />

                <div class="ih-form-footer">
                    <button type="submit" class="ih-btn">
                        <x-dynamic-component :component="'fas-building'" class="w-3.5 h-3.5" />
                        Criar Empresa
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
                <h2 class="ih-card-title">Criar Turma</h2>
            </div>

            <form action="{{ route('hr.class.create') }}" method="POST" class="ih-form">
                @csrf

                <x-input name="course" label="Nome do Curso" required />
                <x-input name="sigla"  label="Sigla"         required />
                <x-input name="year"   label="Ano"           type="number" required />

                <x-select
                    name="user_id"
                    label="Coordenador"
                    required
                    :options="$coordinators->map(fn($coord) => ['id' => $coord->id, 'name' => $coord->name])"
                />

                <div class="ih-form-footer">
                    <button type="submit" class="ih-btn">
                        <x-dynamic-component :component="'fas-chalkboard'" class="w-3.5 h-3.5" />
                        Criar Turma
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
                <h2 class="ih-card-title">Criar Estágio</h2>
            </div>

            <form action="{{ route('hr.internship.create') }}" method="POST" class="ih-form">
                @csrf

                <x-input name="title" label="Título do Estágio" required />

                <x-select
                    name="company_id"
                    label="Empresa"
                    required
                    :options="$companies->map(fn($company) => ['id' => $company->id, 'name' => $company->name])"
                />

                <div class="ih-form-grid">
                    <x-input name="start_date" label="Data de Início" type="date" required />
                    <x-input name="end_date"   label="Data de Fim"    type="date" required />
                </div>

                <div class="ih-form-grid">
                    <x-input name="total_hours_required" label="Horas Necessárias"     type="number" required />
                    <x-input name="min_hours_day"        label="Horas Mínimas por Dia" type="number" required />
                </div>

                <div class="ih-form-footer">
                    <button type="submit" class="ih-btn">
                        <x-dynamic-component :component="'fas-briefcase'" class="w-3.5 h-3.5" />
                        Criar Estágio
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
                <h2 class="ih-card-title">Atribuir Estágio</h2>
            </div>

            <form action="{{ route('hr.user.assignUser') }}" method="POST" class="ih-form">
                @csrf

                <x-select
                    name="role"
                    label="Tipo de Utilizador"
                    id="roleSelect"
                    required
                    :options="[
                        ['id' => 'student',    'name' => 'Aluno'],
                        ['id' => 'supervisor', 'name' => 'Supervisor'],
                    ]"
                />

                <div id="studentWrapper" class="hidden">
                    <x-select
                        name="student_id"
                        label="Aluno"
                        :options="$students->map(fn($s) => ['id' => $s->id, 'name' => $s->name])"
                    />
                </div>

                <div id="supervisorWrapper" class="hidden">
                    <x-select
                        name="supervisor_id"
                        label="Supervisor"
                        :options="$supervisors->map(fn($sup) => ['id' => $sup->id, 'name' => $sup->name])"
                    />
                </div>

                <x-select
                    name="internship_id"
                    label="Estágio"
                    required
                    :options="$internships->map(fn($i) => ['id' => $i->id, 'name' => $i->title])"
                />

                <div class="ih-form-footer">
                    <button type="submit" class="ih-btn">
                        <x-dynamic-component :component="'fas-link'" class="w-3.5 h-3.5" />
                        Atribuir Estágio
                    </button>
                </div>
            </form>
        </div>

    </div>

</x-tabs>

@endsection
