@extends('layouts.auth')

@section('content')

@php
    $user = auth()->user();
@endphp

<h1 class="text-2xl font-bold mb-6">Welcome, {{ $user->name }}</h1>

@if($user->isAdmin())
    <p>Admin dashboard content here</p>
@elseif($user->isCoordinator())
    <p>Coordinator dashboard content here</p>
@elseif($user->isSupervisor())
    <p>Supervisor dashboard content here</p>
@elseif($user->isStudent())
    h1
@else
    <p>Unknown role 🤔</p>
@endif

@endsection