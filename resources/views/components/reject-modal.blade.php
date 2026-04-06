<div
    x-data="{
        open: false,
        hourId: null,

        init() {
            window.addEventListener('open-reject', (e) => {
                this.hourId = e.detail.id;
                this.open = true;
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
            Reject Hour Entry
        </h3>

        <form method="POST" :action="`/hour-approval/${hourId}/reject`">
            @csrf
            
            <div class="flex gap-3">
                <button
                    type="submit"
                    class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                    Reject
                </button>

                <button
                    type="button"
                    @click="open = false"
                    class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-200">
                    Cancel
                </button>
            </div>

        </form>
    </div>
</div>