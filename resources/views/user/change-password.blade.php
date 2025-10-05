@extends('user.layouts.app')
@section('title', 'Password Update')

@section('content')
<div class="min-h-screen bg-gray-100 py-10">
    <div class="max-w-xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">

        <!-- Header -->
        <div class="bg-gradient-to-r from-cyan-600 to-cyan-500 px-6 py-4">
            <h2 class="text-xl font-semibold text-white">Update Password</h2>
        </div>

        <!-- Form -->
        <form action="{{ route('user.password.update') }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('POST')

            {{-- Error Messages --}}
            @if ($errors->any())
            <div class="bg-red-50 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Current Password -->
            <div class="relative">
                <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                <input type="password" name="current_password" id="current_password" required
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-cyan-500 focus:ring-0 focus:outline-none transition duration-200 @error('current_password') border-red-500 @enderror">
                <span onclick="togglePassword('current_password', this)"
                    class="absolute right-3 top-1/2 cursor-pointer text-gray-400">👁️</span>
                @error('current_password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- New Password -->
            <div class="relative">
                <label for="new_password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                <input type="password" name="new_password" id="new_password" required
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-cyan-500 focus:ring-0 focus:outline-none transition duration-200 @error('new_password') border-red-500 @enderror">
                <span onclick="togglePassword('new_password', this)"
                    class="absolute right-3 top-1/2 cursor-pointer text-gray-400">👁️</span>
                @error('new_password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm New Password -->
            <div class="relative">
                <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                <input type="password" name="new_password_confirmation" id="new_password_confirmation" required
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-cyan-500 focus:ring-0 focus:outline-none transition duration-200 @error('new_password_confirmation') border-red-500 @enderror">
                <span onclick="togglePassword('new_password_confirmation', this)"
                    class="absolute right-3 top-1/2 cursor-pointer text-gray-400">👁️</span>
                @error('new_password_confirmation')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end pt-4 border-t">
                <button type="submit"
                    class="bg-cyan-600 hover:bg-cyan-700 text-white px-6 py-2 rounded-lg transition duration-200 flex items-center gap-2">
                    <i class="fa fa-edit"></i>
                    <span>Update</span>
                </button>
            </div>
        </form>
    </div>
</div>
<script>
    function togglePassword(fieldId, el) {
        const input = document.getElementById(fieldId);
        if (input.type === 'password') {
            input.type = 'text';
            el.textContent = '🙈';
        } else {
            input.type = 'password';
            el.textContent = '👁️';
        }
    }
</script>

@endsection
