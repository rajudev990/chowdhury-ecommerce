@extends('admin.layouts.app')

@section('title', 'Edit SubCategory')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-lg rounded-3">
        {{-- Card Header --}}
        <div class="card-header d-flex justify-content-between align-items-center bg-gradient-purple text-white">
            <h5 class="mb-0">Edit SubCategory</h5>
            <a href="{{ route('admin.subcategories.index') }}" class="btn btn-light btn-sm">
                <i class="fa fa-angle-left me-1"></i> Back
            </a>
        </div>

        {{-- Card Body --}}
        <div class="card-body">
            <form action="{{ route('admin.subcategories.update', $subcategory->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Parent Category --}}
                <div class="mb-3">
                    <label for="category_id" class="form-label">Parent Category <span class="text-danger">*</span></label>
                    <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $subcategory->category_id == $category->id ? 'selected' : '' }}>
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
                    <label for="name" class="form-label">SubCategory Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name', $subcategory->name) }}"
                        class="form-control @error('name') is-invalid @enderror" placeholder="Enter subcategory name" required>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- SubCategory Image --}}
                <div class="mb-3">
                    <label for="image" class="form-label">SubCategory Image</label>
                    @if($subcategory->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $subcategory->image) }}" class="rounded" style="width:80px;height:80px;object-fit:cover;">
                        </div>
                    @endif
                    <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                    @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="mb-4">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                        <option value="1" {{ $subcategory->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $subcategory->status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Submit Button --}}
                <div class="text-end">
                    <button type="submit" class="btn text-white bg-gradient-purple">
                        <i class="fa fa-save me-1"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
