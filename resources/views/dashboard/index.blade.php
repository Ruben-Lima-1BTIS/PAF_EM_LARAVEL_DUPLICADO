@extends('layouts.auth')

@section('content')

<h1 class="text-2xl font-bold mb-6">Welcome, {{ $user->name }}</h1>

@if($user->isAdmin())
    <div class="mb-8">
        <h2 class="text-xl font-semibold text-gray-800 tracking-tight mb-1">System Overview</h2>
        <p class="text-gray-600 text-sm">Key statistics and system metrics</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        
        <div class="bg-white rounded-lg shadow-md border border-gray-200 hover:shadow-lg transition-shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium mb-1">Total Users</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalUsers }}</p>
                </div>
                <div class="bg-blue-100 rounded-full p-3">
                    <x-dynamic-component :component="'fas-users'" class="w-6 h-6 text-blue-600" />
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md border border-gray-200 hover:shadow-lg transition-shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium mb-1">Coordinators</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalCoordinators }}</p>
                </div>
                <div class="bg-blue-100 rounded-full p-3">
                    <x-dynamic-component :component="'fas-user-tie'" class="w-6 h-6 text-blue-600" />
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md border border-gray-200 hover:shadow-lg transition-shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium mb-1">Supervisors</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalSupervisors }}</p>
                </div>
                <div class="bg-blue-100 rounded-full p-3">
                    <x-dynamic-component :component="'fas-user-check'" class="w-6 h-6 text-blue-600" />
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md border border-gray-200 hover:shadow-lg transition-shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium mb-1">Students</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalStudents }}</p>
                </div>
                <div class="bg-blue-100 rounded-full p-3">
                    <x-dynamic-component :component="'fas-user-graduate'" class="w-6 h-6 text-blue-600" />
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md border border-gray-200 hover:shadow-lg transition-shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium mb-1">Companies</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalCompanies }}</p>
                </div>
                <div class="bg-blue-100 rounded-full p-3">
                    <x-dynamic-component :component="'fas-building'" class="w-6 h-6 text-blue-600" />
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md border border-gray-200 hover:shadow-lg transition-shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium mb-1">Classes</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalClasses }}</p>
                </div>
                <div class="bg-blue-100 rounded-full p-3">
                    <x-dynamic-component :component="'fas-chalkboard'" class="w-6 h-6 text-blue-600" />
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md border border-gray-200 hover:shadow-lg transition-shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium mb-1">Internships</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalInternships }}</p>
                </div>
                <div class="bg-blue-100 rounded-full p-3">
                    <x-dynamic-component :component="'fas-briefcase'" class="w-6 h-6 text-blue-600" />
                </div>
            </div>
        </div>

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