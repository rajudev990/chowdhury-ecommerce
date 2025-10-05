@extends('admin.layouts.app')

@section('title', 'Edit Pathau')

@section('content')
<section class="p-5 bg-gray-100 min-h-screen">
    <div class="mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">

        <!-- Header -->
        <div class="bg-gradient-to-r from-cyan-600 to-cyan-500 px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-white">
                Edit Pathau
            </h2>
        </div>

        <!-- Form Body -->
        <div class="p-8">
            <form method="POST" action="{{ route('admin.pathau.update', $data->id) }}" class="space-y-6">
                @csrf

                <div class="grid md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                           Pathao API Base URL <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="api_key"
                            value="{{ old('api_key', $data->api_key) }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                            placeholder="Enter API key" required>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                           Store ID <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="store_id"
                            value="{{ old('store_id', $data->store_id) }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                            placeholder="Enter Stred key" required>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                            Client ID <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="client_id"
                            value="{{ old('client_id', $data->client_id) }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                            placeholder="Enter Stred key" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                           Client Secret <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="secret_key"
                            value="{{ old('secret_key', $data->secret_key) }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                            placeholder="Enter Stred key" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                           Client Email <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="client_email"
                            value="{{ old('client_email', $data->client_email) }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                            placeholder="Enter Stred key" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                           Client Password <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="client_password"
                            value="{{ old('client_password', $data->client_password) }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                            placeholder="Enter Stred key" required>
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