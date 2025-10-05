@extends('admin.layouts.app')

@section('title', 'Edit Brand')

@section('content')
<section class="p-5 bg-gray-100 min-h-screen">
    <div class="mx-auto max-w-2xl bg-white rounded-2xl shadow-lg overflow-hidden">

        <!-- Header -->
        <div class="bg-gradient-to-r from-cyan-600 to-cyan-500 px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-white">Edit Brand</h2>
            <a href="{{ route('admin.brands.index') }}" class="bg-white/20 hover:bg-white/30 text-white px-4 py-1.5 rounded-lg transition flex items-center gap-1">
                <i class="fa fa-angle-left"></i> Back
            </a>
        </div>

        <!-- Form -->
        <div class="p-8">
            <form action="{{ route('admin.brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Brand Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $brand->name) }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none" placeholder="Enter brand name" required>
                    @error('name')
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Logo -->
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Brand Logo</label>
                    @if($brand->logo)
                    <img src="{{ asset('storage/'.$brand->logo) }}" class="w-24 h-24 rounded mb-2">
                    @endif
                    <input type="file" name="logo" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none">
                    @error('logo')
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Status</label>
                    <select name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none">
                        <option value="1" {{ old('status', $brand->status) == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status', $brand->status) == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit -->
                <div class="flex justify-end pt-4 border-t">
                    <button type="submit" class="bg-cyan-600 hover:bg-cyan-700 text-white px-6 py-2 rounded-lg transition flex items-center gap-2">
                        <i class="fa fa-save"></i> Update
                    </button>
                </div>

            </form>
        </div>
    </div>
</section>
@endsection