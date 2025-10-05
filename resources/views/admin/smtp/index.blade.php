@extends('admin.layouts.app')

@section('title', 'Edit SMTP Settings')

@section('content')
<section class="p-5 bg-gray-100 min-h-screen">
    <div class="mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">

        <!-- Header -->
        <div class="bg-gradient-to-r from-cyan-600 to-cyan-500 px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-white">
                Edit SMTP Settings
            </h2>
        </div>

        <!-- Form Body -->
        <div class="p-8">
            <form method="POST" action="{{ route('admin.smtp.update', $data->id) }}" class="space-y-6">
                @csrf

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Mailer <span class="text-red-500">*</span></label>
                        <input type="text" name="mail_mailer" value="{{ old('mail_mailer', $data->mail_mailer) }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                            placeholder="smtp" required>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">SMTP Host <span class="text-red-500">*</span></label>
                        <input type="text" name="mail_host" value="{{ old('mail_host', $data->mail_host) }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                            placeholder="smtp.gmail.com" required>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">SMTP Port <span class="text-red-500">*</span></label>
                        <input type="number" name="mail_port" value="{{ old('mail_port', $data->mail_port) }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                            placeholder="587" required>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Username <span class="text-red-500">*</span></label>
                        <input type="text" name="mail_username" value="{{ old('mail_username', $data->mail_username) }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                            placeholder="your_email@gmail.com" required>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Password <span class="text-red-500">*</span></label>
                        <input type="password" name="mail_password" value="{{ old('mail_password', $data->mail_password) }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                            placeholder="Your SMTP password" required>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Encryption</label>
                        <input type="text" name="mail_encryption" value="{{ old('mail_encryption', $data->mail_encryption) }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                            placeholder="tls or ssl">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">From Address <span class="text-red-500">*</span></label>
                        <input type="email" name="mail_from_address" value="{{ old('mail_from_address', $data->mail_from_address) }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                            placeholder="info@yourshop.com" required>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">From Name <span class="text-red-500">*</span></label>
                        <input type="text" name="mail_from_name" value="{{ old('mail_from_name', $data->mail_from_name) }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none"
                            placeholder="My Ecommerce Shop" required>
                    </div>
                </div>

                <div class="flex justify-end pt-4 border-t">
                    <button type="submit" class="bg-cyan-600 hover:bg-cyan-700 text-white px-6 py-2 rounded-lg transition">
                        <i class="fa fa-edit"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
