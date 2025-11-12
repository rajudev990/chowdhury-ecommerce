@extends('admin.layouts.app')

@section('title', 'Add Role')

@section('content')
<section class="py-5 bg-light min-vh-100">
    <div class="container">
        <div class="card shadow-lg border-0 rounded-4 overflow-hidden">

            {{-- Header --}}
            <div class="card-header bg-gradient-purple text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Add Role</h5>
                @can('view role')
                <a href="{{ route('admin.roles.index') }}" class="btn btn-light btn-sm">
                    <i class="fa fa-angle-left me-1"></i> Back
                </a>
                @endcan
            </div>

            {{-- Form --}}
            <div class="card-body p-4">
                <form action="{{ route('admin.roles.store') }}" method="POST">
                    @csrf

                    {{-- Role Name --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Role Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control rounded-3"
                            placeholder="Enter role name" required>
                        @error('name')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Select All --}}
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="select-all-permissions">
                        <label class="form-check-label fw-semibold" for="select-all-permissions">
                            Select All Permissions <span class="text-muted small">(optional)</span>
                        </label>
                    </div>

                    {{-- Permissions List --}}
                        <div class="row g-2">
                            @foreach($permissions as $permission)
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                <div class="form-check d-flex align-items-center border rounded-3 px-3 py-2 h-100 transition shadow-sm hover-shadow-sm">
                                    <input class="form-check-input permission-checkbox me-2 ms-0 mt-0" type="checkbox"
                                        name="permissions[]" value="{{ $permission->name }}"
                                        id="permission_{{ $permission->id }}">
                                    <label class="form-check-label text-capitalize mb-0 flex-grow-1" for="permission_{{ $permission->id }}">
                                        {{ str_replace('-', ' ', $permission->name) }}
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>


                    @error('permissions')
                    <div class="text-danger small mt-2">{{ $message }}</div>
                    @enderror

                    {{-- Submit --}}
                    <div class="text-end pt-4 border-top mt-4">
                        <button type="submit" class="btn bg-gradient-purple text-white px-4 rounded-3">
                            <i class="fa fa-save me-1"></i> Save
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</section>
@endsection

@section('script')
<script>
    // Select All Permissions
    document.getElementById('select-all-permissions').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.permission-checkbox');
        checkboxes.forEach(cb => cb.checked = this.checked);
    });
</script>
@endsection
