@extends('layouts.auth')

@section('content')

  <div class="min-h-screen bg-blue-50">
    <div class="max-w-6xl mx-auto p-6 space-y-8 fade-up">
      <x-page-header title="Log Hours" subtitle="Track and manage your internship time" />
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 fade-up">
        <x-primary-card class="lg:col-span-2">
          <div class="p-7">
            <p class="text-[0.7rem] font-semibold tracking-[0.12em] uppercase text-black mb-1">
              Entry
            </p>
            <h3 class="text-[1.05rem] font-semibold text-black mb-6">Add Hours</h3>

            <form action="{{ route('log.hours') }}" method="POST" class="space-y-5">
              @csrf

              <x-input name="date" type="date" label="Date" required />

              <div class="grid grid-cols-2 gap-4">

                <div>
                  <x-input name="start_time" type="time" label="Start" required />
                </div>
                <div>
                  <x-input name="end_time" type="time" label="End" required />
                </div>
              </div>

              <x-submit-button type="submit" color="bg-blue-600 hover:bg-blue-700">
                Log Hours
              </x-submit-button>
            </form>
          </div>
        </x-primary-card>

        <x-primary-card class="lg:col-span-1">
          <x-primary-stat-card title="Total Hours Logged" :value="$totalHours" icon="fas-clock" />
        </x-primary-card>
      </div>

      <x-primary-card class="lg:col-span-2">
        <div class="p-7">
          <p class="text-[0.7rem] font-semibold tracking-[0.12em] uppercase text-black mb-1">
            History
          </p>
          <h3 class="text-[1.05rem] font-semibold text-black mb-6">Recent Entries
          </h3>

          <div class="overflow-x-auto">
            <table class="w-full border-collapse">
              <thead>
                <tr>
                  <th class="px-3 py-2 text-[0.7rem] font-semibold tracking-[0.1em] uppercase text-[#424242] text-left">
                    Date</th>
                  <th class="px-3 py-2 text-[0.7rem] font-semibold tracking-[0.1em] uppercase text-[#424242] text-left">
                    Start</th>
                  <th class="px-3 py-2 text-[0.7rem] font-semibold tracking-[0.1em] uppercase text-[#424242] text-left">
                    End</th>
                  <th class="px-3 py-2 text-[0.7rem] font-semibold tracking-[0.1em] uppercase text-[#424242] text-left">
                    Hours</th>
                  <th class="px-3 py-2 text-[0.7rem] font-semibold tracking-[0.1em] uppercase text-[#424242] text-left">
                    Status</th>
                </tr>
              </thead>

              <tbody>
                @foreach($logs as $log)
                  @php
                    $status = strtolower($log->status);
                    $badge = [
                      'pending' => 'badge-pending',
                      'approved' => 'badge-approved',
                      'rejected' => 'badge-rejected'
                    ][$status] ?? 'badge-default';
                  @endphp

                  <tr class="border-t border-blue-100 transition-colors duration-150 hover:bg-blue-50">
                    <td class="px-3 py-3 text-[0.85rem] text-black">{{ $log->date }}</td>
                    <td class="px-3 py-3 text-[0.85rem] text-black">{{ $log->start_time }}</td>
                    <td class="px-3 py-3 text-[0.85rem] text-black">{{ $log->end_time }}</td>
                    <td class="px-3 py-3 text-[0.85rem] text-black">{{ $log->hours_worked }}h</td>
                    <td class="px-3 py-3 text-[0.85rem] text-black">
                      <span class="badge {{ $badge }}">
                        {{ ucfirst($status) }}
                      </span>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </x-primary-card>

    </div>
  </div>
@endsection