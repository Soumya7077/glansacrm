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
          <h4 class="mb-2">Forgot Password? 🔒</h4>
          <p class="mb-4">Enter your email and we'll send you instructions to reset your password</p>
          <form id="formAuthentication" class="mb-3">
            <div class="form-floating form-floating-outline mb-3">
              <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required
                autofocus>
              <label for="email">Email</label>
            </div>
            <button type="button" class="btn btn-primary d-grid w-100" id="sendResetLink">Send Reset Link</button>
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
  document.getElementById('sendResetLink').addEventListener('click', function () {
    const email = document.getElementById('email').value;

    $.ajax({
      url: '{{ url("/api/forgotPassword") }}',
      type: 'POST',
      data: {
        Email: email
      },
      success: function (response) {
        console.log(response);
        alert('Password reset link has been sent to your email.');
      },
      error: function (xhr, status, error) {
        console.error(xhr, status, error);
        alert('An error occurred: ' + error);
      }
    });
  });

</script>

@endsection