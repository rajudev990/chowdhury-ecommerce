@extends('admin.layouts.app')
@section('title','Create Product')

@section('content')
<section class="p-5 bg-gray-100 min-h-screen">
    <div class="mx-auto max-w-7xl">

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-12 gap-6">
                <!-- Left Column: col-span-9 -->
                <div class="col-span-12 md:col-span-8 space-y-6">
                    <!-- Basic Info Card -->
                    <div class="bg-white rounded-2xl shadow p-6 space-y-4">
                        <h3 class="text-lg font-semibold text-gray-700">Basic Information</h3>
                        <div>
                            <label class="block text-gray-700 mb-1">Product Name <span class="text-red-500">*</span></label>
                            <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-1">SKU</label>
                            <input type="text" name="sku" class="w-full border rounded px-3 py-2">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-700 mb-1">Regular Price <span class="text-red-500">*</span></label>
                                <input type="number" name="price" step="0.01" class="w-full border rounded px-3 py-2" required>
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-1">Stock</label>
                                <input type="number" name="stock" class="w-full border rounded px-3 py-2">
                            </div>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-1">Description</label>
                            <textarea name="description" class="w-full border rounded px-3 py-2" rows="4"></textarea>
                        </div>
                    </div>

                    <!-- Product Images Card -->
                    <div class="bg-white rounded-2xl shadow p-6 space-y-4">
                        <h3 class="text-lg font-semibold text-gray-700">Product Images</h3>
                        <div id="images-wrapper" class="space-y-2">
                            <div class="flex gap-2 items-center">
                                <input type="file" name="images[]" class="w-full border rounded px-3 py-2">
                                <button type="button" class="bg-red-500 text-white px-2 py-1 rounded remove-image">X</button>
                            </div>
                        </div>
                        <button type="button" id="add-image" class="mt-2 bg-cyan-600 text-white px-4 py-1 rounded hover:bg-cyan-700">Add More</button>
                    </div>


                    <!-- Variants Card -->
                    <div class="bg-white rounded-2xl shadow p-6 space-y-4">
                        <h3 class="text-lg font-semibold text-gray-700">Variants (Stock & Price)</h3>
                        <div id="variants-wrapper" class="space-y-2">
                            <div class="flex gap-2">
                                <select name="variants[0][color_id]" class="border rounded px-2 py-1" required>
                                    <option value="">Select Color</option>
                                    @foreach($colors as $color)
                                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                                    @endforeach
                                </select>
                                <select name="variants[0][size_id]" class="border rounded px-2 py-1" required>
                                    <option value="">Select Size</option>
                                    @foreach($sizes as $size)
                                    <option value="{{ $size->id }}">{{ $size->name }}</option>
                                    @endforeach
                                </select>
                                <input type="number" name="variants[0][price]" placeholder="Price" class="w-full border rounded px-2 py-1" required>
                                <input type="number" name="variants[0][stock]" placeholder="Stock" class="w-full border rounded px-2 py-1" required>
                                <button type="button" class="bg-red-500 text-white px-2 rounded remove-variant">X</button>
                            </div>
                        </div>
                        <button type="button" id="add-variant" class="mt-2 bg-cyan-600 text-white px-4 py-1 rounded hover:bg-cyan-700">Add Variant</button>
                    </div>
                </div>

                <!-- Right Column: col-span-3 -->
                <div class="col-span-12 md:col-span-4 space-y-6">
                    <!-- Category & Brand -->
                    <div class="bg-white rounded-2xl shadow p-6 space-y-4">
                        <h3 class="text-lg font-semibold text-gray-700">Category & Brand</h3>
                        <div>
                            <label class="block text-gray-700 mb-1">Category <span class="text-red-500">*</span></label>
                            <select name="category_id" id="category_id" class="w-full border rounded px-3 py-2" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-1">SubCategory <span class="text-red-500">*</span></label>
                            <select name="sub_category_id" id="sub_category_id" class="w-full border rounded px-3 py-2" required>
                                <option value="">Select SubCategory</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-1">Sub-SubCategory <span class="text-red-500">*</span></label>
                            <select name="sub_sub_category_id" id="sub_sub_category_id" class="w-full border rounded px-3 py-2" required>
                                <option value="">Select Sub-SubCategory</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-1">Brand <span class="text-red-500">*</span></label>
                            <select name="brand_id" class="w-full border rounded px-3 py-2" required>
                                <option value="">Select Brand</option>
                                @foreach($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Product Flags -->
                    <div class="bg-white rounded-2xl shadow p-6 space-y-4">
                        <h3 class="text-lg font-semibold text-gray-700">Product Flags</h3>
                        <div>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="is_featured" value="is_featured" class="form-checkbox h-5 w-5 text-cyan-600">
                                <span class="ml-2 text-gray-700">Featured Image</span>
                            </label>
                        </div>
                        <div>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="is_popular" value="is_popular" class="form-checkbox h-5 w-5 text-cyan-600">
                                <span class="ml-2 text-gray-700">Most Popular</span>
                            </label>
                        </div>
                        <div>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="is_new" value="is_new" class="form-checkbox h-5 w-5 text-cyan-600">
                                <span class="ml-2 text-gray-700">New Product</span>
                            </label>
                        </div>
                    </div>

                    <!-- Featured Images -->
                    <div class="bg-white rounded-2xl shadow p-6 space-y-4">
                        <h3 class="text-lg font-semibold text-gray-700">Featured Images</h3>
                        <label class="inline-flex items-center">Featured Image 1</label>
                        <input type="file" name="featured_image_1" class="w-full border rounded px-3 py-2">
                        <label class="inline-flex items-center">Featured Image 2</label>
                        <input type="file" name="featured_image_2" class="w-full border rounded px-3 py-2">
                    </div>

                    <!-- Status -->
                    <div class="bg-white rounded-2xl shadow p-6 space-y-4">
                        <h3 class="text-lg font-semibold text-gray-700">Status</h3>
                        <select name="status" class="w-full border rounded px-3 py-2">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <!-- Save Button -->
                    <div class="pt-4">
                        <button type="submit" class="w-full bg-cyan-600 hover:bg-cyan-700 text-white px-6 py-2 rounded-lg">Create Product</button>
                    </div>
                </div>
            </div>

        </form>
    </div>
</section>
@endsection

@section('script')
<script>
    let variantIndex = 1;

    // Add variant dynamically
    $('#add-variant').click(function() {
        let html = `<div class="flex gap-2">
        <select name="variants[${variantIndex}][color_id]" class="border rounded px-2 py-1" required>
            <option value="">Select Color</option>
            @foreach($colors as $color)
            <option value="{{ $color->id }}">{{ $color->name }}</option>
            @endforeach
        </select>
        <select name="variants[${variantIndex}][size_id]" class="border rounded px-2 py-1" required>
            <option value="">Select Size</option>
            @foreach($sizes as $size)
            <option value="{{ $size->id }}">{{ $size->name }}</option>
            @endforeach
        </select>
        <input type="number" name="variants[${variantIndex}][price]" placeholder="Price" class="w-full border rounded px-2 py-1" required>
        <input type="number" name="variants[${variantIndex}][stock]" placeholder="Stock" class="w-full border rounded px-2 py-1" required>
        <button type="button" class="bg-red-500 text-white px-2 rounded remove-variant">X</button>
    </div>`;
        $('#variants-wrapper').append(html);
        variantIndex++;
    });

    // Remove variant
    $(document).on('click', '.remove-variant', function() {
        $(this).parent().remove();
    });

    // Add more images dynamically
    $('#add-image').click(function() {
        let html = `<div class="flex gap-2 items-center">
            <input type="file" name="images[]" class="w-full border rounded px-3 py-2">
            <button type="button" class="bg-red-500 text-white px-2 py-1 rounded remove-image">X</button>
        </div>`;
        $('#images-wrapper').append(html);
    });

    // Remove image input
    $(document).on('click', '.remove-image', function() {
        $(this).parent().remove();
    });

    // AJAX for subcategories
    $('#category_id').on('change', function() {
        let id = $(this).val();
        if (id) {
            $.get('/admin/ajax/subcategories/' + id, function(data) {
                let options = '<option value="">Select SubCategory</option>';
                data.forEach(d => options += `<option value="${d.id}">${d.name}</option>`);
                $('#sub_category_id').html(options);
                $('#sub_sub_category_id').html('<option value="">Select Sub-SubCategory</option>');
            });
        } else {
            $('#sub_category_id').html('<option value="">Select SubCategory</option>');
            $('#sub_sub_category_id').html('<option value="">Select Sub-SubCategory</option>');
        }
    });

    $('#sub_category_id').on('change', function() {
        let id = $(this).val();
        if (id) {
            $.get('/admin/ajax/subsubcategories/' + id, function(data) {
                let options = '<option value="">Select Sub-SubCategory</option>';
                data.forEach(d => options += `<option value="${d.id}">${d.name}</option>`);
                $('#sub_sub_category_id').html(options);
            });
        } else {
            $('#sub_sub_category_id').html('<option value="">Select Sub-SubCategory</option>');
        }
    });
</script>
@endsection