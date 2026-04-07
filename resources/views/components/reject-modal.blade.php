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

        <p class="text-gray-600 mb-6">
            Are you sure you want to reject this hour entry?
        </p>

        <form method="POST" :action="`/hour-approval/${hourId}/reject`">
            @csrf

            <div class="flex gap-3">

                <x-submit-button type="submit" color="bg-red-600 hover:bg-red-700">
                    Reject
                </x-submit-button>

                <x-submit-button
                    type="button"
                    click="open = false"
                    color="bg-gray-300 hover:bg-gray-200 text-gray-700">
                    Cancel
                </x-submit-button>
            </div>
        </form>
    </div>
</div>
