@extends('admin.layouts.app')

@section('title')
Update Coupons
@endsection

@section('content')
<section class="p-5 bg-gray-100 min-h-screen">
    <div class="mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">

        <!-- Header -->
        <div class="bg-gradient-to-r from-cyan-600 to-cyan-500 px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-white">
                Update Coupons
            </h2>
            <a href="{{ route('admin.coupons.index') }}"
                class="bg-white/20 hover:bg-white/30 text-white px-4 py-1.5 rounded-lg transition flex items-center gap-1">
                <i class="fa fa-angle-left"></i> Back
            </a>
        </div>

        <!-- Form Body -->
        <div class="p-8">
            <form method="POST"
                action="{{route('admin.coupons.update', $data->id) }}"
                class="space-y-6">
                @csrf
                @method('PUT')
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                            Coupon Code <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="coupon_code"
                            value="{{$data->coupon_code}}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                            placeholder="Enter Coupons Code" required>
                        @error('coupon_code')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                            Coupon Amount (%)<span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="amount"
                            value="{{$data->amount}}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                            placeholder="Enter Coupons Code" required>
                        @error('amount')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select name="status" id="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none">
                            <option value="1" {{$data->status ==1 ? 'selected' : ''}}>Active</option>
                            <option value="0" {{$data->status ==0 ? 'selected' : ''}}>Deactive</option>
                        </select>
                        @error('status')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="flex justify-end pt-4 border-t">
                    <button type="submit"
                        class="bg-cyan-600 hover:bg-cyan-700 text-white px-6 py-2 rounded-lg transition">
                        <i class="fa fa-edit"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection