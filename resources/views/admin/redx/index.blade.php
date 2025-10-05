@extends('admin.layouts.app')

@section('title', 'Edit REDX')

@section('content')
<section class="p-5 bg-gray-100 min-h-screen">
    <div class="mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">

        <!-- Header -->
        <div class="bg-gradient-to-r from-cyan-600 to-cyan-500 px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-white">
                Update REDX
            </h2>
        </div>

        <!-- Form Body -->
        <div class="p-8">
            <form method="POST" action="{{ route('admin.redx.update', $data->id) }}" class="space-y-6">
                @csrf

                <div class="grid md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                           API Base URL <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="url"
                            value="{{ old('url', $data->url) }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-indigo-500 focus:ring-0 outline-none"
                            placeholder="EnterApi base url" required>
                        @error('url')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                            Store ID <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="store_id"
                            value="{{ old('store_id', $data->store_id) }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-indigo-500 focus:ring-0 outline-none"
                            placeholder="Enter Pixel ID" required>
                        @error('store_id')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                            Api Token <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="api_token"
                            value="{{ old('api_token', $data->api_token) }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-indigo-500 focus:ring-0 outline-none"
                            placeholder="Enter Pixel ID" required>
                        @error('api_token')
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