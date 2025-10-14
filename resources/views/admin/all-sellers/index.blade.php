@extends('admin.layouts.app')

@section('title', 'Vendor Sellers List')

@section('content')
<section class="py-6 px-3 bg-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white shadow-lg rounded-2xl overflow-hidden border border-gray-100">

            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between bg-cyan-600 px-6 py-4 text-white">
                <h3 class="text-xl font-semibold tracking-wide">Vendor Sellers List</h3>
                <a href="{{ route('admin.all-sellers.create') }}" class="mt-3 sm:mt-0 inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white font-medium px-4 py-2 rounded-lg transition-all duration-200 shadow-sm">
                    <i class="fa fa-plus"></i> Add
                </a>
            </div>

            <!-- Table -->
            <div class="w-full">
                <table class="table-fixed w-full border-collapse text-sm">
                    <thead class="bg-gray-50">
                        <tr class="text-left text-gray-600 font-semibold uppercase tracking-wider text-xs">
                            <th class="px-5 py-3 w-12">Sl</th>
                            <!-- <th class="px-5 py-3 w-40">Name</th> -->
                            <th class="px-5 py-3 w-40">Shop Name</th>
                            <th class="px-5 py-3 w-40">Shop Slug</th>
                            <th class="px-5 py-3 w-48">Email</th>
                            <th class="px-5 py-3 w-32">Phone</th>
                            <th class="px-5 py-3 w-28">Status</th>
                            <th class="px-5 py-3 w-28 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach($data as $item)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-5 py-3 text-gray-700 font-medium text-center">{{ $loop->iteration }}</td>
                            <!-- <td class="px-5 py-3 text-gray-800 font-medium truncate">{{ $item->name }}</td> -->
                            <td class="px-5 py-3 text-gray-800 font-medium truncate">{{$item->shop_name}}</td>
                            <td class="px-5 py-3 text-gray-800 font-medium truncate">{{$item->shop_slug}}</td>
                            <td class="px-5 py-3 text-gray-800 font-medium truncate">{{$item->email}}</td>
                            <td class="px-5 py-3 text-gray-800 font-medium">{{$item->phone}}</td>
                            <!-- <td class="px-5 py-3 text-gray-800 font-medium">{{$item->country}}</td> -->
                      
                            <td class="px-5 py-3">
                                @if ($item->status === 'active')
                                <span class="px-3 py-1 text-sm font-medium text-green-700 bg-green-100 rounded-full">
                                    Active
                                </span>
                                @elseif ($item->status === 'inactive')
                                <span class="px-3 py-1 text-sm font-medium text-yellow-700 bg-yellow-100 rounded-full">
                                    Pending
                                </span>
                                @elseif ($item->status === 'banned')
                                <span class="px-3 py-1 text-sm font-medium text-red-700 bg-red-100 rounded-full">
                                    Rejected
                                </span>
                                @endif
                            </td>
                            <td class="px-5 py-3 text-center">
                                <div class="flex justify-center items-center gap-2">
                                    <a href="{{ route('admin.all-sellers.edit',$item->id) }}" class="w-8 h-8 flex items-center justify-center bg-blue-500 hover:bg-blue-600 text-white rounded-full shadow-sm transition-all duration-200">
                                        <i class="fa fa-edit text-xs"></i>
                                    </a>
                                    <form id="delete-form-{{$item->id }}" action="{{ route('admin.all-sellers.destroy',$item->id) }}" method="POST" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button type="button" data-id="{{$item->id }}" class="w-8 h-8 flex items-center justify-center bg-red-500 hover:bg-red-600 text-white rounded-full shadow-sm transition-all duration-200 delete-btn">
                                        <i class="fa fa-trash text-xs"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach

                        @if($data->isEmpty())
                        <tr>
                            <td colspan="9" class="px-5 py-6 text-center text-gray-500">No sellers found.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>



        </div>
    </div>
</section>
@endsection