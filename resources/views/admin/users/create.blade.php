@extends('admin.layouts.app')

@section('title', isset($user) ? 'Edit User' : 'Add User')

@section('content')
<section class="p-5 bg-gray-100 min-h-screen">
    <div class="mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">

        <!-- Header -->
        <div class="bg-gradient-to-r from-cyan-600 to-cyan-500 px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-white">
                {{ isset($user) ? 'Edit User' : 'Add User' }}
            </h2>

            @can('view user')
            <a href="{{ route('admin.users.index') }}"
                class="bg-white/20 hover:bg-white/30 text-white px-4 py-1.5 rounded-lg transition flex items-center gap-1">
                <i class="fa fa-angle-left"></i> Back
            </a>
            @endcan
        </div>

        <!-- Form Body -->
        <div class="p-8">
            <form method="POST"
                action="{{ isset($user) ? route('admin.users.update', $user->id) : route('admin.users.store') }}"
                class="space-y-6">
                @csrf
                @if(isset($user)) @method('PUT') @endif

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                            Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name"
                            value="{{ old('name', $user->name ?? '') }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                            placeholder="Enter name" required>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" name="email"
                            value="{{ old('email', $user->email ?? '') }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                            placeholder="Enter email" required>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                            Password {{ isset($user) ? '(leave blank to keep current)' : '' }}
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="password" name="password"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                            placeholder="Enter password" {{ isset($user) ? '' : 'required' }}>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                            Confirm Password <span class="text-red-500">*</span>
                        </label>
                        <input type="password" name="password_confirmation"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                            placeholder="Confirm password" {{ isset($user) ? '' : 'required' }}>
                    </div>
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-2">
                        Roles <span class="text-red-500">*</span>
                    </label>
                    <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-2">
                        @foreach($roles as $role)
                        <label class="flex items-center space-x-2 border border-gray-200 rounded-lg px-3 py-2 hover:bg-gray-50">
                            <input type="checkbox" name="roles[]" value="{{ $role->name }}"
                                class="text-cyan-600 focus:ring-0"
                                {{ isset($userRoles) && in_array($role->name, $userRoles) ? 'checked' : '' }}>
                            <span class="text-gray-700">{{ $role->name }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>


                <div class="flex justify-end pt-4 border-t">
                    <button type="submit"
                        class="bg-cyan-600 hover:bg-cyan-700 text-white px-6 py-2 rounded-lg transition">
                        <i class="fa fa-save"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection