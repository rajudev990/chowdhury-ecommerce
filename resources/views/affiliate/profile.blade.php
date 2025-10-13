@extends('affiliate.layouts.app')
@section('title', 'Profile Setting')

@section('content')
<div class="min-h-screen bg-gray-50 py-10">
    <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">

        <!-- Header -->
        <div class="bg-gradient-to-r from-cyan-600 to-cyan-500 px-8 py-5">
            <h2 class="text-2xl font-semibold text-white">Profile Settings</h2>
        </div>

        <!-- Form -->
        <form action="{{ route('affiliate.profile.update') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
            @csrf
            @method('PUT')

            {{-- Error Messages --}}
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Grid layout -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Username -->
                <div>
                    <label for="username" class="block text-sm font-semibold text-gray-700 mb-1">Username</label>
                    <input type="text" name="username" id="username"
                        value="{{ auth('affiliate')->user()->username }}"
                        required
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 focus:border-cyan-500 focus:ring-cyan-500 focus:ring-1 outline-none transition duration-200">
                </div>

                <!-- First Name -->
                <div>
                    <label for="fname" class="block text-sm font-semibold text-gray-700 mb-1">First Name</label>
                    <input type="text" name="fname" id="fname"
                        value="{{ auth('affiliate')->user()->fname }}"
                        required
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 focus:border-cyan-500 focus:ring-cyan-500 focus:ring-1 outline-none transition duration-200">
                </div>

                <!-- Last Name -->
                <div>
                    <label for="lname" class="block text-sm font-semibold text-gray-700 mb-1">Last Name</label>
                    <input type="text" name="lname" id="lname"
                        value="{{ auth('affiliate')->user()->lname }}"
                        required
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 focus:border-cyan-500 focus:ring-cyan-500 focus:ring-1 outline-none transition duration-200">
                </div>

                <!-- Phone -->
                <div>
                    <label for="phone" class="block text-sm font-semibold text-gray-700 mb-1">Phone</label>
                    <input type="text" name="phone" id="phone"
                        value="{{ auth('affiliate')->user()->phone }}"
                        required
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 focus:border-cyan-500 focus:ring-cyan-500 focus:ring-1 outline-none transition duration-200">
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" id="email"
                        value="{{ auth('affiliate')->user()->email }}"
                        required
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 focus:border-cyan-500 focus:ring-cyan-500 focus:ring-1 outline-none transition duration-200">
                </div>

                <!-- Website URL -->
                <div>
                    <label for="website_url" class="block text-sm font-semibold text-gray-700 mb-1">Website URL</label>
                    <input type="text" name="website_url" id="website_url"
                        value="{{ auth('affiliate')->user()->website_url }}"
                        required
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 focus:border-cyan-500 focus:ring-cyan-500 focus:ring-1 outline-none transition duration-200">
                </div>

                <!-- Social Link -->
                <div>
                    <label for="social_media_link" class="block text-sm font-semibold text-gray-700 mb-1">Social Media Link</label>
                    <input type="text" name="social_media_link" id="social_media_link"
                        value="{{ auth('affiliate')->user()->social_media_link }}"
                        required
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 focus:border-cyan-500 focus:ring-cyan-500 focus:ring-1 outline-none transition duration-200">
                </div>

                <!-- Promotion Method -->
                <div>
                    <label for="promotion_method" class="block text-sm font-semibold text-gray-700 mb-1">Promotion Method</label>
                    <input type="text" name="promotion_method" id="promotion_method"
                        value="{{ auth('affiliate')->user()->promotion_method }}"
                        required
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 focus:border-cyan-500 focus:ring-cyan-500 focus:ring-1 outline-none transition duration-200">
                </div>

                <!-- Referral ID -->
                <div>
                    <label for="referal_name_id" class="block text-sm font-semibold text-gray-700 mb-1">Referral ID</label>
                    <input type="text" name="referal_name_id" id="referal_name_id"
                        value="{{ auth('affiliate')->user()->referal_name_id }}"
                        required
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 focus:border-cyan-500 focus:ring-cyan-500 focus:ring-1 outline-none transition duration-200">
                </div>

                <!-- Image Upload -->
            <div>
                <label for="image" class="block text-sm font-semibold text-gray-700 mb-1">Profile Image</label>
                <input type="file" name="image" id="image" accept="image/*"
                    class="w-full rounded-xl border border-gray-300 p-2.5 focus:border-cyan-500 focus:ring-cyan-500 focus:ring-1 outline-none transition duration-200">

                <!-- Image Preview -->
                <div class="mt-4">
                    @if(auth('affiliate')->user()->image)
                        <img id="preview-image" src="{{ Storage::url(auth('affiliate')->user()->image) }}" alt="Profile Image"
                            class="w-28 h-28 object-cover rounded-lg border border-gray-300 shadow-sm">
                    @else
                        <img id="preview-image" class="hidden w-28 h-28 object-cover rounded-lg border border-gray-300 shadow-sm" alt="Preview Image">
                    @endif
                </div>
            </div>
            </div>

            

            <!-- Submit Button -->
            <div class="flex justify-end pt-6 border-t">
                <button type="submit"
                    class="bg-cyan-600 hover:bg-cyan-700 text-white font-medium px-8 py-2.5 rounded-xl transition duration-200 flex items-center space-x-2 shadow-md hover:shadow-lg">
                    <i class="fa fa-edit"></i>
                    <span>Update Profile</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

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
