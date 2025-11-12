@extends('admin.layouts.app')

@section('title', 'Update Sub-SubCategory')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-lg rounded-3">
        {{-- Card Header --}}
        <div class="card-header d-flex justify-content-between align-items-center bg-gradient-purple text-white">
            <h5 class="mb-0">Update Sub-SubCategory</h5>
            <a href="{{ route('admin.subsubcategories.index') }}" class="btn btn-light btn-sm">
                <i class="fa fa-angle-left me-1"></i> Back
            </a>
        </div>

        {{-- Card Body --}}
        <div class="card-body">
            <form action="{{ route('admin.subsubcategories.update', $subSubCategory->id) }}" method="POST" enctype="multipart/form-data">
                 @csrf
                @method('PUT')

                {{-- Parent Category --}}
                <div class="mb-3">
                    <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                    <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $subSubCategory->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- SubCategory Name --}}
                <div class="mb-3">
                    <label for="name" class="form-label">SubCategory<span class="text-danger">*</span></label>                   
                    <select name="sub_category_id" id="sub_category_id" class="form-select @error('sub_category_id') is-invalid @enderror" required>
                        <option value="">Select SubCategory</option>
                        @foreach($subcategories as $sub)
                        <option value="{{ $sub->id }}" {{ $subSubCategory->sub_category_id == $sub->id ? 'selected' : '' }}>
                            {{ $sub->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('sub_category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                {{-- Sub-SubCategory Name --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Sub-SubCategory Name<span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" value="{{ $subSubCategory->name}}"
                        class="form-control @error('name') is-invalid @enderror" placeholder="Enter subcategory name" required>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- SubCategory Image --}}
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>

                    <input type="file" name="image" id="image"
                        class="form-control @error('image') is-invalid @enderror">
                         @if($subSubCategory->image)
                        <img src="{{ asset('storage/'.$subSubCategory->image) }}" 
                            alt="Sub Sub Category Image" 
                            class="img-thumbnail mt-2" 
                            style="width: 100px; height: 100px; object-fit: cover;">
                    @endif
                    @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="mb-4">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                        <option value="1"  {{ $subSubCategory->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0"  {{ $subSubCategory->status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Submit Button --}}
                <div class="text-end">
                    <button type="submit" class="btn text-white bg-gradient-purple">
                        <i class="fa fa-edit me-1"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
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
