@extends('vendor.layouts.app')
@section('title','Create Product')

@section('content')
<section class="py-5 bg-light min-vh-100">
    <div class="container">

     <div class="card shadow-lg rounded-3">
        <!-- Header -->
        <div class="card-header text-white bg-gradient-purple">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Create Product</h5>
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

        <form action="{{ route('vendor.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-4">

                <!-- Left Column -->
                <div class="col-md-8">

                    <!-- Basic Info -->
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header bg-white"><strong>Basic Information</strong></div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Product Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">SKU</label>
                                <input type="text" name="sku" class="form-control" value="{{ old('sku') }}"required>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col">
                                    <label class="form-label">Purchase Price({{currency()}}) <span class="text-danger">*</span></label>
                                    <input type="number" name="purchase_price" step="0.01" class="form-control" value="{{ old('purchase_price') }}" required>
                                </div>
                                <div class="col">
                                    <label class="form-label">Regular Price({{currency()}}) <span class="text-danger">*</span></label>
                                    <input type="number" name="regular_price" step="0.01" class="form-control" value="{{ old('regular_price') }}" required>
                                </div>
                                <div class="col">
                                    <label class="form-label">Sale Price({{currency()}}) <span class="text-danger">*</span></label>
                                    <input type="number" name="sale_price" step="0.01" class="form-control" value="{{ old('sale_price') }}" required>
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col">
                                    <label class="form-label">Units</label>
                                    <input type="text" name="unit" class="form-control" value="{{ old('unit') }}" placeholder="pcs, kg, etc.">
                                </div>
                                <div class="col">
                                    <label class="form-label">Stock</label>
                                    <input type="number" name="stock" class="form-control" value="{{ old('stock') }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" rows="4" class="form-control">{{ old('description') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Product Images -->
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header bg-white"><strong>Product Images</strong></div>
                        <div class="card-body">
                            <div id="images-wrapper" class="mb-2">
                                <div class="input-group mb-2">
                                    <input type="file" name="images[]" class="form-control">
                                    <button type="button" class="btn btn-danger remove-image">X</button>
                                </div>
                            </div>
                            <button type="button" id="add-image" class="btn btn-primary">Add More</button>
                        </div>
                    </div>

                    <!-- Variants -->
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header bg-white"><strong>Variants (Stock & Price)</strong></div>
                        <div class="card-body">
                            <div id="variants-wrapper">
                                <div class="row g-2 mb-2 align-items-center">
                                    <div class="col">
                                        <select name="variants[0][color_id]" class="form-select">
                                            <option value="">Select Color</option>
                                            @foreach($colors as $color)
                                            <option value="{{ $color->id }}">{{ $color->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <select name="variants[0][size_id]" class="form-select">
                                            <option value="">Select Size</option>
                                            @foreach($sizes as $size)
                                            <option value="{{ $size->id }}">{{ $size->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <input type="number" name="variants[0][price]" class="form-control" placeholder="Price">
                                    </div>
                                    <div class="col">
                                        <input type="number" name="variants[0][stock]" class="form-control" placeholder="Stock">
                                    </div>
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-danger remove-variant">X</button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" id="add-variant" class="btn btn-primary">Add Variant</button>
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
                                    <option value="{{ $category->id }}" {{ old('category_id')==$category->id?'selected':'' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">SubCategory <span class="text-danger">*</span></label>
                                <select name="sub_category_id" id="sub_category_id" class="form-select">
                                    <option value="">Select SubCategory</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Sub-SubCategory <span class="text-danger">*</span></label>
                                <select name="sub_sub_category_id" id="sub_sub_category_id" class="form-select">
                                    <option value="">Select Sub-SubCategory</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Brand <span class="text-danger">*</span></label>
                                <select name="brand_id" class="form-select">
                                    <option value="">Select Brand</option>
                                    @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ old('brand_id')==$brand->id?'selected':'' }}>{{ $brand->name }}</option>
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
                                <input type="checkbox" name="is_featured" value="1" class="form-check-input" {{ old('is_featured')?'checked':'' }}>
                                <label class="form-check-label">Featured Image</label>
                            </div>
                            <div class="form-check mb-2">
                                <input type="checkbox" name="is_popular" value="1" class="form-check-input" {{ old('is_popular')?'checked':'' }}>
                                <label class="form-check-label">Most Popular</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="is_new" value="1" class="form-check-input" {{ old('is_new')?'checked':'' }}>
                                <label class="form-check-label">New Product</label>
                            </div>
                        </div>
                    </div>

                    <!-- Featured Images -->
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header bg-white"><strong>Featured Images</strong></div>
                        <div class="card-body">
                            <div class="mb-2">
                                <label class="form-label">Featured Image 1</label>
                                <input type="file" name="featured_image_1" class="form-control">
                            </div>
                            <div>
                                <label class="form-label">Featured Image 2</label>
                                <input type="file" name="featured_image_2" class="form-control">
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header bg-white"><strong>Status</strong></div>
                        <div class="card-body">
                            <select name="status" class="form-select">
                                <option value="1" {{ old('status')==1?'selected':'' }}>Active</option>
                                <option value="0" {{ old('status')==0?'selected':'' }}>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn btn-success w-100">Create Product</button>

                </div>

            </div>
            </div>
            </div>
        </form>
    </div>
</section>
@endsection

@section('script')
<script>
    let variantIndex = {{ old('variants') ? count(old('variants')) : 1 }};

    // Add variant
    $('#add-variant').click(function(){
        let html = `<div class="row g-2 mb-2 align-items-center">
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
            <div class="col">
                <input type="number" name="variants[${variantIndex}][price]" class="form-control" placeholder="Price">
            </div>
            <div class="col">
                <input type="number" name="variants[${variantIndex}][stock]" class="form-control" placeholder="Stock">
            </div>
            <div class="col-auto">
                <button type="button" class="btn btn-danger remove-variant">X</button>
            </div>
        </div>`;
        $('#variants-wrapper').append(html);
        variantIndex++;
    });

    $(document).on('click', '.remove-variant', function(){
        $(this).closest('.row').remove();
    });

    // Add images
    $('#add-image').click(function(){
        let html = `<div class="input-group mb-2">
            <input type="file" name="images[]" class="form-control">
            <button type="button" class="btn btn-danger remove-image">X</button>
        </div>`;
        $('#images-wrapper').append(html);
    });

    $(document).on('click', '.remove-image', function(){
        $(this).closest('.input-group').remove();
    });

    // AJAX for subcategories
    $('#category_id').on('change', function(){
        let id = $(this).val();
        if(id){
            $.get('/vendor/ajax/subcategories/' + id, function(data){
                let options = '<option value="">Select SubCategory</option>';
                data.forEach(d => options += `<option value="${d.id}">${d.name}</option>`);
                $('#sub_category_id').html(options);
                $('#sub_sub_category_id').html('<option value="">Select Sub-SubCategory</option>');
                @if(old('sub_category_id'))
                    $('#sub_category_id').val("{{ old('sub_category_id') }}").trigger('change');
                @endif
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
                @if(old('sub_sub_category_id'))
                    $('#sub_sub_category_id').val("{{ old('sub_sub_category_id') }}");
                @endif
            });
        } else {
            $('#sub_sub_category_id').html('<option value="">Select Sub-SubCategory</option>');
        }
    });

    @if(old('category_id'))
        $('#category_id').trigger('change');
    @endif
</script>
@endsection
