@extends('admin.layouts.app')

@section('title', 'Settings Update')

@section('content')
<section class="p-6 bg-gray-100 min-h-screen">
    <div class="mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">

        <!-- Header -->
        <div class="bg-gradient-to-r from-cyan-600 to-cyan-500 px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-white">Settings Update</h2>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.settings.update', $data->id) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-8">
            @csrf
            @method('PUT')

            <!-- Basic Info -->
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label for="company_name" class="block font-medium text-gray-700">Website Name <span class="text-red-500">*</span></label>
                    <input type="text" id="company_name" name="company_name" value="{{ $data->company_name }}"
                        class="w-full mt-1 border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none" required>
                    @error('company_name')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label for="address" class="block font-medium text-gray-700">Address <span class="text-gray-500 text-sm">(optional)</span></label>
                    <input type="text" id="address" name="address" value="{{ $data->address }}"
                        class="w-full mt-1 border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none">
                    @error('address')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label for="phone_one" class="block font-medium text-gray-700">Phone Number (One)</label>
                    <input type="text" id="phone_one" name="phone_one" value="{{ $data->phone_one }}"
                        class="w-full mt-1 border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none" required>
                    @error('phone_one')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label for="phone_two" class="block font-medium text-gray-700">Phone Number (Two)</label>
                    <input type="text" id="phone_two" name="phone_two" value="{{ $data->phone_two }}"
                        class="w-full mt-1 border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none">
                    @error('phone_two')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label for="email_one" class="block font-medium text-gray-700">Email (One)</label>
                    <input type="email" id="email_one" name="email_one" value="{{ $data->email_one }}"
                        class="w-full mt-1 border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none" required>
                    @error('email_one')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label for="email_two" class="block font-medium text-gray-700">Email (Two)</label>
                    <input type="email" id="email_two" name="email_two" value="{{ $data->email_two }}"
                        class="w-full mt-1 border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none">
                    @error('email_two')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>
            </div>

            <!-- Social Links -->
            <div>
                <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">Social Media Links</h3>
                <div class="grid md:grid-cols-2 gap-6">
                    @foreach(['facebook', 'twitter', 'linkedin', 'youtube', 'instagram'] as $social)
                        <div>
                            <label for="{{ $social }}" class="block font-medium text-gray-700 capitalize">{{ ucfirst($social) }}</label>
                            <input type="text" id="{{ $social }}" name="{{ $social }}" value="{{ $data->$social }}"
                                class="w-full mt-1 border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                                placeholder="Enter your {{ $social }} link">
                            @error($social)<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Logos -->
            <div>
                <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">Logos & Favicon</h3>
                <div class="grid md:grid-cols-3 gap-6">
                    @foreach (['header_logo' => 'Header Logo', 'footer_logo' => 'Footer Logo', 'favicon' => 'Favicon'] as $field => $label)
                        <div>
                            <label for="{{ $field }}" class="block font-medium text-gray-700">{{ $label }}</label>
                            <input type="file" name="{{ $field }}" id="{{ $field }}"
                                class="mt-1 block w-full text-sm text-gray-700 border border-gray-300 rounded-lg p-1.5 focus:border-cyan-500 focus:ring-0">
                            @error($field)<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                            <div class="mt-3">
                                @if($data->$field)
                                    <img id="preview-{{ $field }}" src="{{ Storage::url($data->$field) }}"
                                         class="rounded-lg border w-24 h-24 object-cover" alt="preview">
                                @else
                                    <img id="preview-{{ $field }}" class="hidden rounded-lg border w-24 h-24 object-cover">
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Google Maps -->
            <div>
                <label for="google_maps" class="block font-medium text-gray-700">Google Maps</label>
                <textarea id="google_maps" name="google_maps" rows="3"
                    class="w-full mt-1 border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none">{!! $data->google_maps !!}</textarea>
                @error('google_maps')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>

            <!-- Meta Section -->
            <div>
                <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">SEO Metadata</h3>
                <div class="space-y-6">
                    <div>
                        <label for="meta_title" class="block font-medium text-gray-700">Meta Title</label>
                        <input type="text" name="meta_title" id="meta_title" value="{{ $data->meta_title }}"
                            class="w-full mt-1 border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none">
                    </div>

                    <div>
                        <label for="meta_description" class="block font-medium text-gray-700">Meta Description</label>
                        <textarea id="meta_description" name="meta_description" rows="4"
                            class="w-full mt-1 border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none">{!! $data->meta_description !!}</textarea>
                    </div>

                    <div>
                        <label for="meta_keyword" class="block font-medium text-gray-700">Meta Keywords</label>
                        <textarea id="meta_keyword" name="meta_keyword" rows="3"
                            class="w-full mt-1 border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none">{!! $data->meta_keyword !!}</textarea>
                    </div>

                    <div>
                        <label for="meta_image" class="block font-medium text-gray-700">Meta Image</label>
                        <input type="file" name="meta_image" id="meta_image"
                            class="mt-1 block w-full text-sm text-gray-700 border border-gray-300 rounded-lg p-1.5 focus:border-cyan-500 focus:ring-0">
                        @error('meta_image')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                        <div class="mt-3">
                            @if($data->meta_image)
                                <img id="preview-meta_image" src="{{ Storage::url($data->meta_image) }}"
                                     class="rounded-lg border w-24 h-24 object-cover" alt="preview">
                            @else
                                <img id="preview-meta_image" class="hidden rounded-lg border w-24 h-24 object-cover">
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div>
                <label for="copyright" class="block font-medium text-gray-700">Copyright</label>
                <input type="text" id="copyright" name="copyright" value="{{ $data->copyright }}"
                    class="w-full mt-1 border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                    placeholder="© 2025 Your Company">
            </div>

            <!-- Submit -->
            <div class="flex justify-end pt-6 border-t">
                <button type="submit"
                    class="bg-cyan-600 hover:bg-cyan-700 text-white px-6 py-2 rounded-lg transition flex items-center gap-2">
                    <i class="fa fa-edit"></i> Update
                </button>
            </div>
        </form>
    </div>
</section>
@endsection

@section('script')
<script>
    // Image preview logic for all image fields
    ['header_logo', 'footer_logo', 'favicon', 'meta_image'].forEach(id => {
        document.getElementById(id).addEventListener('change', function (event) {
            const preview = document.getElementById(`preview-${id}`);
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = e => {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                preview.classList.add('hidden');
            }
        });
    });
</script>
@endsection
