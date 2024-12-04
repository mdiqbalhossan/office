@extends('layouts.guest')

@section('title', 'Reset Password')

@push('css')

@endpush

@section('content')
<div class="auth-left d-lg-block d-none">
    <div class="d-flex align-items-center flex-column h-100 justify-content-center">
        <img src="{{ asset('assets/images/auth/reset-pass-img.png') }}" alt="">
    </div>
</div>
<div class="auth-right py-32 px-24 d-flex flex-column justify-content-center">
    <div class="max-w-464-px mx-auto w-100">
        <div>
            <h4 class="mb-12">Reset Password</h4>
            <p class="mb-32 text-secondary-light text-lg">Enter your new password below.</p>
        </div>
        @include('layouts.partials.__alert')
        <form method="POST" action="{{ route('password.store') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <input type="hidden" name="email" value="{{ $request->email }}">
            <div class="icon-field">
                <span class="icon top-50 translate-middle-y">
                    <iconify-icon icon="iconamoon:lock-access"></iconify-icon>
                </span>
                <input type="password" class="form-control h-56-px bg-neutral-50 radius-12 @error('password') is-invalid @enderror" placeholder="Enter Password" name="password" required autocomplete="new-password">
            </div>
            @error('password')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <div class="icon-field">
                <span class="icon top-50 translate-middle-y">
                    <iconify-icon icon="iconamoon:lock-access"></iconify-icon>
                </span>
                <input type="password" class="form-control h-56-px bg-neutral-50 radius-12 @error('password_confirmation') is-invalid @enderror" placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password">
            </div>
            <button type="submit" class="btn btn-primary text-sm btn-sm px-12 py-16 w-100 radius-12 mt-32">Reset Password</button>

            <div class="text-center">
                <a href="{{ route('login') }}" class="text-primary-600 fw-bold mt-24">Back to Sign In</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')

@endpush