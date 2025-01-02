@extends('layouts/contentNavbarLayout')

@section('title', 'Social Media Form')

@section('content')

<div class="col-xxl">
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Social Media Form</h5>
        </div>
        <div class="card-body">
            <form id="socialMediaForm" novalidate>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" id="applicantName" name="applicantName"
                                placeholder="Name" required />
                            <label for="applicantName">Applicant Name</label>
                            <div class="invalid-feedback">Please enter the applicant's name.</div>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="tel" maxlength="10" class="form-control" id="phoneNumber" name="phoneNumber"
                                placeholder="Phone Number" pattern="^[6-9]\d{9}$" required />
                            <label for="phoneNumber">Phone Number</label>
                            <div class="invalid-feedback">Please enter a valid 10-digit phone number starting with 6, 7,
                                8, or 9.</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-4">
                            <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline">
                                    <input type="email" id="email" name="email" class="form-control"
                                        placeholder="user.name" aria-label="john.doe" aria-describedby="emailHelp"
                                        required />
                                    <label for="email">Email</label>
                                    <div class="invalid-feedback">Please enter a valid email address.</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <select id="interestedIn" name="interestedIn" class="form-select" required>
                                <option hidden value="">Interested In</option>
                                <option value="1">Role 1</option>
                                <option value="2">Role 2</option>
                                <option value="3">Role 3</option>
                            </select>
                            <label for="interestedIn">Interested In</label>
                            <div class="invalid-feedback">Please select a role.</div>
                        </div>
                    </div>
                </div>

                <!-- <button type="submit" class="btn btn-primary">Add</button> -->
                <a href="smlist" class="btn btn-primary">Add</a>
            </form>
        </div>
    </div>
</div>

<script>
    $(function () {
        const phoneInput = $('#phoneNumber');
        const phoneRegex = /^[6-9]\d{9}$/;

        // Dynamically validate phone number
        phoneInput.on('input', function () {
            const value = $(this).val();
            if (phoneRegex.test(value)) {
                $(this).removeClass('is-invalid').addClass('is-valid');
            } else {
                $(this).removeClass('is-valid').addClass('is-invalid');
            }
        });

        // Form submission validation
        $('#socialMediaForm').on('submit', function (e) {
            const form = this;

            if (!form.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
            }

            if (!phoneRegex.test(phoneInput.val())) {
                e.preventDefault();
                phoneInput.addClass('is-invalid');
            }

            $(form).addClass('was-validated');
        });
    });
</script>

@endsection