@extends('admin.layouts.app')

@section('title', 'Roles List')

@section('content')
<section class="py-5 bg-light min-vh-100">
    <div class="container">
        <div class="card shadow-lg border-0 rounded-4 overflow-hidden">

            {{-- Header --}}
            <div class="card-header text-white bg-gradient-purple d-flex flex-column flex-sm-row align-items-sm-center justify-content-between">
                <h5 class="mb-2 mb-sm-0">
             Roles List
                </h5>
                @can('create role')
                <a href="{{ route('admin.roles.create') }}" class="btn btn-light btn-sm">
                    <i class="fa fa-plus me-1"></i> Add Role
                </a>
                @endcan
            </div>

            {{-- Table for Desktop --}}
            <div class="table-responsive d-none d-md-block">
                <table class="table align-middle mb-0">
                    <thead class="table-light text-uppercase small text-secondary">
                        <tr>
                            <th width="5%">SL</th>
                            <th width="20%">Name</th>
                            <th>Permissions</th>
                            <th width="15%" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                        @can('view role')
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-semibold">{{ ucfirst($role->name) }}</td>
                            <td>
                                @foreach($role->permissions as $permission)
                                <span class="badge bg-gradient-purple  text-light fw-normal me-1 mb-1">
                                    {{ $permission->name }}
                                </span>
                                @endforeach
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    @can('edit role')
                                    <a href="{{ route('admin.roles.edit', $role->id) }}" 
                                       class="btn btn-sm btn-primary rounded-circle">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    @endcan

                                    @can('delete role')
                                    <form id="delete-form-{{ $role->id }}" 
                                          action="{{ route('admin.roles.destroy', $role->id) }}" 
                                          method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button type="button" data-id="{{ $role->id }}" 
                                            class="btn btn-sm btn-danger rounded-circle delete-btn">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @endcan
                        @endforeach

                        @if($roles->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">No roles found.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            {{-- Mobile View --}}
            <div class="d-md-none border-top">
                @foreach($roles as $role)
                @can('view role')
                <div class="p-3 border-bottom">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h6 class="fw-semibold text-dark mb-0">{{ ucfirst($role->name) }}</h6>
                        <div class="d-flex gap-2">
                            @can('edit role')
                            <a href="{{ route('admin.roles.edit', $role->id) }}" 
                               class="btn btn-sm btn-primary rounded-circle">
                                <i class="fa fa-edit"></i>
                            </a>
                            @endcan
                            @can('delete role')
                            <form id="delete-form-mobile-{{ $role->id }}" 
                                  action="{{ route('admin.roles.destroy', $role->id) }}" 
                                  method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button type="button" data-id="{{ $role->id }}" 
                                    class="btn btn-sm btn-danger rounded-circle delete-btn">
                                <i class="fa fa-trash"></i>
                            </button>
                            @endcan
                        </div>
                    </div>

                    <p class="mb-1 small text-muted fw-semibold">Permissions:</p>
                    @foreach($role->permissions as $permission)
                    <span class="badge bg-primary bg-opacity-10 text-primary border border-primary fw-normal me-1 mb-1">
                        {{ $permission->name }}
                    </span>
                    @endforeach
                </div>
                @endcan
                @endforeach

                @if($roles->isEmpty())
                <div class="p-4 text-center text-muted">No roles found.</div>
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
            button.addEventListener('click', e => {
                e.preventDefault();
                const id = e.currentTarget.getAttribute('data-id');
                if (confirm('Are you sure you want to delete this role?')) {
                    const form = document.getElementById(`delete-form-${id}`) || 
                                 document.getElementById(`delete-form-mobile-${id}`);
                    form.submit();
                }
            });
        });
    });
</script>
@endsection
