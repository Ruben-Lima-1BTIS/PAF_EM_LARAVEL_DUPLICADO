<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <script src="//unpkg.com/alpinejs" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-50">

    <div class="fixed bottom-5 right-5 z-50 flex flex-col space-y-3 items-end">

    @if(session('success'))
        <div
            x-data="{ show: true }"
            x-show="show"
            x-transition:enter="transform transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transform transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            x-init="setTimeout(() => show = false, 3000)"
            class="toast toast--success"
        >
            <div class="toast__icon">
                <x-dynamic-component :component="'fas-circle-check'" class="w-4 h-4" />
            </div>

            <div class="toast__body">
                <p class="toast__label">Sucesso</p>
                <p class="toast__message">{{ session('success') }}</p>
            </div>

            <button @click="show = false" class="toast__close">
                <x-dynamic-component :component="'fas-xmark'" class="w-3 h-3" />
            </button>

            <div class="toast__progress toast__progress--success"></div>
        </div>
    @endif

    @if($errors->any())
        <div
            x-data="{ show: true }"
            x-show="show"
            x-transition:enter="transform transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transform transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            x-init="setTimeout(() => show = false, 4000)"
            class="toast toast--error"
        >
            <div class="toast__icon">
                <x-dynamic-component :component="'fas-circle-exclamation'" class="w-4 h-4" />
            </div>

            <div class="toast__body">
                <p class="toast__label">Erro</p>
                <p class="toast__message">{{ $errors->first() }}</p>
            </div>

            <button @click="show = false" class="toast__close">
                <x-dynamic-component :component="'fas-xmark'" class="w-3 h-3" />
            </button>

            <div class="toast__progress toast__progress--error"></div>
        </div>
    @endif

</div>

    <div class="overflow-hidden bg-white shadow-sm rounded-lg">
        @yield('section')
    </div>

</body>
</html>
