@extends('admin.layouts.app')

@section('title', 'Edit Bkash')

@section('content')
<section class="p-5 bg-gray-100 min-h-screen">
    <div class="mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">

        <!-- Header -->
        <div class="bg-gradient-to-r from-cyan-600 to-cyan-500 px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-white">
                Bkash Setup
            </h2>
        </div>

        <!-- Form Body -->
        <div class="p-8">
            <form method="POST" action="{{ route('admin.bkash.update', $data->id) }}" class="space-y-6">
                @csrf

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                            Bkash App Key<span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="bkash_app_key"
                            value="{{ old('bkash_app_key', $data->bkash_app_key) }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-indigo-500 focus:ring-0 outline-none"
                            placeholder="Enter Bkash App Key " required>
                        @error('bkash_app_key')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                            Bkash Secrect Key <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="bkash_secret_key"
                            value="{{ old('bkash_secret_key', $data->bkash_secret_key) }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-indigo-500 focus:ring-0 outline-none"
                            placeholder="Enter  Bkash Secrect Key" required>
                        @error('bkash_secret_key')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                            Bkash Username <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="bkash_username"
                            value="{{ old('bkash_username', $data->bkash_username) }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-indigo-500 focus:ring-0 outline-none"
                            placeholder="Enter  Bkash Secrect Key" required>
                        @error('bkash_username')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>


                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                            Bkash Password <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="bkash_password"
                            value="{{ old('bkash_password', $data->bkash_password) }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-indigo-500 focus:ring-0 outline-none"
                            placeholder="Enter  Bkash Secrect Key" required>
                        @error('bkash_password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select name="status" id="status"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-white text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                            <option value="1" {{ old('status', $data->status ?? '') == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status', $data->status ?? '') == 0 ? 'selected' : '' }}>Deactive</option>
                        </select>
                        @error('status')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>


                </div>

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