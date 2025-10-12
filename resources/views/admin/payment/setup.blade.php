@extends('admin.layouts.app')

@section('title', 'Payment Gateway Setup')

@section('content')
<section class="p-5 bg-gray-100 min-h-screen">
    <div class="max-w-6xl mx-auto space-y-10">

        <!-- Bkash Setup -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-cyan-600 to-cyan-500 px-6 py-4 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-white">
                    Update Bkash Setup
                </h2>
            </div>

            <!-- Form -->
            <div class="p-8">
                <form method="POST" action="{{ route('admin.bkash.update', $bkash->id) }}" class="space-y-6">
                    @csrf

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">
                                Bkash App Key <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="bkash_app_key"
                                value="{{ old('bkash_app_key', $bkash->bkash_app_key) }}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                                placeholder="Enter Bkash App Key" required>
                            @error('bkash_app_key')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">
                                Bkash Secret Key <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="bkash_secret_key"
                                value="{{ old('bkash_secret_key', $bkash->bkash_secret_key) }}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                                placeholder="Enter Bkash Secret Key" required>
                            @error('bkash_secret_key')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">
                                Bkash Username <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="bkash_username"
                                value="{{ old('bkash_username', $bkash->bkash_username) }}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                                placeholder="Enter Bkash Username" required>
                            @error('bkash_username')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">
                                Bkash Password <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="bkash_password"
                                value="{{ old('bkash_password', $bkash->bkash_password) }}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                                placeholder="Enter Bkash Password" required>
                            @error('bkash_password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select name="status"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-cyan-500 transition">
                                <option value="1" {{ old('status', $bkash->status ?? '') == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status', $bkash->status ?? '') == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-end pt-4 border-t">
                        <button type="submit"
                            class="bg-cyan-600 hover:bg-cyan-700 text-white px-6 py-2 rounded-lg transition">
                            <i class="fa fa-edit"></i> Update Bkash
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Nagad Setup -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-cyan-600 to-cyan-500 px-6 py-4 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-white">
                    Update Nagad Setup
                </h2>
            </div>

            <!-- Form -->
            <div class="p-8">
                <form method="POST" action="{{ route('admin.nagad.update', $nagad->id) }}" class="space-y-6">
                    @csrf

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">
                                Nagad App Key <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nagad_app_key"
                                value="{{ old('nagad_app_key', $nagad->nagad_app_key) }}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                                placeholder="Enter Nagad App Key" required>
                            @error('nagad_app_key')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">
                                Nagad Secret Key <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nagad_secret_key"
                                value="{{ old('nagad_secret_key', $nagad->nagad_secret_key) }}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                                placeholder="Enter Nagad Secret Key" required>
                            @error('nagad_secret_key')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">
                                Nagad Username <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nagad_username"
                                value="{{ old('nagad_username', $nagad->nagad_username) }}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                                placeholder="Enter Nagad Username" required>
                            @error('nagad_username')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">
                                Nagad Password <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nagad_password"
                                value="{{ old('nagad_password', $nagad->nagad_password) }}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                                placeholder="Enter Nagad Password" required>
                            @error('nagad_password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select name="status"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-cyan-500 transition">
                                <option value="1" {{ old('status', $nagad->status ?? '') == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status', $nagad->status ?? '') == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-end pt-4 border-t">
                        <button type="submit"
                            class="bg-cyan-600 hover:bg-cyan-700 text-white px-6 py-2 rounded-lg transition">
                            <i class="fa fa-edit"></i> Update Nagad
                        </button>
                    </div>
                </form>
            </div>
        </div>


        <!-- SSLcommerz Setup -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-cyan-600 to-cyan-500 px-6 py-4 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-white">
                    Update SSLcommerz
                </h2>
            </div>

            <!-- Form -->
            <div class="p-8">
                <form method="POST" action="{{ route('admin.sslcz.update', $sslcz->id) }}" class="space-y-6">
                    @csrf

                    <div class="grid md:grid-cols-2 gap-6">

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">
                                SSLcz Store ID <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="sslcz_store_id"
                                value="{{ old('sslcz_store_id', $sslcz->sslcz_store_id) }}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                                placeholder="Enter Nagad Secret Key" required>
                            @error('sslcz_store_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">
                                SSLcz Password <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="sslcz_store_password"
                                value="{{ old('sslcz_store_password', $sslcz->sslcz_store_password) }}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                                placeholder="Enter Nagad Password" required>
                            @error('sslcz_store_password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">
                                SSLcz Sandbox <span class="text-red-500">*</span>
                            </label>
                            <select name="sslcommerz_sandbox"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-cyan-500 transition">
                                <option value="live" {{ old('sslcommerz_sandbox', $sslcz->sslcommerz_sandbox ?? '') == 'live' ? 'selected' : '' }}>Live</option>
                                <option value="test" {{ old('sslcommerz_sandbox', $sslcz->sslcommerz_sandbox ?? '') == 'test' ? 'selected' : '' }}>Test</option>
                            </select>
                            @error('sslcommerz_sandbox')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select name="status"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-cyan-500 transition">
                                <option value="1" {{ old('status', $sslcz->status ?? '') == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status', $sslcz->status ?? '') == 0 ? 'selected' : '' }}>InActive</option>
                            </select>
                            @error('status')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="flex justify-end pt-4 border-t">
                        <button type="submit"
                            class="bg-cyan-600 hover:bg-cyan-700 text-white px-6 py-2 rounded-lg transition">
                            <i class="fa fa-edit"></i> Update SSLcz
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</section>
@endsection