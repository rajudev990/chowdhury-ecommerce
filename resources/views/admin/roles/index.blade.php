@extends('admin.layouts.app')

@section('title', 'Roles List')

@section('content')
<section class="py-6 px-3 bg-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white shadow-lg rounded-2xl overflow-hidden border border-gray-100">

            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between bg-cyan-600 px-6 py-4 text-white">
                <h3 class="text-xl font-semibold tracking-wide">Roles List</h3>

                @can('create role')
                <a href="{{ route('admin.roles.create') }}"
                    class="mt-3 sm:mt-0 inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white font-medium px-4 py-2 rounded-lg transition-all duration-200 shadow-sm">
                    <i class="fa fa-plus"></i> Add Role
                </a>
                @endcan
            </div>

            <!-- Table for large screens -->
            <div class="hidden md:block overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr class="text-left text-gray-600 font-semibold uppercase tracking-wider text-xs">
                            <th class="px-5 py-3">Sl</th>
                            <th class="px-5 py-3">Name</th>
                            <th class="px-5 py-3">Permissions</th>
                            <th class="px-5 py-3 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach($roles as $role)
                        @can('view role')
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-5 py-3 text-gray-700 font-medium">{{ $loop->iteration }}</td>
                            <td class="px-5 py-3 text-gray-800 font-medium">{{ $role->name }}</td>
                            <td class="px-5 py-3">
                                @foreach($role->permissions as $permission)
                                <span class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-2 py-1 rounded-full mr-1 mb-1">
                                    {{ $permission->name }}
                                </span>
                                @endforeach
                            </td>
                            <td class="px-5 py-3 text-center">
                                <div class="flex justify-center items-center gap-2">
                                    @can('edit role')
                                    <a href="{{ route('admin.roles.edit', $role->id) }}"
                                        class="w-8 h-8 flex items-center justify-center bg-blue-500 hover:bg-blue-600 text-white rounded-full shadow-sm transition-all duration-200">
                                        <i class="fa fa-edit text-xs"></i>
                                    </a>
                                    @endcan

                                    @can('delete role')
                                    <form id="delete-form-{{ $role->id }}"
                                        action="{{ route('admin.roles.destroy', $role->id) }}" method="POST"
                                        class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button type="button" data-id="{{ $role->id }}"
                                        class="w-8 h-8 flex items-center justify-center bg-red-500 hover:bg-red-600 text-white rounded-full shadow-sm transition-all duration-200 delete-btn">
                                        <i class="fa fa-trash text-xs"></i>
                                    </button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @endcan
                        @endforeach

                        @if($roles->isEmpty())
                        <tr>
                            <td colspan="4" class="px-5 py-6 text-center text-gray-500">No roles found.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Mobile View (Card Layout) -->
            <div class="md:hidden divide-y divide-gray-100">
                @foreach($roles as $role)
                @can('view role')
                <div class="p-4 hover:bg-gray-50 transition">
                    <div class="flex justify-between items-center mb-2">
                        <h4 class="text-gray-800 font-semibold text-base">{{ $role->name }}</h4>
                        <div class="flex gap-2">
                            @can('edit role')
                            <a href="{{ route('admin.roles.edit', $role->id) }}"
                                class="w-8 h-8 flex items-center justify-center bg-blue-500 hover:bg-blue-600 text-white rounded-full transition">
                                <i class="fa fa-edit text-xs"></i>
                            </a>
                            @endcan

                            @can('delete role')
                            <form id="delete-form-mobile-{{ $role->id }}"
                                action="{{ route('admin.roles.destroy', $role->id) }}" method="POST"
                                class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button type="button" data-id="{{ $role->id }}"
                                class="w-8 h-8 flex items-center justify-center bg-red-500 hover:bg-red-600 text-white rounded-full transition delete-btn">
                                <i class="fa fa-trash text-xs"></i>
                            </button>
                            @endcan
                        </div>
                    </div>

                    <p class="text-gray-600 text-sm mb-1">
                        <span class="font-medium">Permissions:</span>
                        @foreach($role->permissions as $permission)
                        <span class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-2 py-1 rounded-full mr-1 mt-1">
                            {{ $permission->name }}
                        </span>
                        @endforeach
                    </p>
                </div>
                @endcan
                @endforeach

                @if($roles->isEmpty())
                <div class="p-6 text-center text-gray-500">No roles found.</div>
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
                if (confirm('Are you sure you want to delete this role?')) {
                    const form = document.getElementById(`delete-form-${id}`) || document.getElementById(`delete-form-mobile-${id}`);
                    form.submit();
                }
            });
        });
    });
</script>
@endsection
