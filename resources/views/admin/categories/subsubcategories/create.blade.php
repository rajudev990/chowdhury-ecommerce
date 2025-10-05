@extends('admin.layouts.app')

@section('title', 'Add Sub-SubCategory')

@section('content')
<section class="p-5 bg-gray-100 min-h-screen">
    <div class="mx-auto max-w-2xl bg-white rounded-2xl shadow-lg overflow-hidden">

        <!-- Header -->
        <div class="bg-gradient-to-r from-cyan-600 to-cyan-500 px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-white">Add Sub-SubCategory</h2>
            <a href="{{ route('admin.subsubcategories.index') }}"
                class="bg-white/20 hover:bg-white/30 text-white px-4 py-1.5 rounded-lg transition flex items-center gap-1">
                <i class="fa fa-angle-left"></i> Back
            </a>
        </div>

        <!-- Form Body -->
        <div class="p-8">
            <form action="{{ route('admin.subsubcategories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Category -->
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Category <span class="text-red-500">*</span></label>
                    <select name="category_id" id="category_id"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                    <select name="sub_category_id" id="sub_category_id"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none" required>
                        <option value="">Select SubCategory</option>
                    </select>
                    @error('sub_category_id')
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Name -->
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Sub-SubCategory Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                        placeholder="Enter sub-subcategory name" required>
                    @error('name')
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Image -->
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Image</label>
                    <input type="file" name="image"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none">
                    @error('image')
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Status</label>
                    <select name="status"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none">
                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <!-- Submit -->
                <div class="flex justify-end pt-4 border-t">
                    <button type="submit"
                        class="bg-cyan-600 hover:bg-cyan-700 text-white px-6 py-2 rounded-lg transition flex items-center gap-2">
                        <i class="fa fa-save"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

@section('script')
<script>
    $('#category_id').on('change', function() {
    var categoryId = $(this).val();
    if (categoryId) {
        $.ajax({
            url: '/admin/ajax/subcategories/' + categoryId, // changed URL
            type: 'GET',
            success: function(data) {
                $('#sub_category_id').empty().append('<option value="">Select SubCategory</option>');
                data.forEach(function(sub) {
                    $('#sub_category_id').append('<option value="'+sub.id+'">'+sub.name+'</option>');
                });
            }
        });
    } else {
        $('#sub_category_id').empty().append('<option value="">Select SubCategory</option>');
    }
});

</script>
@endsection