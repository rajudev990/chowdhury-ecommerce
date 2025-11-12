@extends('admin.layouts.app')

@section('title', 'Banner Update')

@section('content')
<div class="container py-5">

    <div class="card shadow-lg border-0 rounded-4">

        <!-- Header -->
        <div class="card-header bg-gradient-purple text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Banner Update</h5>
        </div>

        <!-- Form -->
        <div class="card-body">
            <form action="{{ route('admin.bannars.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" id="title" name="title" value="{{ old('title', $data->title) }}"
                            class="form-control @error('title') is-invalid @enderror">
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" id="description" name="description" value="{{ old('description', $data->description) }}"
                            class="form-control @error('description') is-invalid @enderror">
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label for="product_link" class="form-label">Button Link</label>
                        <input type="text" id="product_link" name="product_link" value="{{ old('product_link', $data->product_link) }}"
                            class="form-control @error('product_link') is-invalid @enderror">
                        @error('product_link')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label for="image" class="form-label">Banner Image</label>
                        <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                        @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror

                        <div class="mt-3">
                            @if($data->image)
                                <img id="preview-image" src="{{ Storage::url($data->image) }}"
                                    class="rounded border w-100" style="max-width:150px; height:auto;" alt="Banner Preview">
                            @else
                                <img id="preview-image" class="d-none rounded border w-100" style="max-width:150px; height:auto;" alt="Preview">
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Submit -->
                <div class="text-end mt-4">
                    <button type="submit" class="btn bg-gradient-purple text-white">
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
document.addEventListener("DOMContentLoaded", function () {
    const input = document.getElementById('image');
    const preview = document.getElementById('preview-image');

    input.addEventListener('change', function (event) {
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = e => {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        } else {
            preview.src = '';
            preview.classList.add('d-none');
        }
    });
});
</script>
@endsection
