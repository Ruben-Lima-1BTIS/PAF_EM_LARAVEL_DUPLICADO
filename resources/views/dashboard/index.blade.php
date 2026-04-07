@extends('layouts.auth')

@section('content')

<h1 class="text-2xl font-bold mb-6">Welcome, {{ $user->name }}</h1>

@if($user->isAdmin())
<div class="mb-8">
    <h2 class="text-xl font-semibold text-gray-800 tracking-tight mb-1">System Overview</h2>
    <p class="text-gray-600 text-sm">Key statistics and system metrics</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">

    <x-stat-card title="Total Users" value="{{ $totalUsers }}" icon="fas-users" />
    <x-stat-card title="Coordinators" value="{{ $totalCoordinators }}" icon="fas-user-tie" />
    <x-stat-card title="Supervisors" value="{{ $totalSupervisors }}" icon="fas-user-check" />
    <x-stat-card title="Students" value="{{ $totalStudents }}" icon="fas-user-graduate" />
    <x-stat-card title="Companies" value="{{ $totalCompanies }}" icon="fas-building" />
    <x-stat-card title="Classes" value="{{ $totalClasses }}" icon="fas-chalkboard" />
    <x-stat-card title="Internships" value="{{ $totalInternships }}" icon="fas-briefcase" />

</div>
@elseif($user->isCoordinator())
<p>Coordinator dashboard content here</p>
@elseif($user->isSupervisor())
<p>Supervisor dashboard content here</p>
@elseif($user->isStudent())
<h1>Aluno</h1>
@else
<p>Unknown role</p>
@endif

@endsection