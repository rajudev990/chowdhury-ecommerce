@extends('admin.layouts.app')

@section('title', 'Edit Marketing')

@section('content')
<section class="p-5 bg-gray-100 min-h-screen">
    <div class="mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">

        <!-- Header -->
        <div class="bg-gradient-to-r from-cyan-600 to-cyan-500 px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-white">
              Marketing Information
            </h2>
        </div>

        <!-- Form Body -->
        <div class="p-8">
            <form method="POST" action="{{ route('admin.marketing.update', $data->id) }}" class="space-y-6">
                @csrf

                <div class="grid md:grid-cols-2 gap-6">
               
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                           Facebook Pixel Code<span class="text-red-500">*</span>
                        </label>
                        <textarea name="facebook_pixel_code" rows="2"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                            placeholder="Enter Bkash App Key" required>{{ old('facebook_pixel_code', $data->facebook_pixel_code) }}</textarea>
                        @error('facebook_pixel_code')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Bkash Secret Key -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                           Facebook Domain Verification <span class="text-red-500">*</span>
                        </label>
                        <textarea name="facebook_domain_verification" rows="2"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                            placeholder="Enter Bkash Secret Key" required>{{ old('facebook_domain_verification', $data->facebook_domain_verification) }}</textarea>
                        @error('facebook_domain_verification')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Bkash Username -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                           Google Analytics (For Header)<span class="text-red-500">*</span>
                        </label>
                        <textarea name="google_analytics_header" rows="2"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                            placeholder="Enter Bkash Username" required>{{ old('google_analytics_header', $data->google_analytics_header) }}</textarea>
                        @error('google_analytics_header')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Bkash Password -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                           Google Domain Verification <span class="text-red-500">*</span>
                        </label>
                        <textarea name="google_domain_verification" rows="2"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                            placeholder="Enter Bkash Password" required>{{ old('google_domain_verification', $data->google_domain_verification) }}</textarea>
                        @error('google_domain_verification')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                      <div>
                        <label class="block text-gray-700 font-medium mb-1">
                          Google (Body Tag) <span class="text-red-500">*</span>
                        </label>
                        <textarea name="google_body_tag" rows="2"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                            placeholder="Enter Bkash Password" required>{{ old('google_body_tag', $data->google_body_tag) }}</textarea>
                        @error('google_body_tag')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

        
                </div>

                <!-- Submit Button -->
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
