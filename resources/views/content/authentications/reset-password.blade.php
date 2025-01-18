@extends('layouts/blankLayout')

@section('title', 'Forgot Password Basic - Pages')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection

@section('content')
<div class="position-relative">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">

            <!-- Forgot Password -->
            <div class="card p-2">
                <!-- Logo -->
                <div class="app-brand justify-content-center mt-5">
                    <a href="{{url('/')}}" class="app-brand-link gap-2">
                        <img class="app-brand-logo demo" src="../../assets/img/Glansa Solutions.png" height="20" />
                        <span class="app-brand-text demo text-heading fw-semibold">Glansa HealthCare CRM</span>
                    </a>
                </div>
                <!-- /Logo -->
                <div class="card-body mt-2">
                    <h4 class="mb-2">Enter your password and confirm 🔒</h4>
                    <p class="mb-4">Enter your new password and confirm it below to reset your password</p>
                    <form id="formAuthentication" class="mb-3" method="POST" action="{{ route('resetpassword') }}">
                        @csrf
                        <div class="form-floating form-floating-outline mb-3">
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Enter your new password" required autofocus>
                            <label for="password">New Password</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-3">
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                                placeholder="Confirm your new password" required>
                            <label for="confirmPassword">Confirm Password</label>
                        </div>
                        <button type="submit" class="btn btn-primary d-grid w-100" id="sendResetLink">Submit</button>
                    </form>

                    <div class="text-center">
                        <a href="/" class="d-flex align-items-center justify-content-center">
                            <i class="mdi mdi-chevron-left scaleX-n1-rtl mdi-24px"></i>
                            Back to login
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Forgot Password -->
            <img src="{{asset('assets/img/illustrations/tree-3.png')}}" alt="auth-tree"
                class="authentication-image-object-left d-none d-lg-block">
            <img src="{{asset('assets/img/illustrations/auth-basic-mask-light.png')}}"
                class="authentication-image d-none d-lg-block" alt="triangle-bg">
            <img src="{{asset('assets/img/illustrations/tree.png')}}" alt="auth-tree"
                class="authentication-image-object-right d-none d-lg-block">
        </div>
    </div>
</div>

<script>
    // document.getElementById('sendResetLink').addEventListener('click', function () {
    //     const password = document.getElementById('password').value;
    //     const confirmPassword = document.getElementById('confirmPassword').value;

    //     if (password !== confirmPassword) {
    //         alert('Passwords do not match!');
    //         return;
    //     }



    //     console.log('Password:', password);
    //     console.log('Confirm Password:', confirmPassword);
    // });
</script>

@endsection