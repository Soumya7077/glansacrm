@extends('layouts/contentNavbarLayout')
@section('title', 'Applicants - Applicants Apply')

@section('content')
<h4><span class="text-muted fw-light">Home /</span> Applicants Apply</h4>

<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Applicants Apply</h5> <small class="text-muted float-end">Please provide your details
            below</small>
    </div>
    <div class="card-body">
        <form id="jobApplicationForm" class="needs-validation" novalidate>
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="name" placeholder="First Name" required />
                        <label for="name">First Name</label>
                        <div class="invalid-feedback">Please enter your First name.</div>
                    </div>
                    
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="tel" class="form-control" id="phone-number" placeholder="Phone Number"  maxlength="10" required />
                        <label for="phone-number">Phone Number</label>
                        <div class="invalid-feedback">Please enter a valid phone number.</div>
                    </div>
                    
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="number" class="form-control" id="work-experience" placeholder="Work Experience"
                            required />
                        <label for="work-experience">Work Experience</label>
                        <div class="invalid-feedback">Please enter your work experience.</div>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="number" class="form-control" id="current-salary" placeholder="Current Salary"
                            required />
                        <label for="current-salary">Current Salary</label>
                        <div class="invalid-feedback">Please enter your current salary.</div>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="file" class="form-control" id="resume" required />
                        <label for="resume">Resume</label>
                        <div class="invalid-feedback">Please upload your resume.</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="name" placeholder="Last Name" required />
                        <label for="name">Last Name</label>
                        <div class="invalid-feedback">Please enter your Last name.</div>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="email" class="form-control" id="email" placeholder="Email" required />
                        <label for="email">Email</label>
                        <div class="invalid-feedback">Please enter a valid email address.</div>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="highest-qualification"
                            placeholder="Highest Qualification" required />
                        <label for="highest-qualification">Highest Qualification</label>
                        <div class="invalid-feedback">Please enter your highest qualification.</div>
                    </div>
                   
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="number" class="form-control" id="expected-salary" placeholder="Expected Salary"
                            required />
                        <label for="expected-salary">Expected Salary</label>
                        <div class="invalid-feedback">Please enter your expected salary.</div>
                    </div>
                   
                    
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        $('#jobApplicationForm').on('submit', function (event) {
            let isValid = true;

            const name = $('#name');
            if (name.val().trim() === '') {
                name.addClass('is-invalid');
                isValid = false;
            } else {
                name.removeClass('is-invalid').addClass('is-valid');
            }

            const phoneNumber = $('#phone-number');
            const phoneRegex = /^[0-9]{10}$/; 
            if (!phoneRegex.test(phoneNumber.val().trim())) {
                phoneNumber.addClass('is-invalid');
                isValid = false;
            } else {
                phoneNumber.removeClass('is-invalid').addClass('is-valid');
            }

            const email = $('#email');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; 
            if (!emailRegex.test(email.val().trim())) {
                email.addClass('is-invalid');
                isValid = false;
            } else {
                email.removeClass('is-invalid').addClass('is-valid');
            }

            const workExperience = $('#work-experience');
            if (workExperience.val().trim() === '' || parseInt(workExperience.val()) < 0) {
                workExperience.addClass('is-invalid');
                isValid = false;
            } else {
                workExperience.removeClass('is-invalid').addClass('is-valid');
            }

            const currentSalary = $('#current-salary');
            if (currentSalary.val().trim() === '' || parseInt(currentSalary.val()) < 0) {
                currentSalary.addClass('is-invalid');
                isValid = false;
            } else {
                currentSalary.removeClass('is-invalid').addClass('is-valid');
            }

            const expectedSalary = $('#expected-salary');
            if (expectedSalary.val().trim() === '' || parseInt(expectedSalary.val()) < 0) {
                expectedSalary.addClass('is-invalid');
                isValid = false;
            } else {
                expectedSalary.removeClass('is-invalid').addClass('is-valid');
            }

            const highestQualification = $('#highest-qualification');
            if (highestQualification.val().trim() === '') {
                highestQualification.addClass('is-invalid');
                isValid = false;
            } else {
                highestQualification.removeClass('is-invalid').addClass('is-valid');
            }

            const resume = $('#resume');
            if (resume.val() === '') {
                resume.addClass('is-invalid');
                isValid = false;
            } else {
                resume.removeClass('is-invalid').addClass('is-valid');
            }

            if (!isValid) {
                event.preventDefault();
                event.stopPropagation();
            }
        });

        $('#jobApplicationForm input, #jobApplicationForm textarea').on('input change', function () {
            const input = $(this);
            if (input.val().trim() === '' || (input.attr('type') === 'number' && input.val() < 0)) {
                input.addClass('is-invalid').removeClass('is-valid');
            } else {
                input.removeClass('is-invalid').addClass('is-valid');
            }
        });
    });
</script>

@endsection