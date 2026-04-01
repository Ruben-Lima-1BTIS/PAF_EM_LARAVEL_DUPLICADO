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
                'route' => 'messages.index',
                'icon' => 'message',
                'roles' => ['student','supervisor','coordinator']
            ],
        ],
    ];
@endphp

<div class="ih-shell">

    <nav class="ih-topbar">
        <a href="{{ route('dashboard.index') }}" class="flex items-center space-x-3">
            <div class="ih-logo-box">IH</div>
            <span class="ih-brand-name">InternHub</span>
        </a>

        <div class="relative flex items-center">
            <button
                onclick="document.getElementById('userDropdown').classList.toggle('hidden')"
                class="ih-user-btn"
            >
                <span>{{ auth()->user()->name }}</span>
                <x-dynamic-component :component="'fas-chevron-down'" class="w-3 h-3 text-gray-400" />
            </button>

            <div id="userDropdown" class="ih-dropdown hidden">
                <a href="{{ route('dashboard.index') }}" class="ih-dropdown-item">
                    <x-dynamic-component :component="'fas-gear'" class="w-4 h-4" />
                    <span>Settings</span>
                </a>

                <form method="POST" action="{{ route('auth.logout') }}">
                    @csrf
                    <button type="submit" class="ih-dropdown-item">
                        <x-dynamic-component :component="'fas-right-from-bracket'" class="w-4 h-4" />
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <aside class="ih-sidebar">
        <nav class="space-y-5">
            @foreach($options as $group => $links)
                <div>
                    <h3 class="ih-sidebar-group-label">{{ ucfirst($group) }}</h3>

                    <div class="space-y-0.5">
                        @foreach($links as $link)
                            @if(in_array(auth()->user()->role, $link['roles']))
                                <a href="{{ route($link['route']) }}"
                                   class="ih-sidebar-link {{ request()->routeIs($link['route']) ? 'active' : '' }}">

                                    @if($link['icon'])
                                        <x-dynamic-component
                                            :component="'fas-' . $link['icon']"
                                            class="w-4 h-4 opacity-70"
                                        />
                                    @else
                                        <span class="text-gray-400">•</span>
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

    <div class="ih-main">
        <main class="ih-content">
            @yield('content')
        </main>
    </div>

</div>

<!-- Tive de voltar a por o javascript aqui pq no app.js nao funcionava -->
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
