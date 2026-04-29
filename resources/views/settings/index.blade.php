@extends('layouts.auth')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-6xl mx-auto p-6 space-y-8 fade-up">
            <x-page-header title="Settings" subtitle="Manage your account and application preferences" />

            <div class="flex items-center gap-4">
                <x-primary-card class="flex-1">
                    <div class="p-7">
                        <p class="text-[0.7rem] font-semibold tracking-[0.12em] uppercase text-black mb-1">Account</p>
                        <h3 class="text-[1.05rem] font-semibold text-black mb-6">Profile Settings</h3>
                        <button onclick="openPasswordModal()" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition">
                            Change Password
                        </button>
                    </div>
                </x-primary-card>
            </div>

            <!-- Password Change Modal -->
            <div id="passwordModal" class="hidden fixed inset-0 bg-black/20 backdrop-blur-sm flex items-center justify-center z-50">
                <div class="bg-white rounded-lg shadow-lg max-w-md w-full mx-4">
                    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-800">Change Password</h2>
                        <button onclick="closePasswordModal()" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <form method="POST" action="{{ route('settings.password.update') }}" class="p-6 space-y-4">
                        @csrf

                        <div>
                            <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">
                                Current Password
                            </label>
                            <input 
                                type="password" 
                                name="current_password" 
                                id="current_password" 
                                required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            />
                            @error('current_password')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                New Password
                            </label>
                            <input 
                                type="password" 
                                name="password" 
                                id="password" 
                                required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            />
                            @error('password')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                                Confirm Password
                            </label>
                            <input 
                                type="password" 
                                name="password_confirmation" 
                                id="password_confirmation" 
                                required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            />
                        </div>

                        <div class="flex gap-3 pt-4">
                            <button 
                                type="submit" 
                                class="flex-1 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition"
                            >
                                Update
                            </button>
                            <button 
                                type="button" 
                                onclick="closePasswordModal()"
                                class="flex-1 px-4 py-2 bg-gray-100 hover:bg-blue-400 text-gray-700 font-medium rounded-lg transition"
                            >
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <script>
                function openPasswordModal() {
                    document.getElementById('passwordModal').classList.remove('hidden');
                }

                function closePasswordModal() {
                    document.getElementById('passwordModal').classList.add('hidden');
                }

                // Close modal when clicking outside
                document.getElementById('passwordModal').addEventListener('click', function(e) {
                    if (e.target === this) {
                        closePasswordModal();
                    }
                });
            </script>
        </div>
    @endsection
