@extends('admin.layouts.app')

@section('title', 'Edit StreadFast')

@section('content')
<section class="p-5 bg-gray-100 min-h-screen">
    <div class="mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">

        <!-- Header -->
        <div class="bg-gradient-to-r from-cyan-600 to-cyan-500 px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-white">
                Edit StreadFast
            </h2>
            <a href="{{ url()->previous() }}"
                class="bg-white/20 hover:bg-white/30 text-white px-4 py-1.5 rounded-lg transition flex items-center gap-1">
                <i class="fa fa-angle-left"></i> Back
            </a>
        </div>

        <!-- Form Body -->
        <div class="p-8">
            <form method="POST" action="{{ route('stred_fast.update', $data->id) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                            Api Key <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="api_key"
                            value="{{ old('api_key', $data->api_key) }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                            placeholder="Enter API key" required>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                            Stred Key <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="stred_key"
                            value="{{ old('stred_key', $data->stred_key) }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                            placeholder="Enter Stred key" required>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                            Status
                        </label>
                        <select name="status"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none">
                            <option value="1" {{ old('status', $data->status) == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status', $data->status) == 0 ? 'selected' : '' }}>Deactive</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end pt-4 border-t">
                    <button type="submit"
                        class="bg-cyan-600 hover:bg-cyan-700 text-white px-6 py-2 rounded-lg transition">
                        <i class="fa fa-save"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection