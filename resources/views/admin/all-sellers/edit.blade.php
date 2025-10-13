@extends('admin.layouts.app')

@section('title', 'Update Vendor Sellers')

@section('content')
<section class="p-5 bg-gray-100 min-h-screen">
    <div class="mx-auto bg-white rounded-2xl shadow-lg overflow-hidden max-w-4xl">

        <!-- Header -->
        <div class="bg-gradient-to-r from-cyan-600 to-cyan-500 px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-white">
                Update Vendor Sellers
            </h2>

            <a href="{{ route('admin.all-sellers.index') }}"
                class="bg-white/20 hover:bg-white/30 text-white px-4 py-1.5 rounded-lg transition flex items-center gap-1">
                <i class="fa fa-angle-left"></i> Back
            </a>
        </div>

        <!-- Form Body -->
        <div class="p-8">
            <form method="POST" action="{{ route('admin.all-sellers.update',$data->id) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid md:grid-cols-2 gap-5">
                    <!-- Name -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Name</label>
                        <input type="text" name="name" value="{{$data->name }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none">
                        @error('name')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Email</label>
                        <input type="text" name="email" value="{{ $data->email  }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none">
                        @error('email')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Password</label>
                        <input type="text" name="password"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none">
                        @error('password')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Shop Name -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Shop Name</label>
                        <input type="text" name="shop_name" value="{{ $data->shop_name  }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none">
                        @error('shop_name')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Shop Slug -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Shop Slug</label>
                        <input type="text" name="shop_slug" value="{{ $data->shop_slug  }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none">
                        @error('shop_slug')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Phone</label>
                        <input type="text" name="phone" value="{{ $data->phone }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none">
                        @error('phone')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Address</label>
                        <input type="text" name="address" value="{{ $data->address}}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none">
                        @error('address')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- City -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">City</label>
                        <input type="text" name="city" value="{{ $data->city }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none">
                        @error('city')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Country -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Country</label>
                        <input type="text" name="country" value="{{ $data->country }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none">
                        @error('country')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Postal Code -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Postal Code</label>
                        <input type="text" name="postal_code" value="{{$data->postal_code}}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none">
                        @error('postal_code')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label class="block text-gray-700 font-medium mb-1">Description</label>
                        <textarea name="description" rows="3"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none">{!!$data->description!!}</textarea>
                        @error('description')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                {{-- Logo --}}
                  <div>
                    <label class="block text-gray-700 font-medium mb-1">Logo</label>
                    @if($data->logo)
                        <img src="{{Storage::url($data->logo) }}" class="w-24 h-24 rounded mb-2">
                    @endif
                    <input type="file" name="logo"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none">
                    @error('logo')
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>


                {{-- Banner --}}
                 <div>
                    <label class="block text-gray-700 font-medium mb-1">Banner</label>
                    @if($data->banner)
                        <img src="{{Storage::url($data->banner) }}" class="w-24 h-24 rounded mb-2">
                    @endif
                    <input type="file" name="banner"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none">
                    @error('banner')
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>


                   

                    <!-- Status -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Status</label>
                        <select name="status"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none">
                            <option value="inactive" {{$data->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="active" {{$data->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="banned" {{$data->status == 'banned' ? 'selected' : '' }}>Banned</option>
                        </select>
                        @error('status')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
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

@section('scripts')

@endsection