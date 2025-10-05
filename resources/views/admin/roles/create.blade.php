@extends('admin.layouts.app')

@section('title', 'Add Role')

@section('content')
<section class="p-5 bg-gray-100 min-h-screen">
    <div class="mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">

        <!-- Header -->
        <div class="bg-gradient-to-r from-cyan-600 to-cyan-500 px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-white">Add Role</h2>

            @can('view role')
            <a href="{{ route('admin.roles.index') }}"
                class="bg-white/20 hover:bg-white/30 text-white px-4 py-1.5 rounded-lg transition flex items-center gap-1">
                <i class="fa fa-angle-left"></i> Back
            </a>
            @endcan
        </div>

        <!-- Form Body -->
        <div class="p-8">
            <form action="{{ route('admin.roles.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Role Name -->
                <div>
                    <label class="block text-gray-700 font-medium mb-1">
                        Role Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                        placeholder="Enter role name" required>
                    @error('name')
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Permissions -->
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <input type="checkbox" id="select-all-permissions"
                            class="h-4 w-4 text-cyan-600 border-gray-300 rounded focus:ring-0">
                        <label for="select-all-permissions" class="text-gray-700 font-medium">
                            Select All Permissions <span class="text-gray-500 text-sm">(optional)</span>
                        </label>
                    </div>

                    <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2">
                        @foreach($permissions as $permission)
                        <label
                            class="flex items-center space-x-2 border border-gray-200 rounded-lg px-3 py-2 hover:bg-gray-50 transition">
                            <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                id="permission_{{ $permission->id }}"
                                class="permission-checkbox text-cyan-600 focus:ring-0 rounded">
                            <span class="text-gray-700 text-sm">
                                {{ ucwords(str_replace('-', ' ', $permission->name)) }}
                            </span>
                        </label>
                        @endforeach
                    </div>

                    @error('permissions')
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end pt-4 border-t">
                    <button type="submit"
                        class="bg-cyan-600 hover:bg-cyan-700 text-white px-6 py-2 rounded-lg transition flex items-center gap-2">
                        <i class="fa fa-save"></i> Save
                    </button>
                </div>
            </form>
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
