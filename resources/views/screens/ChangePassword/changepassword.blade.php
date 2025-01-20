@extends('layouts/contentNavbarLayout')
@section('title', 'Change Password - Pages')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}">
@endsection

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="authentication-wrapper authentication-basic container">
        <div class="authentication-inner py-4 w-100" style="max-width: 450px;">
            <div class="card p-4">
                <!-- Logo -->
                <div class="app-brand justify-content-center mt-3">
                    <a href="{{url('/')}}" class="app-brand-link gap-2">
                        <img class="app-brand-logo demo" src="assets/img/Glansa Solutions.png" height="20" />
                        <span class="app-brand-text demo text-heading fw-semibold">Glansa HealthCare CRM</span>
                    </a>
                </div>
                <!-- /Logo -->

                <div class="card-body mt-2">
                    <h4 class="mb-2 text-center">Welcome to Glansa Health Care! 👋</h4>
                    <p class="mb-4 text-center">Change Password</p>

                    <form id="changePasswordForm" class="mb-3">
                        @csrf {{-- CSRF token for security --}}

                        <div class="mb-3">
                            <div class="form-password-toggle">
                                <div class="input-group input-group-merge">
                                    <div class="form-floating">
                                        <input type="password" id="currentPassword" class="form-control"
                                            name="currentPassword" placeholder="Enter Old Password" required>
                                        <label for="currentPassword">Current Password</label>
                                    </div>
                                    <span class="input-group-text cursor-pointer"><i
                                            class="mdi mdi-eye-off-outline"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-password-toggle">
                                <div class="input-group input-group-merge">
                                    <div class="form-floating">
                                        <input type="password" id="newPassword" class="form-control" name="newPassword"
                                            placeholder="Enter New Password" required>
                                        <label for="newPassword">New Password</label>
                                    </div>
                                    <span class="input-group-text cursor-pointer"><i
                                            class="mdi mdi-eye-off-outline"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-password-toggle">
                                <div class="input-group input-group-merge">
                                    <div class="form-floating">
                                        <input type="password" id="confirmPassword" class="form-control"
                                            name="confirmPassword" placeholder="Confirm New Password" required>
                                        <label for="confirmPassword">Confirm New Password</label>
                                    </div>
                                    <span class="input-group-text cursor-pointer"><i
                                            class="mdi mdi-eye-off-outline"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <button id="submitBtn" class="btn btn-primary d-grid w-100" type="submit">
                                <span id="btnText">Submit</span>
                                <span id="btnLoader" class="spinner-border spinner-border-sm d-none text-primary"
                                    role="status" aria-hidden="true"></span>
                            </button>
                        </div>

                        <!-- Error Message -->
                        <div id="error-message" class="alert alert-danger d-none"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('page-script')
<script>
    // Handle password change
    document.getElementById('changePasswordForm').addEventListener('submit', function (event) {
        event.preventDefault();

        const currentPassword = document.getElementById('currentPassword').value;
        const newPassword = document.getElementById('newPassword').value;
        const confirmPassword = document.getElementById('confirmPassword').value;

        const userData = JSON.parse(localStorage.getItem('userData')); // Get user data from local storage

        // Form validation
        if (!currentPassword || !newPassword || !confirmPassword) {
            showError('All fields are required!');
            return;
        }

        if (newPassword !== confirmPassword) {
            showError('New password and Confirm password must match!');
            return;
        }

        // Send the request to change the password
        const formData = new FormData();
        formData.append('currentPass', currentPassword);
        formData.append('newPass', newPassword);
        formData.append('Email', userData.Email);

        document.getElementById('submitBtn').disabled = true;
        document.getElementById('btnLoader').classList.remove('d-none');

        fetch('/changePassword', {
            method: 'PUT',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                document.getElementById('submitBtn').disabled = false;
                document.getElementById('btnLoader').classList.add('d-none');

                if (data.success) {
                    alert(data.success);
                    // window.location.href = '/login';
                } else {
                    showError(data.error || 'An error occurred, please try again.');
                }
            })
            .catch(error => {
                document.getElementById('submitBtn').disabled = false;
                document.getElementById('btnLoader').classList.add('d-none');
                showError('An error occurred, please try again.');
            });
    });

    function showError(message) {
        const errorMessage = document.getElementById('error-message');
        errorMessage.textContent = message;
        errorMessage.classList.remove('d-none');
    }
</script>
@endsection