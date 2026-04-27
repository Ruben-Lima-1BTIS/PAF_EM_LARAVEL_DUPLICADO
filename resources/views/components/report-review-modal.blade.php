<div x-data="{
        open: false,
        reportId: null,
        action: null,
        loading: false,
        init() {
            window.addEventListener('open-review-modal', (e) => {
                this.reportId = e.detail.id;
                this.action   = e.detail.action;
                this.open     = true;
                this.loading  = false;
            });
        },
        get isApprove() { return this.action === 'approve' },
        get actionUrl() { return `/report-approval/${this.reportId}/${this.action}` },
    }"
    x-show="open" x-transition.opacity x-cloak
    @keydown.escape.window="open = false"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/20 backdrop-blur-sm">

    <div class="absolute inset-0" @click="open = false"></div>

    <div x-show="open" x-transition.scale class="relative bg-white rounded-lg shadow-xl w-full max-w-md p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-2" x-text="isApprove ? 'Approve Report?' : 'Reject Report?'"></h3>
        <p class="text-gray-600 mb-6" x-text="isApprove ? 'Are you sure you want to approve this report?' : 'Are you sure you want to reject this report?'"></p>

        <form method="POST" :action="actionUrl" @submit="loading = true" class="flex gap-3">
            @csrf
            <button type="submit"
                :class="isApprove ? 'bg-green-600 hover:bg-green-700' : 'bg-red-600 hover:bg-red-700'"
                class="px-4 py-2 rounded text-white disabled:opacity-50"
                :disabled="loading">
                <span x-show="!loading" x-text="isApprove ? 'Approve' : 'Reject'"></span>
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