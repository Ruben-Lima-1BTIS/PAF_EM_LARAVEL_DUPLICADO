@props([
    'tabs' => [],      // ['id' => 'Label']
    'default' => null, // default open tab id
])

<div class="border-b mb-6">
    <nav class="flex space-x-2 overflow-x-auto pb-1">

        @foreach($tabs as $id => $label)
            <button 
                class="tab-btn whitespace-nowrap py-2 px-4 rounded-t-md font-semibold border-b-2 border-transparent text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition"
                data-target="{{ $id }}"
            >
                {{ $label }}
            </button>
        @endforeach

    </nav>
</div>

<div class="tabs-wrapper">
    {{ $slot }}
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const tabs = document.querySelectorAll('.tab-btn');
    const contents = document.querySelectorAll('.tab-content');
    let activeTab = "{{ $default }}";

    // OPEN DEFAULT TAB
    const defaultBtn = document.querySelector(`[data-target="{{ $default }}"]`);
    const defaultContent = document.getElementById("{{ $default }}");

    if (defaultBtn && defaultContent) {
        defaultBtn.classList.add('text-black', 'border-blue-600', 'bg-gray-100');
        defaultContent.classList.remove('hidden');
    }

    tabs.forEach(btn => {
        btn.addEventListener('click', () => {
            const target = btn.dataset.target;
            const content = document.getElementById(target);

            // If clicking the active tab → DO NOTHING (never close)
            if (activeTab === target) return;

            // Reset all
            tabs.forEach(t => t.classList.remove('text-black', 'border-blue-600', 'bg-gray-100'));
            contents.forEach(c => c.classList.add('hidden'));

            // Activate clicked
            btn.classList.add('text-black', 'border-blue-600', 'bg-gray-100');
            content.classList.remove('hidden');

            activeTab = target;
        });
    });
});
</script>
