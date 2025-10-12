@extends('admin.layouts.app')

@section('title', 'Add Affiliate Users')

@section('content')
<section class="p-5 bg-gray-100 min-h-screen">
    <div class="mx-auto bg-white rounded-2xl shadow-lg overflow-hidden max-w-4xl">

        <!-- Header -->
        <div class="bg-gradient-to-r from-cyan-600 to-cyan-500 px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-white">
                Add Affiliate Users
            </h2>

            @can('view user')
            <a href="{{ route('admin.all-users.index') }}"
                class="bg-white/20 hover:bg-white/30 text-white px-4 py-1.5 rounded-lg transition flex items-center gap-1">
                <i class="fa fa-angle-left"></i> Back
            </a>
            @endcan
        </div>

        <!-- Form Body -->
        <div class="p-8">
            <form method="POST" action="{{ route('admin.all-users.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid md:grid-cols-2 gap-6">
                    <!-- First Name -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                            First Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="fname" value="{{ old('fname') }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                            placeholder="Enter first name" required>
                    </div>

                    <!-- Last Name -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                            Last Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="lname" value="{{ old('lname') }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                            placeholder="Enter last name" required>
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="email" value="{{ old('email') }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                            placeholder="Enter email" required>
                    </div>

                    <!-- Phone -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                            Phone <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="phone" value="{{ old('phone') }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                            placeholder="Enter phone number" required>
                    </div>

                    <!-- Username -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                            Username <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="username" value="{{ old('username') }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                            placeholder="Choose a username" required>
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                            Password <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="password"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                            placeholder="Enter password" required>
                    </div>

                    <!-- Website URL -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                            Website URL
                        </label>
                        <input type="text" name="website_url" value="{{ old('website_url') }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                            placeholder="https://example.com">
                    </div>

                    <!-- Social Media Link -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                            Social Media Link
                        </label>
                        <input type="text" name="social_media_link" value="{{ old('social_media_link') }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                            placeholder="Enter your Facebook / Instagram link">
                    </div>

                    <!-- Promotion Method -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                            Promotion Method
                        </label>
                        <input type="text" name="promotion_method" value="{{ old('promotion_method') }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                            placeholder="E.g., Facebook Ads, YouTube, Blog">
                    </div>

                    <!-- Referral Name / ID -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                            Referral Name / ID
                        </label>
                        <input type="text" name="referal_name_id" value="{{ old('referal_name_id') }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                            placeholder="Enter referral name or ID">
                    </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-1"> Image</label>
                    <input type="file" name="image" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none">
                    @error('image')
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                            Status
                        </label>
                        <select name="status"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none">
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end pt-4 border-t">
                    <button type="submit"
                        class="bg-cyan-600 hover:bg-cyan-700 text-white px-6 py-2 rounded-lg transition">
                        <i class="fa fa-save"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
