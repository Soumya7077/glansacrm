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
        <div class="form-password-toggle mb-3">
          <div class="input-group input-group-merge">
          <div class="form-floating form-floating-outline">
            <input type="password" id="password" class="form-control" name="password" placeholder="**********"
            required autofocus>
            <label for="password">New Password</label>
          </div>
          <span class="input-group-text cursor-pointer toggle-password" data-target="password">
            <i class="mdi mdi-eye-off-outline"></i>
          </span>
          </div>
        </div>

        <!-- Confirm Password -->
        <div class="form-password-toggle mb-3">
          <div class="input-group input-group-merge">
          <div class="form-floating form-floating-outline">
            <input type="password" id="confirmPassword" class="form-control" name="confirmPassword"
            placeholder="**********" required>
            <label for="confirmPassword">Confirm Password</label>
          </div>
          <span class="input-group-text cursor-pointer toggle-password" data-target="confirmPassword">
            <i class="mdi mdi-eye-off-outline"></i>
          </span>
          </div>
        </div>
        <p id="error-message" style="color: red; display: none;"></p>
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


  <!-- Success Modal -->
  <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="successModalLabel">Success</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      The password has been reset successfully!
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
    </div>
  </div>

  <!-- Error Modal -->
  <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="errorModalLabel">Error</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      Failed to reset password. Please try again.
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
    </div>
  </div>

  <script>
    // const urlParams = new URLSearchParams(window.location.search);
    // const email = urlParams.get('email');

    document.getElementById('sendResetLink').addEventListener('click', function (e) {
    e.preventDefault();

    const password = document.getElementById('password').value.trim();
    const confirmPassword = document.getElementById('confirmPassword').value.trim();
    const errorMessage = document.getElementById('error-message');

    // Password length validation
    if (password.length < 6) {
      errorMessage.innerText = "Password must be at least 6 characters long.";
      errorMessage.style.display = "block";
      return;
    }

    // Password match validation
    if (password !== confirmPassword) {
      errorMessage.innerText = "Passwords do not match!";
      errorMessage.style.display = "block";
      return;
    }

    errorMessage.style.display = "none"; // Hide error message if validation passes

    // Proceed with AJAX request
    const urlParams = new URLSearchParams(window.location.search);
    const email = urlParams.get('email');

    const data = {
      Email: email,
      newPassword: password
    };
    $("#sendResetLink").prop("disabled", true).addClass("btn-primary").html('Submitting... ');

    $.ajax({
      url: '{{ url("/api/resetpassword") }}',
      type: 'PUT',
      data: JSON.stringify(data),
      contentType: 'application/json',
      headers: {
      'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      success: function (response) {
      $('#successModal').modal('show');
      // alert('Password reset successful!');
      setTimeout(function () {
        window.location.href = '/'; 
      },2000);
      },
      error: function (error) {
      console.error('There was an error resetting the password!', error);
      // alert('Failed to reset password. Please try again.');
      $('#errorModal').modal('show');
      },
      complete: function () {
      $("#sendResetLink").prop("disabled", false).html('Submit');
      }
    });
    });

  </script>

@endsection