@extends('admin.layouts.app')

@section('title', isset($user) ? 'Update User' : 'Add User')

@section('content')
<section class="py-5 bg-light min-vh-100">
    <div class="container">
        <div class="card shadow-lg border-0 rounded-2 mx-auto" style="max-width: 1000px; overflow: hidden;">

            {{-- Header --}}
            <div class="card-header text-white bg-gradient-purple d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    {{ isset($user) ? 'Update User' : 'Add User' }}
                </h5>
                @can('view user')
                <a href="{{ route('admin.users.index') }}" class="btn btn-light btn-sm rounded-3 fw-semibold">
                    <i class="fa fa-angle-left me-1"></i> Back
                </a>
                @endcan
            </div>

            {{-- Body --}}
            <div class="card-body p-4">
                <form method="POST"
                      action="{{ isset($user) ? route('admin.users.update', $user->id) : route('admin.users.store') }}">
                    @csrf
                    @if(isset($user)) @method('PUT') @endif

                    <div class="row g-4">
                        {{-- Name --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-secondary">
                                Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="name" 
                                   value="{{ old('name', $user->name ?? '') }}" 
                                   class="form-control shadow-sm" placeholder="Enter name" required>
                        </div>

                        {{-- Email --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-secondary">
                                Email <span class="text-danger">*</span>
                            </label>
                            <input type="email" name="email" 
                                   value="{{ old('email', $user->email ?? '') }}" 
                                   class="form-control shadow-sm" placeholder="Enter email" required>
                        </div>

                        {{-- Password --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-secondary">
                                Password {{ isset($user) ? '(Leave blank to keep current)' : '' }}
                            </label>
                            <input type="password" name="password" 
                                   class="form-control shadow-sm" placeholder="Enter password">
                        </div>

                        {{-- Confirm Password --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-secondary">
                                Confirm Password
                            </label>
                            <input type="password" name="password_confirmation" 
                                   class="form-control shadow-sm" placeholder="Confirm password">
                        </div>
                    </div>

                    {{-- Roles --}}
                    <div class="mt-4">
                        <label class="form-label fw-semibold text-secondary d-block mb-2">
                            Roles <span class="text-danger">*</span>
                        </label>
                        <div class="row g-2">
                            @foreach($roles as $role)
                            <div class="col-md-4">
                                <div class="form-check border rounded-3 py-2 px-3 bg-light hover-shadow-sm">
                                    <input class="form-check-input" type="checkbox" name="roles[]" 
                                           value="{{ $role->name }}" id="role_{{ $role->id }}"
                                           {{ isset($userRoles) && in_array($role->name, $userRoles) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="role_{{ $role->id }}">
                                        {{ ucfirst($role->name) }}
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div class="text-end mt-5 border-top pt-4">
                        <button type="submit" class="btn bg-gradient-purple text-white fw-semibold px-4">
                            <i class="fa fa-save me-1"></i>
                            {{ isset($user) ? 'Update' : 'Save' }}
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</section>
@endsection
