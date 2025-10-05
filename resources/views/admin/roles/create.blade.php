@extends('admin.layouts.app')

@section('title')
Add Roles
@endsection


@section('content')

<section class="content pt-5">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card card-cyan">

                    <div class="card-header">
                        <h3 class="card-title">Add Roles</h3>
                        @can('view role')

                        <a href="{{ route('admin.roles.index') }}" class="btn btn-success float-right"><i class="fa fa-angle-left"> Back</i></a>

                        @endcan
                    </div>


                    <!-- /.card-header -->
                    <form id="quickForm" action="{{ route('admin.roles.store') }}" method="POST">
                        @csrf
                        @method('post')
                        <div class="card-body">


                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Roles Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" required>
                                    @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>


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
                                                    value="{{ $permission->name }}">

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
                        <!-- /.card-body -->
                        <div class="card-footer d-flex justify-content-end">
                            <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Save</button>
                        </div>
                    </form>
                    <!-- /.card-body -->
                </div>


            </div>



        </div>

    </div>
</section>

@section('script')
<script>
    document.getElementById('image').addEventListener('change', function(event) {
        const preview = document.getElementById('preview-image');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }

            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
        }
    });
</script>
<script>
    $('#select-all-permissions').on('change', function() {
        $('.permission-checkbox').prop('checked', this.checked);
    });
</script>
@endsection


@endsection