@extends('vendor.layouts.app')
@section('title','Edit Product')

@section('content')

<section class="py-5 bg-light min-vh-100">
    <div class="container">

    <div class="card shadow-lg rounded-3">
        <!-- Header -->
        <div class="card-header text-white bg-gradient-purple">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit Product</h5>
                <a href="{{ route('vendor.products.index') }}" class="btn btn-light btn-sm">
                    <i class="fa fa-angle-left me-1"></i> Back
                </a>
            </div>
        </div>

        <!-- Body -->
        <div class="card-body">
            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger mb-4">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('vendor.products.update',$product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row g-4">

                    <!-- Left Column -->
                    <div class="col-md-8">

                        <!-- Basic Info -->
                        <div class="card mb-4 shadow-sm">
                            <div class="card-header bg-white"><strong>Basic Information</strong></div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Product Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" value="{{ $product->name }}" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">SKU</label>
                                    <input type="text" name="sku" value="{{ $product->sku }}" class="form-control" required>
                                </div>
                                <div class="row g-3 mb-3">
                                    <div class="col">
                                        <label class="form-label">Purchase Price ({{currency()}})<span class="text-danger">*</span></label>
                                        <input type="number" step="0.01" name="purchase_price" value="{{ $product->purchase_price }}" class="form-control" required>
                                    </div>
                                    <div class="col">
                                        <label class="form-label">Regular Price ({{currency()}})<span class="text-danger">*</span></label>
                                        <input type="number" step="0.01" name="regular_price" value="{{ $product->regular_price }}" class="form-control" required>
                                    </div>
                                    <div class="col">
                                        <label class="form-label">Sale Price ({{currency()}})<span class="text-danger">*</span></label>
                                        <input type="number" step="0.01" name="sale_price" value="{{ $product->sale_price }}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row g-3 mb-3">
                                    <div class="col">
                                        <label class="form-label">Units</label>
                                        <input type="text" name="unit" value="{{ $product->unit }}" class="form-control" placeholder="pcs, kg, etc.">
                                    </div>
                                    <div class="col">
                                        <label class="form-label">Stock</label>
                                        <input type="number" name="stock" value="{{ $product->stock }}" class="form-control">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" rows="4" class="form-control">{{ $product->description }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Product Images -->
                        <div class="card mb-4 shadow-sm">
                            <div class="card-header bg-white"><strong>Product Images</strong></div>
                            <div class="card-body">
                                <div id="images-wrapper">
                                    @foreach($product->images as $img)
                                        <div class="d-flex align-items-center mb-2 existing-image">
                                            <img src="{{ Storage::url($img->image) }}" class="rounded me-2" style="width:80px;height:80px;object-fit:cover;">
                                            <a href="{{ route('vendor.products.removeImage', $img->id) }}" class="btn btn-danger btn-sm remove-existing-image">X</a>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mt-3">
                                    <input type="file" name="images[]" class="form-control mb-2">
                                    <button type="button" id="add-image" class="btn btn-primary btn-sm">Add More</button>
                                </div>
                            </div>
                        </div>

                        <!-- Variants -->
                        <div class="card mb-4 shadow-sm">
                            <div class="card-header bg-white"><strong>Variants (Stock & Price)</strong></div>
                            <div class="card-body">
                                <div id="variants-wrapper">
                                    @foreach($product->variants as $index => $variant)
                                        <div class="row g-2 mb-2 align-items-center variant-row">
                                            <div class="col">
                                                <select name="variants[{{ $index }}][color_id]" class="form-select">
                                                    <option value="">Select Color</option>
                                                    @foreach($colors as $color)
                                                        <option value="{{ $color->id }}" {{ $variant->color_id==$color->id?'selected':'' }}>{{ $color->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col">
                                                <select name="variants[{{ $index }}][size_id]" class="form-select">
                                                    <option value="">Select Size</option>
                                                    @foreach($sizes as $size)
                                                        <option value="{{ $size->id }}" {{ $variant->size_id==$size->id?'selected':'' }}>{{ $size->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col">
                                                <input type="number" name="variants[{{ $index }}][price]" value="{{ $variant->price }}" placeholder="Price" class="form-control">
                                            </div>
                                            <div class="col">
                                                <input type="number" name="variants[{{ $index }}][stock]" value="{{ $variant->stock }}" placeholder="Stock" class="form-control">
                                            </div>
                                            <div class="col-auto">
                                                <button type="button" class="btn btn-danger btn-sm remove-variant">X</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" id="add-variant" class="btn btn-primary mt-2">Add Variant</button>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-4">

                        <!-- Category & Brand -->
                        <div class="card mb-4 shadow-sm">
                            <div class="card-header bg-white"><strong>Category & Brand</strong></div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Category <span class="text-danger">*</span></label>
                                    <select name="category_id" id="category_id" class="form-select" required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $product->category_id==$category->id?'selected':'' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">SubCategory</label>
                                    <select name="sub_category_id" id="sub_category_id" class="form-select">
                                        <option value="">Select SubCategory</option>
                                        @foreach($subcategories as $sub)
                                            <option value="{{ $sub->id }}" {{ $product->sub_category_id==$sub->id?'selected':'' }}>{{ $sub->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Sub-SubCategory</label>
                                    <select name="sub_sub_category_id" id="sub_sub_category_id" class="form-select">
                                        <option value="">Select Sub-SubCategory</option>
                                        @foreach($subsubcategories as $subsub)
                                            <option value="{{ $subsub->id }}" {{ $product->sub_sub_category_id==$subsub->id?'selected':'' }}>{{ $subsub->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Brand</label>
                                    <select name="brand_id" class="form-select">
                                        <option value="">Select Brand</option>
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}" {{ $product->brand_id==$brand->id?'selected':'' }}>{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Flags -->
                        <div class="card mb-4 shadow-sm">
                            <div class="card-header bg-white"><strong>Product Flags</strong></div>
                            <div class="card-body">
                                <div class="form-check mb-2">
                                    <input type="checkbox" name="is_featured" value="1" class="form-check-input" {{ $product->is_featured?'checked':'' }}>
                                    <label class="form-check-label">Featured</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input type="checkbox" name="is_popular" value="1" class="form-check-input" {{ $product->is_popular?'checked':'' }}>
                                    <label class="form-check-label">Most Popular</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" name="is_new" value="1" class="form-check-input" {{ $product->is_new?'checked':'' }}>
                                    <label class="form-check-label">New Product</label>
                                </div>
                            </div>
                        </div>

                        <!-- Featured Images -->
                        <div class="card mb-4 shadow-sm">
                            <div class="card-header bg-white"><strong>Featured Images</strong></div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Featured Image 1</label>
                                    <input type="file" name="featured_image_1" class="form-control">
                                    @if($product->featured_image_1)
                                        <img src="{{ Storage::url($product->featured_image_1) }}" class="rounded mt-2" style="width:100px;height:100px;object-fit:cover;">
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Featured Image 2</label>
                                    <input type="file" name="featured_image_2" class="form-control">
                                    @if($product->featured_image_2)
                                        <img src="{{ Storage::url($product->featured_image_2) }}" class="rounded mt-2" style="width:100px;height:100px;object-fit:cover;">
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="card mb-4 shadow-sm">
                            <div class="card-header bg-white"><strong>Status</strong></div>
                            <div class="card-body">
                                <select name="status" class="form-select">
                                    <option value="1" {{ $product->status==1?'selected':'' }}>Active</option>
                                    <option value="0" {{ $product->status==0?'selected':'' }}>Inactive</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Update Product</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

</section>
@endsection

@section('script')

<script>
    let variantIndex = {{ count($product->variants) }};

    // Add Variant
    $('#add-variant').click(function(){
        let html = `<div class="row g-2 mb-2 align-items-center variant-row">
            <div class="col">
                <select name="variants[${variantIndex}][color_id]" class="form-select">
                    <option value="">Select Color</option>
                    @foreach($colors as $color)
                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <select name="variants[${variantIndex}][size_id]" class="form-select">
                    <option value="">Select Size</option>
                    @foreach($sizes as $size)
                    <option value="{{ $size->id }}">{{ $size->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col"><input type="number" name="variants[${variantIndex}][price]" placeholder="Price" class="form-control"></div>
            <div class="col"><input type="number" name="variants[${variantIndex}][stock]" placeholder="Stock" class="form-control"></div>
            <div class="col-auto"><button type="button" class="btn btn-danger btn-sm remove-variant">X</button></div>
        </div>`;
        $('#variants-wrapper').append(html);
        variantIndex++;
    });

    // Remove Variant
    $(document).on('click', '.remove-variant', function(){
        $(this).closest('.variant-row').remove();
    });

    // Add Image
    $('#add-image').click(function(){
        let html = `<div class="input-group mb-2 image-row">
            <input type="file" name="images[]" class="form-control">
            <button type="button" class="btn btn-danger remove-image">X</button>
        </div>`;
        $('#images-wrapper').append(html);
    });

    $(document).on('click', '.remove-image', function(){
        $(this).closest('.image-row').remove();
    });

    // AJAX for Subcategory
    $('#category_id').on('change', function(){
        let id = $(this).val();
        if(id){
            $.get('/vendor/ajax/subcategories/' + id, function(data){
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

    $('#sub_category_id').on('change', function(){
        let id = $(this).val();
        if(id){
            $.get('/vendor/ajax/subsubcategories/' + id, function(data){
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
