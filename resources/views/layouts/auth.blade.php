@extends('layouts.app')

@section('section')
@php
    $options = [
        'dashboard' => [
            [
                'name' => 'Dashboard',
                'route' => 'dashboard.index',
                'icon' => 'house',
                'roles' => ['admin','coordinator','supervisor','student']
            ],
        ],

        'Funcionalidades' => [
            [
                'name' => 'Backstage HR',
                'route' => 'hr.index',
                'icon' => 'tools',
                'roles' => ['admin']
            ],
            [
                'name' => 'Log Hours',
                'route' => 'student.hours',
                'icon' => 'clock',
                'roles' => ['student']
            ],
            [
                'name' => 'Submit Reports',
                'route' => 'student.reports',
                'icon' => 'file-arrow-up',
                'roles' => ['student']
            ],
            [
                'name' => 'Approve/Reject Hours',
                'route' => 'dashboard.index',
                'icon' => 'check',
                'roles' => ['supervisor']
            ],
            [
                'name' => 'Check Student Progress',
                'route' => 'dashboard.index',
                'icon' => 'users',
                'roles' => ['supervisor']
            ],
            [
                'name' => 'Check Class Progress',
                'route' => 'dashboard.index',
                'icon' => 'users',
                'roles' => ['coordinator']
            ],
            [
                'name' => 'Check Reports',
                'route' => 'dashboard.index',
                'icon' => 'file',
                'roles' => ['coordinator']
            ],
            [
                'name' => 'Chat Messages',
                'route' => 'dashboard.index',
                'icon' => 'message',
                'roles' => ['student','supervisor','coordinator']
            ],
        ],
    ];
@endphp

<nav class="bg-white shadow-sm border-b border-gray-200 fixed top-0 left-0 right-0 z-50">
    <div class="flex justify-between items-center h-16 px-4">
        
        <a href="{{route('dashboard.index')}}">
            <div class="flex items-center space-x-3 h-16">
                <div class="bg-blue-600 text-white font-bold text-xl px-3 py-1">
                    IH
                </div>
                <span class="text-xl font-bold text-gray-900">
                    InternHub
                </span>
            </div>
        </a>

        <div class="relative flex items-center">
            <button 
                onclick="document.getElementById('userDropdown').classList.toggle('hidden')"
                class="flex items-center space-x-2 px-3 py-2 hover:bg-gray-100 transition"
            >
                <span class="font-medium text-gray-800">
                    {{ auth()->user()->name }}
                </span>

                <x-dynamic-component 
                    :component="'fas-chevron-down'" 
                    class="w-3 h-3 text-gray-600" 
                />
            </button>

            <div 
                id="userDropdown"
                class="hidden absolute right-0 top-full mt-1 w-44 bg-white border border-gray-200 shadow-lg z-50"
            >
                <a href="{{ route('dashboard.index') }}"
                   class="flex items-center space-x-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">
                    <x-dynamic-component 
                        :component="'fas-gear'" 
                        class="w-4 h-4 text-gray-600" 
                    />
                    <span>Settings</span>
                </a>

                <form method="POST" action="{{ route('auth.logout') }}">
                    @csrf
                    <button
                        type="submit"
                        class="flex items-center space-x-2 w-full text-left px-4 py-2 text-sm text-gray-700 
                            hover:bg-gray-200 hover:text-gray-900 transition-colors duration-200 ease-in-out cursor-pointer"
                    >
                        <x-dynamic-component
                            :component="'fas-right-from-bracket'"
                            class="w-4 h-4 text-gray-600 group-hover:text-gray-900 transition-colors duration-200"
                        />
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<div class="flex pt-16">
    <aside class="w-64 bg-white border-r border-gray-200 p-4 h-[calc(100vh-4rem)] fixed left-0 top-16 overflow-y-auto">
        <nav class="space-y-6">
            @foreach($options as $group => $links)
                <div>
                    <h3 class="text-[11px] font-semibold text-gray-500 uppercase tracking-wider mb-2">
                        {{ ucfirst($group) }}
                    </h3>

                    <div class="space-y-1">
                        @foreach($links as $link)
                            @if(in_array(auth()->user()->role, $link['roles']))
                                <a href="{{ route($link['route']) }}"
                                   class="flex items-center px-3 py-2 text-sm font-medium 
                                          text-gray-700 hover:bg-gray-200 hover:text-gray-900 
                                          transition group">

                                    @if($link['icon'])
                                        <x-dynamic-component 
                                            :component="'fas-' . $link['icon']" 
                                            class="w-4 h-4 mr-3 opacity-70 group-hover:opacity-100 transition" 
                                        />
                                    @else
                                        <span class="mr-3 text-gray-400 group-hover:text-gray-600 transition">•</span>
                                    @endif

                                    {{ $link['name'] }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach
        </nav>
    </aside>

    <main class="ml-64 w-full bg-gray-50 p-6 h-[calc(100vh-4rem)] overflow-y-auto">
        @yield('content')
    </main>

</div>

<script>
document.addEventListener('click', function(e) {
    const dropdown = document.getElementById('userDropdown');
    const button = dropdown.previousElementSibling;

    if (!button.contains(e.target) && !dropdown.contains(e.target)) {
        dropdown.classList.add('hidden');
    }
});
</script>

@endsection
