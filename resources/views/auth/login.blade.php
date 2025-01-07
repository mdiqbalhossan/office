@extends('layouts.guest')

@section('title', 'Login')

@push('css')
@endpush

@section('content')
    <div class="auth-left d-lg-block d-none">
        <div class="d-flex align-items-center flex-column h-100 justify-content-center">
            <img src="{{ asset('assets/images/auth/auth-img.png') }}" alt="">
        </div>
    </div>
    <div class="auth-right py-32 px-24 d-flex flex-column justify-content-center">
        <div class="max-w-464-px mx-auto w-100">
            <div>
                <a href="{{ route('login') }}" class="mb-40 max-w-290-px">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="">
                </a>
                <h4 class="mb-12">Sign In to your Account</h4>
                <p class="mb-32 text-secondary-light text-lg">Welcome back! please enter your detail</p>
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="icon-field mb-16">
                    <span class="icon top-50 translate-middle-y">
                        <iconify-icon icon="mage:email"></iconify-icon>
                    </span>
                    <input type="email"
                        class="form-control h-56-px bg-neutral-50 radius-12 @error('email') is-invalid @enderror"
                        placeholder="Email" name="email" value="{{ old('email') ?? 'admin@admin.com' }}" required autofocus
                        autocomplete="username">

                </div>
                @error('email')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <div class="position-relative mb-20">
                    <div class="icon-field">
                        <span class="icon top-50 translate-middle-y">
                            <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                        </span>
                        <input type="password"
                            class="form-control h-56-px bg-neutral-50 radius-12 @error('password') is-invalid @enderror"
                            id="your-password" placeholder="Password" value="password" name="password" required
                            autocomplete="current-password">                        
                    </div>
                    <span
                        class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light"
                        data-toggle="#your-password"></span>
                </div>
                @error('password')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <div class="">
                    <div class="d-flex justify-content-between gap-2">
                        <div class="form-check style-check d-flex align-items-center">
                            <input class="form-check-input border border-neutral-300" type="checkbox" value=""
                                id="remeber" name="remember">
                            <label class="form-check-label" for="remeber">Remember me </label>
                        </div>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-primary-600 fw-medium">Forgot
                                Password?</a>
                        @endif
                    </div>
                </div>
                <button type="submit" class="btn btn-primary text-sm btn-sm px-12 py-16 w-100 radius-12 mt-32"> Sign
                    In</button>
            </form>
        </div>
    </div>
@endsection

@push('js')
@endpush
