@extends('admin.layouts.app')

@section('title', isset($user) ? 'Edit User' : 'Add User')

@section('content')
<section class="py-5 bg-light min-vh-100">
    <div class="container">
        <div class="card shadow-lg border-0 rounded-3">
             <!-- Card Header -->
        <div class="card-header text-white bg-gradient-purple">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ isset($user) ? 'Edit User' : 'Add User' }}</h5>
                  @can('view user')
                <a href="{{ route('admin.users.index') }}" class="btn btn-light btn-sm">
                    <i class="fa fa-angle-left me-1"></i> Back
                </a>
                 @endcan
            </div>
        </div>


            <!-- Form Body -->
            <div class="card-body p-4">
                <form method="POST"
                    action="{{ isset($user) ? route('admin.users.update', $user->id) : route('admin.users.store') }}">
                    @csrf
                    @if(isset($user)) @method('PUT') @endif

                    <div class="row g-4">
                        <!-- Name -->
                        <div class="col-md-6">
                            <label class="form-label fw-medium">
                                Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}"
                                class="form-control" placeholder="Enter name" required>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <label class="form-label fw-medium">
                                Email <span class="text-danger">*</span>
                            </label>
                            <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}"
                                class="form-control" placeholder="Enter email" required>
                        </div>

                        <!-- Password -->
                        <div class="col-md-6">
                            <label class="form-label fw-medium">
                                Password {{ isset($user) ? '(leave blank to keep current)' : '' }}
                                <span class="text-danger">*</span>
                            </label>
                            <input type="password" name="password" class="form-control"
                                placeholder="Enter password" {{ isset($user) ? '' : 'required' }}>
                        </div>

                        <!-- Confirm Password -->
                        <div class="col-md-6">
                            <label class="form-label fw-medium">
                                Confirm Password <span class="text-danger">*</span>
                            </label>
                            <input type="password" name="password_confirmation" class="form-control"
                                placeholder="Confirm password" {{ isset($user) ? '' : 'required' }}>
                        </div>
                    </div>

                    <!-- Roles -->
                    <div class="mt-4">
                        <label class="form-label fw-medium">
                            Roles <span class="text-danger">*</span>
                        </label>
                        <div class="row g-2">
                            @foreach($roles as $role)
                            <div class="col-sm-6 col-md-4">
                                <div class="form-check border rounded p-2">
                                    <input type="checkbox" name="roles[]" value="{{ $role->name }}"
                                        class="form-check-input"
                                        id="role-{{ $role->id }}"
                                        {{ isset($userRoles) && in_array($role->name, $userRoles) ? 'checked' : '' }}>
                                    <label for="role-{{ $role->id }}" class="form-check-label text-secondary">
                                        {{ $role->name }}
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="mt-4 pt-3 border-top text-end">
                        <button type="submit" class="btn bg-gradient-purple text-white px-4">
                            <i class="fa fa-save"></i> Save
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</section>
@endsection
