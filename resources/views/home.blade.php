@extends('layouts.app')
@section('section')

    <div class="bg-gray-50 min-h-screen">

        @include('landing.navbar')

        @include('landing.hero')
        
        @include('landing.roles')
    
    </div>
    
@endsection