<div
    x-data="{
        open: false,
        hourId: null,
        loading: false,

        init() {
            window.addEventListener('open-reject', (e) => {
                this.hourId = e.detail.id;
                this.open = true;
                this.loading = false;
            });
        }
    }"
    x-show="open"
    x-transition.opacity
    x-cloak
    @keydown.escape.window="open = false"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/20 backdrop-blur-sm">

    <div class="absolute inset-0" @click="open = false"></div>

    <div
        x-show="open"
        x-transition.scale
        class="relative bg-white rounded-lg shadow-xl w-full max-w-md p-6">

        <h3 class="text-lg font-semibold text-gray-900 mb-4">
            Reject Hour Entry?
        </h3>

        <p class="text-gray-600 mb-6">
            Are you sure you want to reject this hour entry?
        </p>

        <form method="POST" :action="`/hour-approval/${hourId}/reject`" @submit="loading = true" class="flex gap-3">
            @csrf

            {{-- Removed the rogue empty <button> that was here --}}

            <button type="submit"
                class="px-4 py-2 rounded bg-red-600 hover:bg-red-700 text-white disabled:opacity-50"
                :disabled="loading">
                <span x-show="!loading">Reject</span>
                <span x-show="loading">Loading...</span>
            </button>

            <button type="button" @click="open = false"
                class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400 text-gray-700"
                :disabled="loading">
                Cancel
            </button>
        </form>
    </div>
</div>