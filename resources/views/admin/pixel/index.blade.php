@extends('admin.layouts.app')

@section('title', 'Edit Pixels')

@section('content')
<section class="p-5 bg-gray-100 min-h-screen">
    <div class="mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">

        <!-- Header -->
        <div class="bg-gradient-to-r from-cyan-600 to-cyan-500 px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-white">
                Edit Pixels
            </h2>
        </div>

        <!-- Form Body -->
        <div class="p-8">
            <form method="POST" action="{{ route('admin.pixel.update', $data->id) }}" class="space-y-6">
                @csrf

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                            Pixel Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="pixel_name"
                            value="{{ old('pixel_name', $data->pixel_name) }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-indigo-500 focus:ring-0 outline-none"
                            placeholder="Enter Pixel Name" required>
                        @error('pixel_name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                            Pixel ID <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="pixel_id"
                            value="{{ old('pixel_id', $data->pixel_id) }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-indigo-500 focus:ring-0 outline-none"
                            placeholder="Enter Pixel ID" required>
                        @error('pixel_id')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-gray-700 font-medium mb-1">
                            Pixel Code
                        </label>
                        <textarea name="pixel_code" rows="5"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-indigo-500 focus:ring-0 outline-none"
                            placeholder="Paste Pixel Code here">{{ old('pixel_code', $data->pixel_code) }}</textarea>
                        @error('pixel_code')
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