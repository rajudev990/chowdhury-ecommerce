@extends('admin.layouts.app')

@section('title', 'User List')

@section('content')
<section class="py-5 bg-light min-vh-100">
    <div class="container">
        <div class="card shadow-lg border-0 rounded-3">

            <!-- Header -->
        <div class="card-header d-flex justify-content-between align-items-center bg-gradient-purple text-white">
            <h5 class="mb-0">User List</h5>
             @can('create user')
            <a href="{{ route('admin.users.create') }}" class="btn btn-light btn-sm">
                <i class="fa fa-plus me-1"></i> Add User
            </a>
              @endcan
        </div>

            <!-- Table for large screens -->
            <div class="table-responsive d-none d-md-block">
                <table class="table table-striped align-middle mb-0">
                    <thead class="table-light text-uppercase text-secondary small fw-semibold">
                        <tr>
                            <th>Sl</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($users as $user)
                        @can('view user')
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-semibold text-dark">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @foreach($user->roles as $role)
                                <span class="badge bg-primary text-light me-1 mb-1">{{ $role->name }}</span>
                                @endforeach
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center align-items-center gap-2">
                                    @can('edit user')
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-primary rounded-circle">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    @endcan

                                    @can('delete user')
                                    <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button type="button" data-id="{{ $user->id }}" class="btn btn-sm btn-danger rounded-circle delete-btn">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @endcan
                        @endforeach

                        @if($users->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">No users found.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Mobile view (Card layout) -->
            <div class="d-md-none">
                @foreach($users as $user)
                @can('view user')
                <div class="border-bottom p-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h5 class="fw-semibold mb-0">{{ $user->name }}</h5>
                        <div class="d-flex gap-2">
                            @can('edit user')
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-primary rounded-circle">
                                <i class="fa fa-edit"></i>
                            </a>
                            @endcan

                            @can('delete user')
                            <form id="delete-form-mobile-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button type="button" data-id="{{ $user->id }}" class="btn btn-sm btn-danger rounded-circle delete-btn">
                                <i class="fa fa-trash"></i>
                            </button>
                            @endcan
                        </div>
                    </div>
                    <p class="text-muted mb-1"><span class="fw-medium">Email:</span> {{ $user->email }}</p>
                    <p class="text-muted mb-0"><span class="fw-medium">Role:</span>
                        @foreach($user->roles as $role)
                        <span class="badge bg-primary text-light me-1 mt-1">{{ $role->name }}</span>
                        @endforeach
                    </p>
                </div>
                @endcan
                @endforeach

                @if($users->isEmpty())
                <div class="text-center text-muted py-4">No users found.</div>
                @endif
            </div>

        </div>
    </div>
</section>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                const id = e.currentTarget.getAttribute('data-id');
                if (confirm('Are you sure you want to delete this user?')) {
                    const form = document.getElementById(`delete-form-${id}`) || document.getElementById(`delete-form-mobile-${id}`);
                    form.submit();
                }
            });
        });
    });
</script>
@endsection
