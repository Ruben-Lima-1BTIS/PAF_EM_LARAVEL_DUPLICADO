
@extends('layouts.auth')

@section('content')

<h1>Ola</h1>


<form action="{{route('auth.logout')}}" method="POST" class="mb-6 bg-white p-4 rounded shadow">
    @csrf

    <button>
        Logout
    </button>

</form>


@endsection