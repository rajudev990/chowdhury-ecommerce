@extends('admin.layouts.app')
@section('title')
Update Password
@endsection

@section('content')


<section class="content py-5">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-7 m-auto">
                <!-- jquery validation -->
                <div class="card card-cyan">
                    <div class="card-header">
                        <h3 class="card-title">Update Password</h3>
                    </div>

                    @if ($errors->any())
                    <ul class="mt-3">
                        @foreach ($errors->all() as $error)
                        <li class="text-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="quickForm" action="{{ route('admin.change.password.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="current_password">Current Password</label>
                                <input type="password" class="form-control  @error('current_password') is-invalid @enderror" name="current_password" id="current_password" required>
                                @error('current_password')
                                    <span class="text-danger">{{$message}}</span> 
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="new_password">New Password</label>
                                <input type="password" class="form-control  @error('new_password') is-invalid @enderror" name="new_password" id="new_password" required>
                                @error('new_password')
                                    <span class="text-danger">{{$message}}</span> 
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="new_password_confirmation">Confirm New Password</label>
                                <input type="password" class="form-control  @error('new_password_confirmation') is-invalid @enderror" name="new_password_confirmation" id="new_password_confirmation" required>
                                @error('new_password_confirmation')
                                    <span class="text-danger">{{$message}}</span> 
                                @enderror
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer d-flex justify-content-end">
                            <button type="submit" class="btn btn-info"><i class="fa fa-edit"></i> Update</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-6">

            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

@section('script')
@endsection
@endsection