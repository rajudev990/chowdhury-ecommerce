@extends('user.layouts.app')
@section('title', 'Profile Setting')

@section('content')
<div class="min-h-screen bg-gray-100 py-10">
    <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">

        <!-- Header -->
        <div class="bg-gradient-to-r from-cyan-600 to-cyan-500 px-6 py-4">
            <h2 class="text-xl font-semibold text-white">Profile Settings</h2>
        </div>

        <!-- Form -->
        <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
            @csrf
            @method('PUT')

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

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                <input type="text" name="name" id="name"
                    value="{{ auth()->user()->name }}"
                    required
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-cyan-500 focus:ring-0 focus:outline-none transition duration-200 @error('name') border-red-500 @enderror">
                @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" id="email"
                    value="{{ auth()->user()->email }}"
                    required
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-cyan-500 focus:ring-0 focus:outline-none transition duration-200 @error('email') border-red-500 @enderror">
                @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Phone -->
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                <input type="text" name="phone" id="phone"
                    value="{{ auth()->user()->phone }}"
                    required
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-cyan-500 focus:ring-0 focus:outline-none transition duration-200 @error('phone') border-red-500 @enderror">
                @error('phone')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Image Upload -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Profile Image</label>
                <input type="file" name="image" id="image" accept="image/*"
                    class="w-full rounded-lg border border-gray-300 p-2 focus:border-cyan-500 focus:ring-0 focus:outline-none transition duration-200 @error('image') border-red-500 @enderror">

                @error('image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror

                <!-- Image Preview -->
                <div class="mt-4">
                    @if(auth()->user()->image)
                    <img id="preview-image" src="{{ Storage::url(auth()->user()->image) }}" alt="Profile Image"
                        class="w-28 h-28 object-cover rounded-lg border border-gray-300">
                    @else
                    <img id="preview-image" class="hidden w-28 h-28 object-cover rounded-lg border border-gray-300" alt="Preview Image">
                    @endif
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end pt-4 border-t">
                <button type="submit"
                    class="bg-cyan-600 hover:bg-cyan-700 text-white px-6 py-2 rounded-lg transition duration-200 flex items-center space-x-2">
                    <i class="fa fa-edit"></i>
                    <span>Update</span>
                </button>
            </div>
        </form>
    </div>
</div>

@section('script')
<script>
    document.getElementById('image').addEventListener('change', function(event) {
        const preview = document.getElementById('preview-image');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            preview.classList.add('hidden');
        }
    });
</script>
@endsection

@endsection
