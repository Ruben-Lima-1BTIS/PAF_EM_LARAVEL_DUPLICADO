<div
  x-data="{
        open: false,
        hourId: null,

        init() {
            window.addEventListener('open-approve', (e) => {
                this.hourId = e.detail.id;
                this.open = true;
            });
        }
    }"
  x-show="open"
  x-transition.opacity
  x-cloak
  @keydown.escape.window="open = false"
  class="fixed inset-0 z-50 flex items-center justify-center bg-black/20">

  <div class="absolute inset-0" @click="open = false"></div>

  <div
    x-show="open"
    x-transition.scale
    class="relative bg-white rounded-lg shadow-xl w-full max-w-md p-6">

    <h3 class="text-lg font-semibold text-gray-900 mb-4">
      Approve Hour Entry?
    </h3>

    <p class="text-gray-600 mb-6">
      Are you sure you want to approve this hour entry?
    </p>

    <form method="POST" :action="`/hour-approval/${hourId}/approve`" class="flex gap-3">
      @csrf

      <button
        type="button"
        @click="open = false"
        class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
        Cancel
      </button>

      <button
        type="submit"
        class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
        Approve
      </button>
    </form>
  </div>
</div>