@extends('admin.layouts.app')

@section('title', 'Update Affiliate Users')

@section('content')
<section class="p-5 bg-gray-100 min-h-screen">
    <div class="mx-auto bg-white rounded-2xl shadow-lg overflow-hidden max-w-4xl">

        <!-- Header -->
        <div class="bg-gradient-to-r from-cyan-600 to-cyan-500 px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-white">
                Update Affiliate Users
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
            <form method="POST" action="{{ route('admin.all-users.update', $data->id) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid md:grid-cols-2 gap-6">
                    <!-- First Name -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                            First Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="fname" value="{{$data->fname}}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                            placeholder="Enter first name" required>
                    </div>

                    <!-- Last Name -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                            Last Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="lname" value="{{$data->lname}} "
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                            placeholder="Enter last name" required>
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="email" value="{{$data->email}} "
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                            placeholder="Enter email" required>
                    </div>

                    <!-- Phone -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                            Phone <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="phone" value="{{$data->phone}}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                            placeholder="Enter phone number" required>
                    </div>

                    <!-- Username -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                            Username <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="username" value="{{$data->username}}"
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
                        <input type="text" name="website_url" value="{{$data->website_url}}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                            placeholder="https://example.com">
                    </div>

                    <!-- Social Media Link -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                            Social Media Link
                        </label>
                        <input type="text" name="social_media_link" value="{{$data->social_media_link}}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                            placeholder="Enter your Facebook / Instagram link">
                    </div>

                    <!-- Promotion Method -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                            Promotion Method
                        </label>
                        <input type="text" name="promotion_method" value="{{$data->promotion_method}}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                            placeholder="E.g., Facebook Ads">
                    </div>

                    <!-- Referral Name / ID -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                            Referral Name / ID
                        </label>
                        <input type="text" name="referal_name_id" value="{{$data->referal_name_id}}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                            placeholder="Enter referral name or ID">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Image</label>
                        <input type="file" name="image"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none">
                        @if($data->image)
                        <div class="mt-2">
                            <img src="{{ Storage::url($data->image) }}" class="w-24 h-24 rounded-lg border">
                        </div>
                        @endif
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
                            <option value="pending" {{$data->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="active" {{$data->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="rejected" {{$data->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end pt-4 border-t">
                    <button type="submit"
                        class="bg-cyan-600 hover:bg-cyan-700 text-white px-6 py-2 rounded-lg transition">
                        <i class="fa fa-edit"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection