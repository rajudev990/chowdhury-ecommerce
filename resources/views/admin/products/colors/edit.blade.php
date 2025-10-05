@extends('admin.layouts.app')

@section('title','Edit Color')

@section('content')
<section class="p-5 bg-gray-100 min-h-screen">
    <div class="mx-auto max-w-2xl bg-white rounded-2xl shadow-lg overflow-hidden">

        <!-- Header -->
        <div class="bg-gradient-to-r from-cyan-600 to-cyan-500 px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-white">Edit Color</h2>
            <a href="{{ route('admin.colors.index') }}" class="bg-white/20 hover:bg-white/30 text-white px-4 py-1.5 rounded-lg transition flex items-center gap-1">
                <i class="fa fa-angle-left"></i> Back
            </a>
        </div>

        <div class="p-8">
            <form action="{{ route('admin.colors.update', $color->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-gray-700 font-medium mb-1">Color Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $color->name) }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none" placeholder="Enter color name" required>
                    @error('name') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-1">Color Code</label>
                    <input type="text" name="code" value="{{ old('code', $color->code) }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none" placeholder="#ffffff">
                    @error('code') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-1">Status</label>
                    <select name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none">
                        <option value="1" {{ old('status', $color->status) == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status', $color->status) == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

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