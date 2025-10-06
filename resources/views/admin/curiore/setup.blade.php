@extends('admin.layouts.app')

@section('title', ' Update Curiores')

@section('content')
<section class="p-5 bg-gray-100 min-h-screen">
    <div class="max-w-6xl mx-auto space-y-10">

        <!-- StredFast -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-cyan-600 to-cyan-500 px-6 py-4 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-white">
                    Update StredFast
                </h2>
            </div>

            <!-- Form -->
            <div class="p-8">
                <form method="POST" action="{{ route('admin.stredfast.update', $stredfast->id) }}" class="space-y-6">
                    @csrf

                    <div class="grid md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">
                                API Base URL <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="url"
                                value="{{ old('url', $stredfast->url) }}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                                placeholder="Enter API key" required>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">
                                Api Key <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="api_key"
                                value="{{ old('api_key', $stredfast->api_key) }}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                                placeholder="Enter API key" required>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">
                                Secret Key <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="secret_key"
                                value="{{ old('secret_key', $stredfast->secret_key) }}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                                placeholder="Enter Stred key" required>
                        </div>

                    </div>

                    <div class="flex justify-end pt-4 border-t">
                        <button type="submit"
                            class="bg-cyan-600 hover:bg-cyan-700 text-white px-6 py-2 rounded-lg transition">
                            <i class="fa fa-edit"></i> Update StredFast
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- PATHAU Setup -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-cyan-600 to-cyan-500 px-6 py-4 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-white">
                    Update Pathau
                </h2>
            </div>

            <!-- Form -->
            <div class="p-8">
                <form method="POST" action="{{ route('admin.pathau.update', $pathau->id) }}" class="space-y-6">
                    @csrf

                    <div class="grid md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">
                                Pathao API Base URL <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="api_key"
                                value="{{ old('api_key', $pathau->api_key) }}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                                placeholder="Enter API key" required>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">
                                Store ID <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="store_id"
                                value="{{ old('store_id', $pathau->store_id) }}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                                placeholder="Enter Stred key" required>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">
                                Client ID <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="client_id"
                                value="{{ old('client_id', $pathau->client_id) }}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                                placeholder="Enter Stred key" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">
                                Client Secret <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="secret_key"
                                value="{{ old('secret_key', $pathau->secret_key) }}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                                placeholder="Enter Stred key" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">
                                Client Email <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="client_email"
                                value="{{ old('client_email', $pathau->client_email) }}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                                placeholder="Enter Stred key" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">
                                Client Password <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="client_password"
                                value="{{ old('client_password', $pathau->client_password) }}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                                placeholder="Enter Stred key" required>
                        </div>

                    </div>

                    <div class="flex justify-end pt-4 border-t">
                        <button type="submit"
                            class="bg-cyan-600 hover:bg-cyan-700 text-white px-6 py-2 rounded-lg transition">
                            <i class="fa fa-edit"></i> Update Pathau
                        </button>
                    </div>
                </form>
            </div>
        </div>


        <!-- REDX Setup -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-cyan-600 to-cyan-500 px-6 py-4 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-white">
                    Update REDX
                </h2>
            </div>

            <!-- Form -->
            <div class="p-8">
                <form method="POST" action="{{ route('admin.pathau.update', $redx->id) }}" class="space-y-6">
                    @csrf

                    <div class="grid md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">
                                API Base URL <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="url"
                                value="{{ old('url', $redx->url) }}"
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
                                value="{{ old('store_id', $redx->store_id) }}"
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
                                value="{{ old('api_token', $redx->api_token) }}"
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
                            <i class="fa fa-edit"></i> Update REDX
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Curiore -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-cyan-600 to-cyan-500 px-6 py-4 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-white">
                    Update Curiore
                </h2>
            </div>

            <!-- Form -->
            <div class="p-8">
                <form method="POST" action="{{ route('admin.curiores.update', $curiore->id) }}" class="space-y-6">
                    @csrf

                    <div class="grid md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">
                                API Base URL <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="url"
                                value="{{ old('url', $curiore->url) }}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                                placeholder="Enter API key" required>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">
                                Api Key <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="api_key"
                                value="{{ old('api_key', $curiore->api_key) }}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                                placeholder="Enter API key" required>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">
                                Secret Key <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="secret_key"
                                value="{{ old('secret_key', $curiore->secret_key) }}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                                placeholder="Enter Stred key" required>
                        </div>

                    </div>

                    <div class="flex justify-end pt-4 border-t">
                        <button type="submit"
                            class="bg-cyan-600 hover:bg-cyan-700 text-white px-6 py-2 rounded-lg transition">
                            <i class="fa fa-edit"></i> Update Curiore
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</section>
@endsection