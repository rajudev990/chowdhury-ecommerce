@extends('admin.layouts.app')

@section('title', 'Affiliate Users List')

@section('content')
<section class="py-6 px-3 bg-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white shadow-lg rounded-2xl overflow-hidden border border-gray-100">

            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between bg-cyan-600 px-6 py-4 text-white">
                <h3 class="text-xl font-semibold tracking-wide">Affiliate Users List</h3>
                <a href="{{ route('admin.all-users.create') }}" class="mt-3 sm:mt-0 inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white font-medium px-4 py-2 rounded-lg transition-all duration-200 shadow-sm">
                    <i class="fa fa-plus"></i> Add
                </a>
            </div>

            <!-- Table -->
            <div class="hidden md:block overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr class="text-left text-gray-600 font-semibold uppercase tracking-wider text-xs">
                            <th class="px-5 py-3">Sl</th>
                            <th class="px-5 py-3">Name</th>
                            <th class="px-5 py-3">Email</th>
                            <th class="px-5 py-3">Phone</th>
                            <th class="px-5 py-3">Username</th>
                            <th class="px-5 py-3">Referral</th>
                            <th class="px-5 py-3">Status</th>
                            <th class="px-5 py-3 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach($data as $item)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-5 py-3 text-gray-700 font-medium">{{ $loop->iteration }}</td>

                           <td class="px-5 py-3 text-gray-800 font-medium">
                                {{ $item->fname }} {{ $item->lname }}
                            </td>

                            <td class="px-5 py-3 text-gray-800 font-medium">{{$item->email}}</td>
                            <td class="px-5 py-3 text-gray-800 font-medium">{{$item->phone}}</td>
                            <td class="px-5 py-3 text-gray-800 font-medium">{{$item->username}}</td>
                            <td class="px-5 py-3 text-gray-800 font-medium">{{$item->referal_name_id}}</td>
                            <td class="px-5 py-3">
                                 @if ($item->status === 'active')
                                    <span class="px-3 py-1 text-sm font-medium text-green-700 bg-green-100 rounded-full">
                                        Active
                                    </span>
                                @elseif ($item->status === 'pending')
                                    <span class="px-3 py-1 text-sm font-medium text-yellow-700 bg-yellow-100 rounded-full">
                                        Pending
                                    </span>
                                @elseif ($item->status === 'rejected')
                                    <span class="px-3 py-1 text-sm font-medium text-red-700 bg-red-100 rounded-full">
                                        Rejected
                                    </span>
                                @endif
                            </td>
                            <td class="px-5 py-3 text-center">
                                <div class="flex justify-center items-center gap-2">
                                    <a href="{{ route('admin.all-users.edit',$item->id) }}" class="w-8 h-8 flex items-center justify-center bg-blue-500 hover:bg-blue-600 text-white rounded-full shadow-sm transition-all duration-200">
                                        <i class="fa fa-edit text-xs"></i>
                                    </a>
                                    <form id="delete-form-{{$item->id }}" action="{{ route('admin.all-users.destroy',$item->id) }}" method="POST" class="hidden">
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
                            <td colspan="5" class="px-5 py-6 text-center text-gray-500">No brands found.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection