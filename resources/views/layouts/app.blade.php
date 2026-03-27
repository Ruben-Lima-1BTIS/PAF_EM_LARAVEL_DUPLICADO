<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-gray-50">

    {{-- Toast Container --}}
    <div class="fixed bottom-5 right-5 z-50 flex flex-col space-y-3 items-end">

        {{-- Success Toast --}}
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
                class="flex items-center gap-3 bg-white border border-green-500/30 text-gray-800 px-5 py-3 rounded-xl shadow-lg backdrop-blur-md"
            >
                <div class="w-2.5 h-2.5 bg-green-500 rounded-full"></div>
                <span class="text-sm font-medium">
                    {{ session('success') }}
                </span>
            </div>
        @endif

        {{-- Error Toast --}}
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
                class="flex items-center gap-3 bg-white border border-red-500/30 text-gray-800 px-5 py-3 rounded-xl shadow-lg backdrop-blur-md"
            >
                <div class="w-2.5 h-2.5 bg-red-500 rounded-full"></div>
                <span class="text-sm font-medium">
                    {{ $errors->first() }}
                </span>
            </div>
        @endif

    </div>

    {{-- Content --}}
    <div class="overflow-hidden bg-white shadow-sm rounded-lg p-6 m-4">
        @yield('section')
    </div>

</body>
</html>