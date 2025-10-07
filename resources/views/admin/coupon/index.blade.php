@extends('admin.layouts.app')

@section('title', 'Coupons List')

@section('content')
<section class="py-6 px-3 bg-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white shadow-lg rounded-2xl overflow-hidden border border-gray-100">

            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between bg-cyan-600 px-6 py-4 text-white">
                <h3 class="text-xl font-semibold tracking-wide">Coupons List</h3>


                <a href="{{ route('admin.coupons.create') }}"
                    class="mt-3 sm:mt-0 inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white font-medium px-4 py-2 rounded-lg transition-all duration-200 shadow-sm">
                    <i class="fa fa-plus"></i> Add Coupons
                </a>

            </div>

            <!-- Table for large screens -->
            <div class="hidden md:block overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr class="text-left text-gray-600 font-semibold uppercase tracking-wider text-xs">
                            <th class="px-5 py-3">Sl</th>
                            <th class="px-5 py-3">Coupon</th>
                            <th class="px-5 py-3">Amount (%)</th>
                            <th class="px-5 py-3">Status</th>
                            <th class="px-5 py-3 text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach($data as $item)

                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-5 py-3 text-gray-700 font-medium">{{ $loop->iteration }}</td>
                            <td class="px-5 py-3 text-gray-800 font-medium">{{ $item->coupon_code }}</td>
                            <td class="px-5 py-3 text-gray-800 font-medium">{{ $item->amount }}%</td>

                          <td class="px-5 py-3">
                            @if($item->status == 1)
                                <span class="px-3 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">
                                    Active
                                </span>
                            @else
                                <span class="px-3 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded-full">
                                    Deactive
                                </span>
                            @endif
                        </td>

                            <td class="px-5 py-3 text-center">
                                <div class="flex justify-center items-center gap-2">

                                    <a href="{{ route('admin.coupons.edit', $item->id) }}"
                                        class="w-8 h-8 flex items-center justify-center bg-blue-500 hover:bg-blue-600 text-white rounded-full shadow-sm transition-all duration-200">
                                        <i class="fa fa-edit text-xs"></i>
                                    </a>



                                    <form id="delete-form-{{ $item->id }}"
                                        action="{{ route('admin.coupons.destroy', $item->id) }}" method="POST"
                                        class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button type="button" data-id="{{ $item->id }}"
                                        class="w-8 h-8 flex items-center justify-center bg-red-500 hover:bg-red-600 text-white rounded-full shadow-sm transition-all duration-200 delete-btn">
                                        <i class="fa fa-trash text-xs"></i>
                                    </button>

                                </div>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
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