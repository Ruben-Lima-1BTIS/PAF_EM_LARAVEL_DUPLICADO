<nav class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <div class="flex items-center space-x-3">
            <div class="bg-blue-600 text-white font-bold text-[1.1rem] px-3 py-[0.35rem] rounded-[0.6rem]">IH</div>
            <span class="text-xl font-bold text-slate-900">InternHub</span>
        </div>

        <a href="{{ route('home.index') }}" class="text-blue-600 text-[0.85rem] font-medium inline-flex items-center 
                    gap-[0.4rem] transition-all duration-200
                    hover:text-blue-700 hover:gap-[0.6rem]">
            <x-fas-arrow-left-long class="w-4 h-4" />
            Back to Home
        </a>
    </div>
</nav>
