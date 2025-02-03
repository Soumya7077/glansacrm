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
            <div class="card p-4" style="margin-top: -150px">
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
                        @csrf
                        <div class="mb-3">
                            <div class="form-password-toggle">
                                <div class="input-group input-group-merge">
                                    <div class="form-floating form-floating-outline">
                                        <input type="password" id="currentPassword" class="form-control"
                                            name="currentPassword" placeholder="Enter Current Password" required>
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
                                    <div class="form-floating form-floating-outline">
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
                                    <div class="form-floating form-floating-outline">
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
                        <div id="errorMessage" class="alert alert-danger d-none"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Password Changed Successfully</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Your password has been updated successfully.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('page-script')
<script>
    document.getElementById('changePasswordForm').addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent form from submitting normally

        // Clear previous error messages
        document.getElementById('errorMessage').classList.add('d-none');
        document.getElementById('errorMessage').innerHTML = '';

        // Get form data
        const currentPassword = document.getElementById('currentPassword').value;
        const newPassword = document.getElementById('newPassword').value;
        const confirmPassword = document.getElementById('confirmPassword').value;

        // Get user data from local storage
        const userData = JSON.parse(localStorage.getItem('userData'));
        if (!userData) {
            alert('User data not found in localStorage');
            return;
        }

        // Validate form inputs
        if (!currentPassword || !newPassword || !confirmPassword) {
            showError('All fields are required.');
            return;
        }

        if (newPassword !== confirmPassword) {
            showError('New password and confirmation do not match.');
            return;
        }

        if (currentPassword === newPassword) {
            showError('New password cannot be the same as the current password.');
            return;
        }

        console.log(userData.Email, 'fdfddffd');

        const data = {
            "Email": userData.Email,
            "currentPass": currentPassword,
            "newPass": newPassword
        }

        document.getElementById('btnText').classList.add('d-none');
        document.getElementById('btnLoader').classList.remove('d-none');

        $.ajax({
            url: '/api/changePassword',
            method: 'PUT',  // HTTP Method
            data: data,  // Data to send

            beforeSend: function () {
                document.getElementById('btnText').classList.add('d-none');
                document.getElementById('btnLoader').classList.remove('d-none');
            },
            success: function (data) {
                document.getElementById('btnText').classList.remove('d-none');
                document.getElementById('btnLoader').classList.add('d-none');

                if (data.success) {
                    // Show success modal
                    $('#successModal').modal('show');

                    $('#successModal').on('hidden.bs.modal', function () {
                        // Reset form fields
                        document.getElementById('changePasswordForm').reset();

                        // Hide error message if any
                        document.getElementById('errorMessage').classList.add('d-none');
                        document.getElementById('errorMessage').innerHTML = '';

                        // Optionally, reset other UI elements like the loader button
                        document.getElementById('btnText').classList.remove('d-none');
                        document.getElementById('btnLoader').classList.add('d-none');
                    });
                } else {
                    showError(data.error || 'An error occurred while changing the password.');
                }
            },
            error: function (xhr, status, error) {
                console.log('Error:', error);  // Logging the actual error
                document.getElementById('btnText').classList.remove('d-none');
                document.getElementById('btnLoader').classList.add('d-none');
                // showError('An error occurred. Please try again later.');
                showError('Incorrect current password. Please try again.');

            }
        });

    });

    function showError(message) {
        const errorMessage = document.getElementById('errorMessage');
        errorMessage.classList.remove('d-none');
        errorMessage.innerHTML = message;
    }
</script>
@endsection