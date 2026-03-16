@extends('layouts.app')

@section('section')
<body class="bg-gray-50 font-sans flex flex-col min-h-screen">


    <div class=" w-fit justify-center bg-blue-600 hover:bg-blue-700 text-white p-2 px-3 rounded-lg font-medium transition">
        <a href="{{ route('home.index') }}" class="flex items-center gap-2">
            <x-fas-arrow-left-long  class="w-6 h-6" /> Voltar
        </a>
    </div>

    <div class="flex-1 flex items-center justify-center py-16 px-4">
        <div class="bg-white p-8 rounded-xl shadow-md w-full max-w-md">

            <h2 class="text-3xl font-bold text-center text-gray-900 mb-6">
                Login
            </h2>

            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf

                <x-input name="email" label="Email" type="email" required />
                <x-input name="password" label="Password" type="password" required />

                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-medium transition">
                    Entrar
                </button>
            </form>

        </div>
    </div>
</body>
@endsection
