@extends('admin.layouts.app')

@section('title','Edit Sub-SubCategory')

@section('content')
<section class="p-5 bg-gray-100 min-h-screen">
    <div class="mx-auto max-w-2xl bg-white rounded-2xl shadow-lg overflow-hidden">

        <!-- Header -->
        <div class="bg-gradient-to-r from-cyan-600 to-cyan-500 px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-white">Edit Sub-SubCategory</h2>
            <a href="{{ route('admin.subsubcategories.index') }}"
                class="bg-white/20 hover:bg-white/30 text-white px-4 py-1.5 rounded-lg transition flex items-center gap-1">
                <i class="fa fa-angle-left"></i> Back
            </a>
        </div>

        <!-- Form Body -->
        <div class="p-8">
            <form action="{{ route('admin.subsubcategories.update', $subSubCategory->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Category -->
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Category <span class="text-red-500">*</span></label>
                    <select name="category_id" id="category_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $subSubCategory->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- SubCategory -->
                <div>
                    <label class="block text-gray-700 font-medium mb-1">SubCategory <span class="text-red-500">*</span></label>
                    <select name="sub_category_id" id="sub_category_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none" required>
                        <option value="">Select SubCategory</option>
                        @foreach($subcategories as $sub)
                        <option value="{{ $sub->id }}" {{ $subSubCategory->sub_category_id == $sub->id ? 'selected' : '' }}>
                            {{ $sub->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('sub_category_id')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Name -->
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Sub-SubCategory Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $subSubCategory->name) }}" 
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none" placeholder="Enter Sub-SubCategory name" required>
                    @error('name')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Image -->
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Image</label>
                    @if($subSubCategory->image)
                        <img src="{{ asset('storage/'.$subSubCategory->image) }}" class="w-24 h-24 rounded mb-2">
                    @endif
                    <input type="file" name="image" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none">
                    @error('image')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Status</label>
                    <select name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none">
                        <option value="1" {{ $subSubCategory->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $subSubCategory->status == 0 ? 'selected' : '' }}>Inactive</option>
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

@section('script')
<script>
    // Ajax to dynamically load subcategories based on selected category
    $('#category_id').on('change', function() {
        var categoryId = $(this).val();
        if (categoryId) {
            $.ajax({
                url: '/admin/ajax/subcategories/' + categoryId,
                type: 'GET',
                success: function(data) {
                    $('#sub_category_id').empty().append('<option value="">Select SubCategory</option>');
                    data.forEach(function(sub) {
                        $('#sub_category_id').append('<option value="' + sub.id + '">' + sub.name + '</option>');
                    });
                },
                error: function() {
                    $('#sub_category_id').empty().append('<option value="">Select SubCategory</option>');
                }
            });
        } else {
            $('#sub_category_id').empty().append('<option value="">Select SubCategory</option>');
        }
    });
</script>
@endsection
