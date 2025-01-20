@extends('layouts/blankLayout')

@section('title', 'Login Basic - Pages')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
<div class="position-relative">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-4">

      <!-- Login -->

      <div class="card p-2">
        <!-- Logo -->
        <div class="app-brand justify-content-center mt-5">
          <a href="{{url('/')}}" class="app-brand-link gap-2">
            <img class="app-brand-logo demo" src="assets/img/Glansa Solutions.png" height="20" />
            <span class="app-brand-text demo text-heading fw-semibold">Glansa HealthCare CRM</span>
          </a>
        </div>
        <!-- /Logo -->

        <div class="card-body mt-2 text-center">
          <h4 class="mb-2">Welcome to Glansa Health Care! 👋</h4>
          <p class="mb-4">Please sign-in to your account and start the adventure</p>
          <form id="loginForm" class="mb-3">
            @csrf {{-- CSRF token for security --}}

            <div class="form-floating form-floating-outline mb-3">
              <input type="text" class="form-control" id="email" name="Email" placeholder="Enter your email" required>
              <label for="email">Email</label>
              <small class="text-danger d-none" id="email-error">Please enter a valid email</small>
            </div>

            <div class="mb-3">
              <div class="form-password-toggle">
                <div class="input-group input-group-merge">
                  <div class="form-floating form-floating-outline">
                    <input type="password" id="password" class="form-control" name="Password" placeholder="**********"
                      required>
                    <label for="password">Password</label>
                  </div>
                  <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                </div>
              </div>
              <small class="text-danger d-none" id="password-error">Password must be at least 6 characters</small>
            </div>

            <div class="mb-3 d-flex justify-content-between">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember-me">
                <label class="form-check-label" for="remember-me">Remember Me</label>
              </div>
              <a href="{{ url('auth/forgot-password-basic') }}" class="float-end mb-1">
                <span>Forgot Password?</span>
              </a>
            </div>

            <div class="mb-3">
              <button id="signInBtn" class="btn btn-primary d-grid w-100" type="submit">
                <span id="btnText">Sign in</span>
                <span id="btnLoader" class="spinner-border spinner-border-sm d-none text-primary text-center text-bold"
                  role="status" aria-hidden="true"></span>
              </button>
            </div>

            <!-- Error Message -->
            <div id="error-message" class="alert alert-danger d-none"></div>
          </form>


          <!-- <p class="text-center">
            <span>New on our platform?</span>
            <a href="{{url('auth/register-basic')}}">
              <span>Create an account</span>
            </a>
          </p> -->
        </div>
      </div>
      <!-- /Login -->
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
  $(document).ready(function () {
    $("#loginForm").submit(function (e) {
      e.preventDefault(); // Prevent default form submission

      let email = $("#email").val().trim();
      let password = $("#password").val().trim();
      let csrfToken = $('input[name=_token]').val(); // Get CSRF token

      let isValid = true;

      if (!validateEmail(email)) {
        $("#email-error").removeClass("d-none").text("Please enter a valid email");
        isValid = false;
      } else {
        $("#email-error").addClass("d-none");
      }

      if (password.length < 6) {
        $("#password-error").removeClass("d-none").text("Password must be at least 6 characters");
        isValid = false;
      } else {
        $("#password-error").addClass("d-none");
      }

      if (!isValid) return; // Stop if validation fails

      $("#signInBtn").attr("disabled", true);
      $("#btnText").text("Signing in...");
      $("#btnLoader").removeClass("d-none");

      $.ajax({
        url: "{{ url('/api/login') }}", // Laravel login route
        type: "POST",
        data: {
          Email: email,
          Password: password,
          _token: csrfToken // Include CSRF token
        },
        success: function (response) {
          console.log(response);
          localStorage.setItem('token', JSON.stringify(response));
          window.location.href = "{{ url('/dashboard') }}"; // Redirect to dashboard on success
          setTimeout(function () {
            if (window.history && window.history.pushState) {
              window.history.pushState(null, null, window.location.href);
              window.onpopstate = function () {
                window.history.pushState(null, null, window.location.href);
              };
            }
          }, 100);
        },
        error: function (xhr) {
          let errorMessage = "Invalid email or password";

          if (xhr.responseJSON && xhr.responseJSON.error) {
            errorMessage = xhr.responseJSON.error;
          }

          $("#error-message").removeClass("d-none").text(errorMessage);

          $("#signInBtn").attr("disabled", false);
          $("#btnText").text("Sign in");
          $("#btnLoader").addClass("d-none");
        }
      });
    });

    function validateEmail(email) {
      let regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return regex.test(email);
    }

    window.onload = function () {
      // Prevent back navigation after login
      if (window.history && window.history.pushState) {
        // Push a new state to prevent going back
        window.history.pushState(null, null, window.location.href);
        window.onpopstate = function () {
          window.history.pushState(null, null, window.location.href);
        };
      }
    };

  });
</script>

@endsection