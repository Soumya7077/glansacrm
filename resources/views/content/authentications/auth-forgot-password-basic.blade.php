@extends('layouts/blankLayout')

@section('title', 'Forgot Password Basic - Pages')

@section('page-style')
  <!-- Page -->
  <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
  <style>
    .invalid-feedback {
    position: absolute;
    bottom: -18px;
    left: 0;
    font-size: 14px;
    }
  </style>
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
        <form id="formAuthentication" class="mb-3 needs-validation" novalidate>
        <div class="form-floating form-floating-outline mb-3">
          <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required
          autofocus>
          <div class="invalid-feedback">Please provide a Last Name.</div>

          <label for="email">Email</label>
          <div class="invalid-feedback">Please enter a valid email address.</div>
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



  <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="successModalLabel">Success</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      Password reset link has been sent to your email.
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
    </div>
  </div>

  <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="errorModalLabel">Error</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="errorMessage">
      An error occurred. Please try again.
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
    </div>
  </div>



  <script>
    (function () {
    'use strict';
    // Bootstrap form validation
    var forms = document.querySelectorAll('.needs-validation');

    Array.prototype.slice.call(forms).forEach(function (form) {
      form.addEventListener('submit', function (event) {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add('was-validated');
      }, false);
    });
    })();

    document.getElementById('sendResetLink').addEventListener('click', function () {
    const emailInput = document.getElementById('email');
    const email = emailInput.value.trim();
    const emailError = emailInput.nextElementSibling; // Get the invalid-feedback div

    // Reset previous validation messages
    emailInput.classList.remove('is-invalid');
    emailError.style.display = 'none';

    if (!email) {
      emailInput.classList.add('is-invalid');
      emailError.textContent = 'Please enter your email.';
      emailError.style.display = 'block';
      return; // Stop execution if validation fails
    }

    console.log(email);

    $.ajax({
      url: '{{ url("/api/forgotPassword") }}',
      type: 'POST',
      data: {
      Email: email
      },
      success: function (response) {
      console.log(response);
      var successModal = new bootstrap.Modal(document.getElementById('successModal'));
      successModal.show();
      },
      error: function (xhr, status, error) {
      console.error(xhr, status, error);
      document.getElementById('errorMessage').textContent = 'An error occurred: ' + error;
      var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
      errorModal.show();
      }
    });
    });
  </script>

@endsection