@extends('admin.layouts.app')

@section('title', '  Update Marketing Information')

@section('content')
<section class="p-5 bg-gray-100 min-h-screen">
    <div class="max-w-6xl mx-auto space-y-10">

        <!-- Bkash Setup -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-cyan-600 to-cyan-500 px-6 py-4 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-white">
                     Update FaceBook Pixel Setting
                </h2>
            </div>

            <!-- Form -->
            <div class="p-8">
                 <form method="POST" action="{{ route('admin.facebook.update', $facebook->id) }}" class="space-y-6">
                    @csrf

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">
                                Facebook Pixel ID <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="facebook_id"
                                value="{{ old('facebook_id', $facebook->facebook_id) }}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                                placeholder="Enter Bkash App Key" required>
                            @error('facebook_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>


                        <div>
                            <label class="block text-gray-700 font-medium mb-1">
                                Facebook Pixel <span class="text-red-500">*</span>
                            </label>
                            <select name="facebook_status"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-cyan-500 transition">
                                <option value="1" {{ old('facebook_status', $facebook->facebook_status ?? '') == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('facebook_status', $facebook->facebook_status ?? '') == 0 ? 'selected' : '' }}>Deactive</option>
                            </select>
                            @error('facebook_status')
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

      


        <!-- Google Setup -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-cyan-600 to-cyan-500 px-6 py-4 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-white">
                 Google Analytics Setting
                </h2>
            </div>

            <!-- Form -->
            <div class="p-8">
                <form method="POST" action="{{ route('admin.google.update', $google->id) }}" class="space-y-6">
                    @csrf

                    <div class="grid md:grid-cols-2 gap-6">

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">
                                Tracking ID <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="google_id"
                                value="{{ old('google_id', $google->google_id) }}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                                placeholder="Enter Nagad Secret Key" required>
                            @error('google_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                       

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">
                                Google Analytics <span class="text-red-500">*</span>
                            </label>
                            <select name="google_status"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-cyan-500 transition">
                                <option value="1" {{ old('google_status', $google->google_status ?? '') == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('google_status', $google->google_status ?? '') == 0 ? 'selected' : '' }}>Deactive</option>
                            </select>
                            @error('google_status')
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

    </div>
</section>
@endsection