@extends('admin.layouts.app')

@section('title', 'Banner Update')

@section('content')
<section class="p-6 bg-gray-100 min-h-screen">
    <div class="mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">

        <!-- Header -->
        <div class="bg-gradient-to-r from-cyan-600 to-cyan-500 px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-white">Banner Update</h2>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.bannars.update', $data->id) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-8">
            @csrf
            @method('PUT')

            <!-- Basic Info -->
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label for="title" class="block font-medium text-gray-700">
                        Title
                    </label>
                    <input type="text" id="title" name="title" value="{{ old('title', $data->title) }}"
                        class="w-full mt-1 border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none">
                    @error('title')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label for="description" class="block font-medium text-gray-700">
                        Description
                    </label>
                    <input type="text" id="description" name="description" value="{{ old('description', $data->description) }}"
                        class="w-full mt-1 border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none">
                    @error('description')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label for="product_link" class="block font-medium text-gray-700">
                        Button Link
                    </label>
                    <input type="text" id="product_link" name="product_link" value="{{ old('product_link', $data->product_link) }}"
                        class="w-full mt-1 border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none">
                    @error('product_link')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label for="image" class="block font-medium text-gray-700">Banner Image</label>
                    <input type="file" name="image" id="image"
                        class="mt-1 block w-full text-sm text-gray-700 border border-gray-300 rounded-lg p-1.5 focus:border-cyan-500 focus:ring-0">
                    @error('image')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                    <div class="mt-3">
                        @if($data->image)
                            <img id="preview-image" src="{{ Storage::url($data->image) }}"
                                class="rounded-lg border w-24 h-24 object-cover" alt="Banner Image Preview">
                        @else
                            <img id="preview-image" class="hidden rounded-lg border w-24 h-24 object-cover" alt="Preview">
                        @endif
                    </div>
                </div>
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
document.addEventListener("DOMContentLoaded", function () {
    const input = document.getElementById('image');
    const preview = document.getElementById('preview-image');

    input.addEventListener('change', function (event) {
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = e => {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            preview.src = '';
            preview.classList.add('hidden');
        }
    });
});
</script>
@endsection
