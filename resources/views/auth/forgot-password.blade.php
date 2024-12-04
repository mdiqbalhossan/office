@extends('layouts.guest')

@section('title', 'Forgot Password')

@push('css')

@endpush

@section('content')
<div class="auth-left d-lg-block d-none">
    <div class="d-flex align-items-center flex-column h-100 justify-content-center">
        <img src="{{ asset('assets/images/auth/forgot-pass-img.png') }}" alt="">
    </div>
</div>
<div class="auth-right py-32 px-24 d-flex flex-column justify-content-center">
    <div class="max-w-464-px mx-auto w-100">
        <div>
            <h4 class="mb-12">Forgot Password</h4>
            <p class="mb-32 text-secondary-light text-lg">Enter the email address associated with your account and we will send you a link to reset your password.</p>
        </div>
        @include('layouts.partials.__alert')
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="icon-field">
                <span class="icon top-50 translate-middle-y">
                    <iconify-icon icon="mage:email"></iconify-icon>
                </span>
                <input type="email" class="form-control h-56-px bg-neutral-50 radius-12 @error('email') is-invalid @enderror" placeholder="Enter Email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
            </div>
            @error('email')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <button type="submit" class="btn btn-primary text-sm btn-sm px-12 py-16 w-100 radius-12 mt-32">Send Reset Link</button>

            <div class="text-center">
                <a href="{{ route('login') }}" class="text-primary-600 fw-bold mt-24">Back to Sign In</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')

@endpush
