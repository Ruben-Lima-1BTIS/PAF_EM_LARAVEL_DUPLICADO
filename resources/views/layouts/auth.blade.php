
@extends('layouts.app')


@section('section')
@php
    $options = [
        'dashboard' => [
            ['name' => 'Dashboard',
            'route' => 'dashboard.index', 
            'icon' => ''
            ],
        ],
        'Funcionalidades' => [
            ['name' => 'hr',
            'route' => 'hr.index', 
            'icon' => ''
            ],
        ],
        'Cenas_bued_fixes' => [
            ['name' => 'Dashboard',
            'route' => 'dashboard.index', 
            'icon' => ''
            ],
        ],
    ];
@endphp
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <div class="bg-blue-600 text-white font-bold text-xl px-3 py-1 rounded">IH</div>
                        <span class="ml-2 text-xl font-bold text-gray-900">InternHub</span>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    {{Auth::user()->name}}    
                </div>
            </div>
        </div>
    </nav>

    <div>
        <div class="max-w-7xl mx-auto  flex space-x-4">
            <div class="w-64 bg-white rounded shadow p-4">
                <nav class="space-y-2">
                    @foreach($options as $group => $links)
                        <div>
                            <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">{{ucfirst($group)}}</h3>
                            <div class="space-y-1">
                                @foreach($links as $link)
                                    <a href="{{route($link['route'])}}" class="flex items-center px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition">
                                        @if($link['icon'])
                                            <span class="mr-3">{!! $link['icon'] !!}</span>
                                        @endif
                                        {{ $link['name'] }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </nav>
            </div>

            <main class="flex-1 bg-gray-50 overflow-y-auto rounded shadow ">
                @yield('content')
            </main>
    </div>


@endsection