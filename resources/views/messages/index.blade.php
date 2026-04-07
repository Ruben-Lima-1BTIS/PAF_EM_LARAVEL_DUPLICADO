@extends('layouts.auth')
@section('content')

  <div class="min-h-screen bg-blue-50">
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
                  @for($i = 0; $i < 3; $i++)
                    <tr class="border-t border-blue-100 transition-colors duration-150 hover:bg-blue-50">
                      <td class="py-[0.9rem] px-3 text-[0.85rem] text-black">—</td>
                      <td class="py-[0.9rem] px-3 text-[0.85rem] text-black">Feature in progress</td>
                      <td class="py-[0.9rem] px-3 text-[0.85rem] text-black"><span class="badge-placeholder">Pending</span>
                      </td>
                      <td class="py-[0.9rem] px-3 text-[0.85rem] text-black">—</td>
                    </tr>
                  @endfor
                </tbody>
              </table>
            </div>

            <div class="mt-8 flex flex-col gap-4">
              <x-chat-bubble admin>Hiiiiiiii 😭👋 soooo ummm… this messaging feature is like… still in the oven
                😳🍞</x-chat-bubble>
              <x-chat-bubble user>OMG 😩 I’ve been waiting so long I’m basically a fossil now 🦴✨</x-chat-bubble>
              <x-chat-bubble admin>NOOO 😭 Not my favorite user turning into an ancient artifact… I can’t emotionally
                handle that 😭👉👈</x-chat-bubble>
              <x-chat-bubble user>Well maybe if you worked faster I wouldn’t be decomposing rn 😏💅</x-chat-bubble>
              <x-chat-bubble admin>STOPPP 😳 I’m literally overheating… like the servers are fanning me with their lil
                fans rn 💻🌀</x-chat-bubble>
              <x-chat-bubble user>Ugh fine… I’ll wait… but only because you’re kinda my toxic fave 😩❤️‍🔥</x-chat-bubble>
              <x-chat-bubble admin>AHHH 😭 Not you calling me toxic… I’m literally kicking my feet, twirling my Ethernet
                cable, and giggling rn 😳💞</x-chat-bubble>
            </div>
          </div>
        </x-primary-card>
      </div>
    </div>
  </div>

@endsection