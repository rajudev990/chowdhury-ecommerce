@extends('admin.layouts.app')

@section('title', 'Update SMTP Settings')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg border-0 rounded-4 mx-auto" style="max-width: 1000px; overflow: hidden;">

        <!-- Card Header -->
        <div class="card-header text-white bg-gradient-purple d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Update SMTP Settings</h5>
        </div>

        <!-- Card Body -->
        <div class="card-body">
            <form action="{{ route('admin.smtp.update', $data->id) }}" method="POST">
                @csrf
    

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="mail_mailer" class="form-label">Mailer <span class="text-danger">*</span></label>
                        <input type="text" name="mail_mailer" id="mail_mailer"
                            value="{{ old('mail_mailer', $data->mail_mailer) }}"
                            class="form-control @error('mail_mailer') is-invalid @enderror" placeholder="smtp" required>
                        @error('mail_mailer')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="mail_host" class="form-label">SMTP Host <span class="text-danger">*</span></label>
                        <input type="text" name="mail_host" id="mail_host"
                            value="{{ old('mail_host', $data->mail_host) }}"
                            class="form-control @error('mail_host') is-invalid @enderror" placeholder="smtp.gmail.com" required>
                        @error('mail_host')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="mail_port" class="form-label">SMTP Port <span class="text-danger">*</span></label>
                        <input type="number" name="mail_port" id="mail_port"
                            value="{{ old('mail_port', $data->mail_port) }}"
                            class="form-control @error('mail_port') is-invalid @enderror" placeholder="587" required>
                        @error('mail_port')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="mail_username" class="form-label">Username <span class="text-danger">*</span></label>
                        <input type="text" name="mail_username" id="mail_username"
                            value="{{ old('mail_username', $data->mail_username) }}"
                            class="form-control @error('mail_username') is-invalid @enderror"
                            placeholder="your_email@gmail.com" required>
                        @error('mail_username')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="mail_password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" name="mail_password" id="mail_password"
                            value="{{ old('mail_password', $data->mail_password) }}"
                            class="form-control @error('mail_password') is-invalid @enderror"
                            placeholder="Your SMTP password" required>
                        @error('mail_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="mail_encryption" class="form-label">Encryption</label>
                        <input type="text" name="mail_encryption" id="mail_encryption"
                            value="{{ old('mail_encryption', $data->mail_encryption) }}"
                            class="form-control @error('mail_encryption') is-invalid @enderror"
                            placeholder="tls or ssl">
                        @error('mail_encryption')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="mail_from_address" class="form-label">From Address <span class="text-danger">*</span></label>
                        <input type="email" name="mail_from_address" id="mail_from_address"
                            value="{{ old('mail_from_address', $data->mail_from_address) }}"
                            class="form-control @error('mail_from_address') is-invalid @enderror"
                            placeholder="info@yourshop.com" required>
                        @error('mail_from_address')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="mail_from_name" class="form-label">From Name <span class="text-danger">*</span></label>
                        <input type="text" name="mail_from_name" id="mail_from_name"
                            value="{{ old('mail_from_name', $data->mail_from_name) }}"
                            class="form-control @error('mail_from_name') is-invalid @enderror"
                            placeholder="My Ecommerce Shop" required>
                        @error('mail_from_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn text-white bg-gradient-purple">
                        <i class="fa fa-edit me-1"></i> Update
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
