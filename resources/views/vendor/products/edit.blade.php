@extends('vendor.layouts.app')
@section('title','Edit Product')

@section('content')
<section class="p-5 bg-gray-100 min-h-screen">
    <div class="mx-auto max-w-7xl">

        {{-- Show Validation Errors --}}
        @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('vendor.products.update',$product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-12 gap-6">

                <!-- Left Column -->
                <div class="col-span-12 md:col-span-8 space-y-6">

                    <!-- Basic Info -->
                    <div class="bg-white rounded-2xl shadow p-6 space-y-4">
                        <h3 class="text-lg font-semibold text-gray-700">Basic Information</h3>
                        <div>
                            <label class="block text-gray-700 mb-1">Product Name <span class="text-red-500">*</span></label>
                            <input type="text" name="name" value="{{ $product->name }}" class="w-full border rounded px-3 py-2" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-1">SKU</label>
                            <input type="text" name="sku" value="{{ $product->sku }}" class="w-full border rounded px-3 py-2">
                        </div>
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <label class="block text-gray-700 mb-1">Purchases Price({{currency()}})<span class="text-red-500">*</span></label>
                                <input type="number" name="purchase_price" step="0.01" class="w-full border rounded px-3 py-2" value="{{ $product->purchase_price }}" required>
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-1">Regular Price({{currency()}})<span class="text-red-500">*</span></label>
                                <input type="number" name="regular_price" step="0.01" value="{{ $product->regular_price }}" class="w-full border rounded px-3 py-2" required>
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-1">Sales Price({{currency()}})<span class="text-red-500">*</span></label>
                                <input type="number" name="sale_price" step="0.01" value="{{ $product->sale_price }}" class="w-full border rounded px-3 py-2" required>
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-1">Units</label>
                                <input type="text" name="unit" step="0.01" class="w-full border rounded px-3 py-2" value="{{ $product->unit }}" placeholder="pcs,kg etc">
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-1">Stock</label>
                                <input type="number" name="stock" value="{{ $product->stock }}" class="w-full border rounded px-3 py-2">
                            </div>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-1">Description</label>
                            <textarea name="description" class="w-full border rounded px-3 py-2" rows="4">{{ $product->description }}</textarea>
                        </div>
                    </div>

                    <!-- Product Images -->
                    <div class="bg-white rounded-2xl shadow p-6 space-y-4">
                        <h3 class="text-lg font-semibold text-gray-700">Product Images</h3>
                        <div id="images-wrapper" class="space-y-2">
                            @foreach($product->images as $img)
                            <div class="flex gap-2 items-center existing-image">
                                <img src="{{ Storage::url($img->image) }}" class="w-20 h-20 object-cover rounded">
                                <input type="file" name="images[]" class="w-full border rounded px-3 py-2">
                                <a href="{{ route('admin.products.removeImage', $img->id) }}" class="bg-red-500 text-white px-2 py-1 rounded remove-existing-image">X</a>
                            </div>
                            @endforeach
                        </div>

                        <button type="button" id="add-image" class="mt-2 bg-cyan-600 text-white px-4 py-1 rounded hover:bg-cyan-700">Add More</button>
                    </div>

                    <!-- Variants -->
                    <div class="bg-white rounded-2xl shadow p-6 space-y-4">
                        <h3 class="text-lg font-semibold text-gray-700">Variants (Stock & Price)</h3>
                        <div id="variants-wrapper" class="space-y-2">
                            @foreach($product->variants as $index => $variant)
                            <div class="flex gap-2 variant-row">
                                <select name="variants[{{ $index }}][color_id]" class="border rounded px-2 py-1">
                                    <option value="">Select Color</option>
                                    @foreach($colors as $color)
                                    <option value="{{ $color->id }}" {{ $variant->color_id==$color->id?'selected':'' }}>{{ $color->name }}</option>
                                    @endforeach
                                </select>
                                <select name="variants[{{ $index }}][size_id]" class="border rounded px-2 py-1">
                                    <option value="">Select Size</option>
                                    @foreach($sizes as $size)
                                    <option value="{{ $size->id }}" {{ $variant->size_id==$size->id?'selected':'' }}>{{ $size->name }}</option>
                                    @endforeach
                                </select>
                                <input type="number" name="variants[{{ $index }}][price]" value="{{ $variant->price }}" placeholder="Price" class="w-full border rounded px-2 py-1">
                                <input type="number" name="variants[{{ $index }}][stock]" value="{{ $variant->stock }}" placeholder="Stock" class="w-full border rounded px-2 py-1">
                                <button type="button" class="bg-red-500 text-white px-2 rounded remove-variant">X</button>
                            </div>
                            @endforeach
                        </div>
                        <button type="button" id="add-variant" class="mt-2 bg-cyan-600 text-white px-4 py-1 rounded hover:bg-cyan-700">Add Variant</button>
                    </div>

                </div>

                <!-- Right Column -->
                <div class="col-span-12 md:col-span-4 space-y-6">

                    <!-- Category & Brand -->
                    <div class="bg-white rounded-2xl shadow p-6 space-y-4">
                        <h3 class="text-lg font-semibold text-gray-700">Category & Brand</h3>
                        <div>
                            <label class="block text-gray-700 mb-1">Category <span class="text-red-500">*</span></label>
                            <select name="category_id" id="category_id" class="w-full border rounded px-3 py-2" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->category_id==$category->id?'selected':'' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-1">SubCategory <span class="text-red-500">*</span></label>
                            <select name="sub_category_id" id="sub_category_id" class="w-full border rounded px-3 py-2">
                                <option value="">Select SubCategory</option>
                                @foreach($subcategories as $sub)
                                <option value="{{ $sub->id }}" {{ $product->sub_category_id==$sub->id?'selected':'' }}>{{ $sub->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-1">Sub-SubCategory <span class="text-red-500">*</span></label>
                            <select name="sub_sub_category_id" id="sub_sub_category_id" class="w-full border rounded px-3 py-2">
                                <option value="">Select Sub-SubCategory</option>
                                @foreach($subsubcategories as $subsub)
                                <option value="{{ $subsub->id }}" {{ $product->sub_sub_category_id==$subsub->id?'selected':'' }}>{{ $subsub->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-1">Brand <span class="text-red-500">*</span></label>
                            <select name="brand_id" class="w-full border rounded px-3 py-2">
                                <option value="">Select Brand</option>
                                @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ $product->brand_id==$brand->id?'selected':'' }}>{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Flags -->
                    <div class="bg-white rounded-2xl shadow p-6 space-y-4">
                        <h3 class="text-lg font-semibold text-gray-700">Product Flags</h3>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="is_featured" value="1" class="form-checkbox h-5 w-5 text-cyan-600" {{ $product->is_featured?'checked':'' }}>
                            <span class="ml-2 text-gray-700">Featured</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="is_popular" value="1" class="form-checkbox h-5 w-5 text-cyan-600" {{ $product->is_popular?'checked':'' }}>
                            <span class="ml-2 text-gray-700">Most Popular</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="is_new" value="1" class="form-checkbox h-5 w-5 text-cyan-600" {{ $product->is_new?'checked':'' }}>
                            <span class="ml-2 text-gray-700">New Product</span>
                        </label>
                    </div>

                    <!-- Featured Images -->
                    <div class="bg-white rounded-2xl shadow p-6 space-y-4">
                        <h3 class="text-lg font-semibold text-gray-700">Featured Images</h3>
                        <div>
                            <label>Featured Image 1</label>
                            <input type="file" name="featured_image_1" class="w-full border rounded px-3 py-2">
                            @if($product->featured_image_1)
                            <img src="{{ Storage::url($product->featured_image_1) }}" class="w-32 h-32 object-cover mt-1 rounded">
                            @endif
                        </div>
                        <div>
                            <label>Featured Image 2</label>
                            <input type="file" name="featured_image_2" class="w-full border rounded px-3 py-2">
                            @if($product->featured_image_2)
                            <img src="{{ Storage::url($product->featured_image_2) }}" class="w-32 h-32 object-cover mt-1 rounded">
                            @endif
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="bg-white rounded-2xl shadow p-6 space-y-4">
                        <h3 class="text-lg font-semibold text-gray-700">Status</h3>
                        <select name="status" class="w-full border rounded px-3 py-2">
                            <option value="1" {{ $product->status==1?'selected':'' }}>Active</option>
                            <option value="0" {{ $product->status==0?'selected':'' }}>Inactive</option>
                        </select>
                    </div>

                </div>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-cyan-600 hover:bg-cyan-700 text-white px-6 py-2 rounded-lg">Update Product</button>
            </div>
        </form>
    </div>
</section>
@endsection

@section('script')
<script>
    $(document).ready(function() {

        let variantIndex = {{count($product->variants)}};

        // Add Variant
        $('#add-variant').click(function() {
            let html = `<div class="flex gap-2 variant-row">
            <select name="variants[${variantIndex}][color_id]" class="border rounded px-2 py-1">
                <option value="">Select Color</option>
                @foreach($colors as $color)
                <option value="{{ $color->id }}">{{ $color->name }}</option>
                @endforeach
            </select>
            <select name="variants[${variantIndex}][size_id]" class="border rounded px-2 py-1">
                <option value="">Select Size</option>
                @foreach($sizes as $size)
                <option value="{{ $size->id }}">{{ $size->name }}</option>
                @endforeach
            </select>
            <input type="number" name="variants[${variantIndex}][price]" placeholder="Price" class="w-full border rounded px-2 py-1">
            <input type="number" name="variants[${variantIndex}][stock]" placeholder="Stock" class="w-full border rounded px-2 py-1">
            <button type="button" class="bg-red-500 text-white px-2 rounded remove-variant">X</button>
        </div>`;
            $('#variants-wrapper').append(html);
            variantIndex++;
        });

        // Remove Variant
        $(document).on('click', '.remove-variant', function() {
            $(this).closest('.variant-row').remove();
        });

        // Add Image
        $('#add-image').click(function() {
            let html = `<div class="flex gap-2 items-center image-row">
            <input type="file" name="images[]" class="w-full border rounded px-3 py-2">
            <button type="button" class="bg-red-500 text-white px-2 py-1 rounded remove-image">X</button>
        </div>`;
            $('#images-wrapper').append(html);
        });

        // Remove New Image
        $(document).on('click', '.remove-image', function() {
            $(this).closest('.image-row').remove();
        });

        // Remove Existing Image with AJAX
        $(document).on('click', '.remove-existing-image', function() {
            let id = $(this).data('id');
            let parent = $(this).closest('.existing-image');
            $.ajax({
                url: '/vendor/products/remove-image/' + id,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    parent.remove();
                    alert(res.success);
                }
            });
        });

        // Category → SubCategory
        $('#category_id').on('change', function() {
            let id = $(this).val();
            $('#sub_category_id').html('<option>Loading...</option>');
            $('#sub_sub_category_id').html('<option value="">Select Sub-SubCategory</option>');
            if (id) {
                $.get('/vendor/ajax/subcategories/' + id, function(data) {
                    let html = '<option value="">Select SubCategory</option>';
                    data.forEach(d => html += `<option value="${d.id}">${d.name}</option>`);
                    $('#sub_category_id').html(html);
                });
            }
        });

        // SubCategory → SubSubCategory
        $('#sub_category_id').on('change', function() {
            let id = $(this).val();
            $('#sub_sub_category_id').html('<option>Loading...</option>');
            if (id) {
                $.get('/vendor/ajax/subsubcategories/' + id, function(data) {
                    let html = '<option value="">Select Sub-SubCategory</option>';
                    data.forEach(d => html += `<option value="${d.id}">${d.name}</option>`);
                    $('#sub_sub_category_id').html(html);
                });
            }
        });

    });
</script>
@endsection