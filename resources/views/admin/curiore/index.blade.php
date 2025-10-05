@extends('admin.layouts.app')

@section('title', 'Edit Curiore')

@section('content')
<section class="p-5 bg-gray-100 min-h-screen">
    <div class="mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">

        <!-- Header -->
        <div class="bg-gradient-to-r from-cyan-600 to-cyan-500 px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-white">
                Edit Curiore
            </h2>
        </div>

        <!-- Form Body -->
        <div class="p-8">
            <form method="POST" action="{{ route('admin.curiore.update', $data->id) }}" class="space-y-6">
                @csrf

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
                            Secret Key <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="secret_key"
                            value="{{ old('secret_key', $data->secret_key) }}"
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
                        <i class="fa fa-edit"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection