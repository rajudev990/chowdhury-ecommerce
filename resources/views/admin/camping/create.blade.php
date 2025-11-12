@extends('admin.layouts.app')

@section('title', 'Add Camping')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg rounded-3">
        
        {{-- Header --}}
        <div class="card-header text-white bg-gradient-purple">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Add Camping</h5>
                <a href="{{ route('admin.campings.index') }}" class="btn btn-light btn-sm">
                    <i class="fa fa-angle-left me-1"></i> Back
                </a>
            </div>
        </div>

        {{-- Body --}}
        <div class="card-body">
            <form action="{{ route('admin.campings.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    {{-- Type --}}
                    <div class="col-md-6 mb-3">
                        <label for="type" class="form-label">Type</label>
                         <select name="type" id="type" class="form-select">
                            <option value="">Select Type</option>
                            <option value="Affiliate">Affiliate</option>
                            <option value="Vendor" >Vendor</option>
                        </select>
                    </div>

                   {{-- Title --}}
                    <div class="col-md-6 mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control" placeholder="Enter title">
                    </div>

                    {{-- Slug --}}
                    <div class="col-md-6 mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" name="slug" id="slug" value="{{ old('slug') }}" class="form-control" placeholder="Slug will be generated automatically">
                    </div>

                    {{-- Logo --}}
                    <div class="col-md-6 mb-3">
                        <label for="logo" class="form-label">Logo</label>
                        <input type="file" name="logo" id="logo" class="form-control">
                    </div>

                    {{-- Camping Description --}}
                    <div class="col-12 mb-3">
                        <label for="camping_description" class="form-label">Camping Description</label>
                        <textarea name="camping_description" id="camping_description" class="form-control" rows="4" placeholder="Enter camping description">{{ old('camping_description') }}</textarea>
                    </div>

                   {{-- Video Type --}}
                <div class="col-md-6 mb-3">
                    <label for="video_type" class="form-label">Video Type</label>
                    <select name="video_type" id="video_type" class="form-select">
                        <option value="">Select Type</option>
                        <option value="youtube" {{ old('video_type') == 'youtube' ? 'selected' : '' }}>YouTube</option>
                        <option value="mp4" {{ old('video_type') == 'mp4' ? 'selected' : '' }}>Video File</option>
                    </select>
                </div>

                {{-- Video Input --}}
                <div class="col-md-6 mb-3">
                    <label for="video" class="form-label">Video (URL or File)</label>
                    <input type="text" name="video" id="video" value="{{ old('video') }}" class="form-control" placeholder="Enter video URL or path">
                </div>


               {{-- Banners --}}
                <div class="col-12 mt-4">
                    <h5 class="fw-bold mb-3 text-primary">Banners</h5>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Banner</label>
                            <input type="file" name="bannar" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Banner 1</label>
                            <input type="file" name="bannar_1" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Banner 2</label>
                            <input type="file" name="bannar_2" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Banner 3</label>
                            <input type="file" name="bannar_3" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Banner 4</label>
                            <input type="file" name="bannar_4" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Banner 5</label>
                            <input type="file" name="bannar_5" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Banner 6</label>
                            <input type="file" name="bannar_6" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Banner 7</label>
                            <input type="file" name="bannar_7" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Banner 8</label>
                            <input type="file" name="bannar_8" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Banner 9</label>
                            <input type="file" name="bannar_9" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Banner 10</label>
                            <input type="file" name="bannar_10" class="form-control">
                        </div>
                    </div>
                </div>

                {{-- Extra Images --}}
                <div class="col-12 mt-4">
                    <h5 class="fw-bold mb-3 text-primary">Extra Images</h5>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Image 1</label>
                            <input type="file" name="image_1" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Image 2</label>
                            <input type="file" name="image_2" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Image 3</label>
                            <input type="file" name="image_3" class="form-control">
                        </div>
                    </div>
                </div>



                    {{-- Why Buy --}}
                    <h5 class="fw-bold mb-3 mt-5 text-primary">Why Buy</h5>
                    <div class="col-md-6 mb-3">
                        <label for="why_buy_title" class="form-label">Why Buy Title</label>
                        <input type="text" name="why_buy_title" id="why_buy_title" class="form-control" value="{{ old('why_buy_title') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="why_buy_image" class="form-label">Why Buy Image</label>
                        <input type="file" name="why_buy_image" id="why_buy_image" class="form-control">
                    </div>

                    <div class="col-12 mb-3">
                        <label for="why_buy_description" class="form-label">Why Buy Description</label>
                        <textarea name="why_buy_description" id="why_buy_description" rows="3" class="form-control">{{ old('why_buy_description') }}</textarea>
                    </div>

                    {{-- About --}}
                    <h5 class="fw-bold mb-3 mt-5 text-primary">About</h5>
                    <div class="col-md-6 mb-3">
                        <label for="about_title" class="form-label">About Title</label>
                        <input type="text" name="about_title" id="about_title" class="form-control" value="{{ old('about_title') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="about_image" class="form-label">About Image</label>
                        <input type="file" name="about_image" id="about_image" class="form-control">
                    </div>

                    <div class="col-12 mb-3">
                        <label for="about_description" class="form-label">About Description</label>
                        <textarea name="about_description" id="about_description" rows="3" class="form-control">{{ old('about_description') }}</textarea>
                    </div>

                    {{-- Product Info --}}
                     <h5 class="fw-bold mb-3 mt-5 text-primary">Product</h5>
                    <div class="col-md-4 mb-3">
                        <label for="product_id" class="form-label">Product ID</label>
                        <input type="text" name="product_id" id="product_id" class="form-control" value="{{ old('product_id') }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="product_title" class="form-label">Product Title</label>
                        <input type="text" name="product_title" id="product_title" class="form-control" value="{{ old('product_title') }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="product_name" class="form-label">Product Name</label>
                        <input type="text" name="product_name" id="product_name" class="form-control" value="{{ old('product_name') }}">
                    </div>

                    <div class="col-12 mb-3">
                        <label for="product_description" class="form-label">Product Description</label>
                        <textarea name="product_description" id="product_description" rows="3" class="form-control">{{ old('product_description') }}</textarea>
                    </div>

                    {{-- Status --}}
                    <div class="col-md-6 mb-4">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="deactive" {{ old('status') == 'deactive' ? 'selected' : '' }}>Deactive</option>
                        </select>
                    </div>

                </div>

                {{-- Submit --}}
                <div class="text-end">
                    <button type="submit" class="btn text-white bg-gradient-purple">
                        <i class="fa fa-save me-1"></i> Save Camping
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection


@section('script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const titleInput = document.getElementById('title');
    const slugInput = document.getElementById('slug');

    titleInput.addEventListener('input', function() {
        let slug = this.value
            .toLowerCase()           // small letters
            .trim()                  // remove whitespace from start/end
            .replace(/[^\w\s-]/g, '') // remove special chars except letters, numbers, underscore, dash
            .replace(/\s+/g, '-')    // replace spaces with dash
            .replace(/--+/g, '-');   // replace multiple dashes with single dash
        slugInput.value = slug;
    });
});
</script>


{{-- JavaScript --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const videoType = document.getElementById('video_type');
    const videoInput = document.getElementById('video');

    function toggleVideoInput() {
        if (videoType.value === 'mp4') {
            videoInput.type = 'file';
            videoInput.value = ''; // clear previous URL
        } else {
            videoInput.type = 'text';
            videoInput.value = '{{ old("video") }}'; // keep old value if any
        }
    }

    // Initial check
    toggleVideoInput();

    // On change
    videoType.addEventListener('change', toggleVideoInput);
});
</script>
@endsection
