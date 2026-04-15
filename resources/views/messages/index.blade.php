@extends('layouts.auth')
@section('content')

  <div class="min-h-screen bg-slate-50">
    <div class="max-w-6xl mx-auto p-6 space-y-8 fade-up">

      <x-page-header title="Messages" subtitle="Manage your internship communications" />

      <div class="grid gap-6">
        <x-primary-card class="lg:col-span-1">
          <x-primary-stat-card title="Total Messages" :value="'—'" icon="fas-message" />
        </x-primary-card>

        <x-primary-card class="lg:col-span-2">
          <div class="p-7">
            <p class="text-[0.7rem] font-semibold tracking-[0.12em] uppercase text-black mb-1">Inbox</p>
            <h3 class="text-[1.05rem] font-semibold text-black mb-6">Coming Soon</h3>

            <div class="overflow-x-auto">
              <table class="w-full border-collapse">
                <thead>
                  <tr>
                    <th
                      class="py-[0.6rem] px-3 text-[0.7rem] font-semibold tracking-[0.1em] uppercase text-[#424242] text-left">
                      Sender</th>
                    <th
                      class="py-[0.6rem] px-3 text-[0.7rem] font-semibold tracking-[0.1em] uppercase text-[#424242] text-left">
                      Subject</th>
                    <th
                      class="py-[0.6rem] px-3 text-[0.7rem] font-semibold tracking-[0.1em] uppercase text-[#424242] text-left">
                      Status</th>
                    <th
                      class="py-[0.6rem] px-3 text-[0.7rem] font-semibold tracking-[0.1em] uppercase text-[#424242] text-left">
                      Date</th>
                  </tr>
                </thead>

                <tbody>
                    <tr class="border-t border-slate-100 transition-colors duration-150 hover:bg-slate-50">
                      <td class="py-[0.9rem] px-3 text-[0.85rem] text-black">—</td>
                      <td class="py-[0.9rem] px-3 text-[0.85rem] text-black">Feature in progress</td>
                      <td class="py-[0.9rem] px-3 text-[0.85rem] text-black"><span class="badge-placeholder">Pending</span>
                      </td>
                      <td class="py-[0.9rem] px-3 text-[0.85rem] text-black">—</td>
                    </tr>
                </tbody>
              </table>
            </div>

            <div class="mt-8 flex flex-col gap-4">
              <x-chat-bubble admin>Hello dear user, our message system is yet to be implemented. <br> Please be pacient, good things might come to those who wait</x-chat-bubble>
              <x-chat-bubble user>I'm' so hyped about it, can't wait for it!!! When will it be available ?</x-chat-bubble>
              <x-chat-bubble admin>Soon!!!</x-chat-bubble>
            </div>
          </div>
        </x-primary-card>
      </div>
    </div>
  </div>

@endsection