@extends('layouts.app')
@section('title')
Others Income - Verify Email
@endsection
@section('css')
<style></style>
@endsection
@section('content')

<div class="container">
    <h2>Email Verification</h2>
    <p>
        Thanks for signing up! Before getting started, please verify your email address by clicking on the link we just emailed to you.
        If you didn’t receive the email, we will gladly send you another.
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success" role="alert">
            A new verification link has been sent to your email address.
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="btn btn-primary">Resend Verification Email</button>
    </form>
</div>
@endsection
