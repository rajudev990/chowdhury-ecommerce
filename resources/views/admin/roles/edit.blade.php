@extends('admin.layouts.app')

@section('title')
Update Roles
@endsection

@section('content')


<section class="content pt-4">
    <div class="container-fluid">
        <div class="row">
            

            <div class="col-md-12">
                <div class="card card-cyan">
                    <div class="card-header">
                        <h3 class="card-title">Update Roles</h3>
                        @can('view role')
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-success float-right"><i class="fa fa-angle-left"> Back</i></a>
                        @endcan
                    </div>

                    <form id="quickForm" action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="card-body">
                            <div class="row">
                                {{-- Name Field --}}
                                <div class="form-group col-md-12">
                                    <label>Roles Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $role->name }}" required>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Permissions --}}
                                <div class="form-group col-md-12">
                                    <label>
                                        <input type="checkbox" id="select-all-permissions">
                                        <strong>Permissions <span class="text-black-50">(Optional)</span></strong>
                                    </label>
                                    <div class="row mt-2">
                                        @foreach($permissions as $permission)
                                            <div class="col-md-3">
                                                <div class="form-check">
                                                    <input type="checkbox"
                                                        class="form-check-input permission-checkbox"
                                                        id="permission_{{ $permission->id }}"
                                                        name="permissions[]"
                                                        value="{{ $permission->name }}"
                                                        {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}>
                                                        
                                                    <label class="form-check-label" for="permission_{{ $permission->id }}">
                                                        {{ ucwords(str_replace('-', ' ', $permission->name)) }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('permissions')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card-footer d-flex justify-content-end">
                            <button type="submit" class="btn btn-info"><i class="fa fa-edit"></i> আপডেট করুন</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection

@section('script')
<script>
    // Toggle all permissions
    $('#select-all-permissions').on('change', function () {
        $('.permission-checkbox').prop('checked', this.checked);
    });

    // If all individual checkboxes are checked, auto-check the "Select All"
    $('.permission-checkbox').on('change', function () {
        $('#select-all-permissions').prop('checked', $('.permission-checkbox:checked').length === $('.permission-checkbox').length);
    });

    // Initialize state of "Select All" based on checked permissions
    $(document).ready(function() {
        $('#select-all-permissions').prop('checked', $('.permission-checkbox:checked').length === $('.permission-checkbox').length);
    });
</script>
@endsection
