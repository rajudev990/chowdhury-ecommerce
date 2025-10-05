@extends('admin.layouts.app')

@section('title', 'Sizes List')

@section('content')
<section class="py-6 px-3 bg-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white shadow-lg rounded-2xl overflow-hidden border border-gray-100">

            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between bg-cyan-600 px-6 py-4 text-white">
                <h3 class="text-xl font-semibold tracking-wide">Sizes List</h3>
                <a href="{{ route('admin.sizes.create') }}" class="mt-3 sm:mt-0 inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white font-medium px-4 py-2 rounded-lg transition-all duration-200 shadow-sm">
                    <i class="fa fa-plus"></i> Add Size
                </a>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr class="text-left text-gray-600 font-semibold uppercase tracking-wider text-xs">
                            <th class="px-5 py-3">Sl</th>
                            <th class="px-5 py-3">Name</th>
                            <th class="px-5 py-3">Status</th>
                            <th class="px-5 py-3 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach($sizes as $size)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-5 py-3">{{ $loop->iteration }}</td>
                            <td class="px-5 py-3 font-medium">{{ $size->name }}</td>
                            <td class="px-5 py-3">
                                <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full {{ $size->status == 1 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $size->status == 1 ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="px-5 py-3 text-center flex justify-center gap-2">
                                <a href="{{ route('admin.sizes.edit', $size->id) }}" class="w-8 h-8 flex items-center justify-center bg-blue-500 hover:bg-blue-600 text-white rounded-full shadow-sm transition-all duration-200">
                                    <i class="fa fa-edit text-xs"></i>
                                </a>
                                <form action="{{ route('admin.sizes.destroy', $size->id) }}" method="POST" class="hidden" id="delete-form-{{ $size->id }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button type="button" data-id="{{ $size->id }}" class="w-8 h-8 flex items-center justify-center bg-red-500 hover:bg-red-600 text-white rounded-full shadow-sm transition-all duration-200 delete-btn">
                                    <i class="fa fa-trash text-xs"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                        @if($sizes->isEmpty())
                        <tr>
                            <td colspan="4" class="px-5 py-6 text-center text-gray-500">No sizes found.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="p-4">
                {{ $sizes->links() }}
            </div>
        </div>
    </div>
</section>
@endsection