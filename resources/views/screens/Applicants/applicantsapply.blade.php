@extends('layouts/contentNavbarLayout')
@section('title', 'Applicants - Applicants Apply')

@section('content')
<!-- <h4><span class="text-muted fw-light">Home /</span> Applicants Apply</h4> -->

<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Applicants Apply</h5> <small class="text-muted float-end">* - Mandatory Fields</small>
    </div>
    <div class="card-body">
        <form id="jobApplicationForm" class="needs-validation" novalidate>
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="first-name" placeholder="First Name" required
                            pattern="[A-Za-z\s]+" />
                        <label for="first-name">First Name *</label>
                        <div class="invalid-feedback">Please enter your First name.</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="last-name" placeholder="Last Name" required />
                        <label for="last-name">Last Name *</label>
                        <div class="invalid-feedback">Please enter your Last name.</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="tel" class="form-control" id="phone-number" placeholder="Phone Number"
                            maxlength="10" required />
                        <label for="phone-number">Phone Number *</label>
                        <div class="invalid-feedback">Please enter a valid phone number.</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="email" class="form-control" id="email" placeholder="Email" required />
                        <label for="email">Email *</label>
                        <div class="invalid-feedback">Please enter a valid email address.</div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="url" class="form-control" id="portfolio"
                            placeholder="Portfolio/LinkedIn Profile" />
                        <label for="portfolio">Portfolio/LinkedIn Profile</label>
                    </div>
                </div>
                <div class="col-md-6">

                    <div class="form-floating form-floating-outline mb-4">
                        <select name="" id="applyingfor" class="form-select">
                            <option value="">Select Job Post</option>
                        </select>
                        <label for="applyingfor">Applying For *</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="highest-qualification"
                            placeholder="Highest Qualification" required />
                        <label for="highest-qualification">Highest Qualification *</label>
                        <div class="invalid-feedback">Please enter your highest qualification.</div>
                    </div>
                </div>
                <div class="col-md-6">

                    <div class="form-floating form-floating-outline mb-4">
                        <select name="" id="type" class="form-select">
                            <option value="Fresher">Fresher</option>
                            <option value="Experience">Experience</option>
                        </select>
                        <label for="type">Type</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="current-location" placeholder="Current Location" />
                        <label for="current-location">Current Location</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="preferred-location"
                            placeholder="Preferred Location" />
                        <label for="preferred-location">Preferred Location</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="number" class="form-control" id="height" placeholder="Height" />
                        <label for="height">Height</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="number" class="form-control" id="weight" placeholder="Weight" />
                        <label for="weight">Weight</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="blood-group" placeholder="Blood Group" />
                        <label for="blood-group">Blood Group</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="number" class="form-control" id="hemoglobin" placeholder="Hemoglobin %" />
                        <label for="hemoglobin">Hemoglobin %</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <select name="" id="noticeperiod" class="form-select">
                            <option value="" hidden>Select Notice Period</option>
                            <option value="Immediate">Immediate</option>
                            <option value="15 days">15 days</option>
                            <option value="1 month">1 month</option>
                            <option value="more than one month">more than one month</option>
                        </select>
                        <label for="noticeperiod">Notice Period *</label>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="current-organisation"
                            placeholder="Current Organisation" />
                        <label for="current-organisation">Current Organisation</label>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="number" class="form-control" id="current-salary" placeholder="Current Salary"
                            required />
                        <label for="current-salary">Current Salary*</label>
                        <div class="invalid-feedback">Please enter your current salary.</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="number" class="form-control" id="expected-salary" placeholder="Expected Salary"
                            required />
                        <label for="expected-salary">Expected Salary *</label>
                        <div class="invalid-feedback">Please enter your expected salary.</div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="file" class="form-control" id="resume" required />
                        <label for="resume">Resume *</label>
                        <div class="invalid-feedback">Please upload your resume.</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="file" class="form-control" id="certificates" />
                        <label for="certificates">Certificates</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">

                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="experience" placeholder="Experience" />
                        <label for="experience">Work Experience (in years)</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <textarea class="form-control" id="remarks" placeholder="Remarks"></textarea>
                        <label for="remarks">Remarks</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="KeySkills" placeholder="Skills" />
                        <label for="KeySkills">Key Skills</label>
                    </div>

                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

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
                Thank you for applying!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {

            $.ajax({
                url: '/api/getJob',
                type: 'GET',
                success: function (response) {
                    if (response.status === 'success' && response.data) {
                        const jobData = response.data; // Array of job objects
                        const $dropdown = $('#applyingfor');

                        // Loop through the job data and add options to the dropdown
                        jobData.forEach(function (job) {
                            const option = $('<option></option>')
                                .val(job.id) // Set the value as the job ID
                                .text(job.Title); // Display the job title
                            $dropdown.append(option);
                        });
                    } else {
                        console.error('Error fetching job data:', response.message);
                    }
                },
                error: function (xhr) {
                    console.error('Failed to fetch jobs:', xhr.responseText);
                }
            });

            $('#jobApplicationForm').on('submit', function (e) {
                e.preventDefault();
                let isValid = true;

                // First Name Validation (Only alphabets and spaces allowed)
                let firstName = $('#first-name').val().trim();
                if (!/^[A-Za-z\s]+$/.test(firstName)) {
                    $('#first-name').addClass('is-invalid');
                    isValid = false;
                } else {
                    $('#first-name').removeClass('is-invalid');
                }

                // Last Name Validation (Only alphabets and spaces allowed)
                let lastName = $('#last-name').val().trim();
                if (!/^[A-Za-z\s]+$/.test(lastName)) {
                    $('#last-name').addClass('is-invalid');
                    isValid = false;
                } else {
                    $('#last-name').removeClass('is-invalid');
                }

                // Phone Number Validation (Exactly 10 digits)
                let phoneNumber = $('#phone-number').val().trim();
                if (!/^\d{10}$/.test(phoneNumber)) {
                    $('#phone-number').addClass('is-invalid');
                    isValid = false;
                } else {
                    $('#phone-number').removeClass('is-invalid');
                }

                // Email Validation
                let email = $('#email').val().trim();
                if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                    $('#email').addClass('is-invalid');
                    isValid = false;
                } else {
                    $('#email').removeClass('is-invalid');
                }

                // Portfolio/LinkedIn Profile URL Validation
                // let portfolio = $('#portfolio').val().trim();
                // if (portfolio && !/^https?:\/\/[^\s]+$/.test(portfolio)) {
                //     $('#portfolio').addClass('is-invalid');
                //     isValid = false;
                // } else {
                //     $('#portfolio').removeClass('is-invalid');
                // }

                // Job Post Selection Validation
                if ($('#applyingfor').val() === '') {
                    $('#applyingfor').addClass('is-invalid');
                    isValid = false;
                } else {
                    $('#applyingfor').removeClass('is-invalid');
                }

                let typeValue = $('#type').val().trim();
                if (!typeValue || typeValue === '' || typeValue === '0') { // Check if it's empty or default
                    $('#type').addClass('is-invalid');
                    isValid = false;
                } else {
                    $('#type').removeClass('is-invalid');
                }

                // Qualification Validation
                if ($('#highest-qualification').val().trim() === '') {
                    $('#highest-qualification').addClass('is-invalid');
                    isValid = false;
                } else {
                    $('#highest-qualification').removeClass('is-invalid');
                }

                // Current Salary Validation (Positive Number)
                let currentSalary = $('#current-salary').val().trim();
                if (!/^\d+(\.\d{1,2})?$/.test(currentSalary) || currentSalary <= 0) {
                    $('#current-salary').addClass('is-invalid');
                    isValid = false;
                } else {
                    $('#current-salary').removeClass('is-invalid');
                }

                // Expected Salary Validation (Positive Number)
                let expectedSalary = $('#expected-salary').val().trim();
                if (!/^\d+(\.\d{1,2})?$/.test(expectedSalary) || expectedSalary <= 0) {
                    $('#expected-salary').addClass('is-invalid');
                    isValid = false;
                } else {
                    $('#expected-salary').removeClass('is-invalid');
                }

                // // Height Validation (Non-negative number)
                // let height = $('#height').val().trim();
                // if (height && (!/^\d+(\.\d{1,2})?$/.test(height) || height < 0)) {
                //     $('#height').addClass('is-invalid');
                //     isValid = false;
                // } else {
                //     $('#height').removeClass('is-invalid');
                // }

                // // Weight Validation (Non-negative number)
                // let weight = $('#weight').val().trim();
                // if (weight && (!/^\d+(\.\d{1,2})?$/.test(weight) || weight < 0)) {
                //     $('#weight').addClass('is-invalid');
                //     isValid = false;
                // } else {
                //     $('#weight').removeClass('is-invalid');
                // }

                // // Blood Group Validation (A+, A-, B+, B-, O+, O-, AB+, AB-)
                // let bloodGroup = $('#blood-group').val().trim();
                // if (bloodGroup && !/^(A|B|O|AB)[+-]$/.test(bloodGroup)) {
                //     $('#blood-group').addClass('is-invalid');
                //     isValid = false;
                // } else {
                //     $('#blood-group').removeClass('is-invalid');
                // }

                // // Hemoglobin Validation (Non-negative number)
                // let hemoglobin = $('#hemoglobin').val().trim();
                // if (hemoglobin && (!/^\d+(\.\d{1,2})?$/.test(hemoglobin) || hemoglobin < 0)) {
                //     $('#hemoglobin').addClass('is-invalid');
                //     isValid = false;
                // } else {
                //     $('#hemoglobin').removeClass('is-invalid');
                // }

                // Notice Period Validation
                if ($('#noticeperiod').val() === '') {
                    $('#noticeperiod').addClass('is-invalid');
                    isValid = false;
                } else {
                    $('#noticeperiod').removeClass('is-invalid');
                }

                // Resume Upload Validation
                if ($('#resume')[0].files.length === 0) {
                    $('#resume').addClass('is-invalid');
                    isValid = false;
                } else {
                    $('#resume').removeClass('is-invalid');
                }

                if (isValid) {
                    var formData = new FormData(this);
                    formData.append('jobpost_id', $('#applyingfor').val());
                    formData.append('Source', 'Website');
                    formData.append('FirstName', $('#first-name').val());
                    formData.append('LastName', $('#last-name').val());
                    formData.append('email', $('#email').val());
                    formData.append('phone', $('#phone-number').val());
                    formData.append('Qualification', $('#highest-qualification').val());
                    // formData.append('Applying For', $('#applyingfor').val());
                    formData.append('Experience', $('#experience').val());
                    formData.append('CurrentSalary', $('#current-salary').val());
                    formData.append('ExpectedSalary', $('#expected-salary').val());
                    formData.append('Resume', $('#resume')[0].files[0]); // Get the file input
                    formData.append('KeySkills', $('#KeySkills').val());
                    formData.append('StatusId', 1);
                    formData.append('Portfolio', $('#portfolio').val());
                    formData.append('Type', $('#type').val());
                    formData.append('CurrentLocation', $('#current-location').val());
                    formData.append('PreferredLocation', $('#preferred-location').val());
                    formData.append('Height', $('#height').val());
                    formData.append('Weight', $('#weight').val());
                    formData.append('BloodGroup', $('#blood-group').val());
                    formData.append('Hemoglobin', $('#hemoglobin').val());
                    formData.append('NoticePeriod', $('#noticeperiod').val());
                    formData.append('CurrentOrganization', $('#current-organisation').val());
                    formData.append('Certificates', $('#certificates')[0].files[0]);
                    formData.append('Remarks', $('#remarks').val());
                    // formData.append('Feedback', $('#Feedback').val());

                    $.ajax({
                        url: '/api/applicant', // Your API endpoint
                        type: 'POST',
                        data: formData,
                        processData: false, // Important: Prevent jQuery from converting the data into a query string
                        contentType: false, // Important: Let the browser set the correct Content-Type
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Ensure CSRF token is included
                        },
                        beforeSend: function () {
                            // Disable submit button to prevent multiple clicks
                            $('button[type="submit"]').prop('disabled', true);
                        },
                        success: function (response) {
                            if (response.status === 'success') {
                                // Show success modal
                                var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                                successModal.show();

                                // Reset the form
                                $('#jobApplicationForm')[0].reset();
                            } else {
                                // Show error message (if any)
                                console.log(response.message, 'wewgwefwe');
                            }
                        },
                        error: function (xhr) {
                            var errors = xhr.responseJSON;

                            if (errors && errors.message) {
                                console.log(errors.message);
                            } else {
                                console.log('Something went wrong. Please try again.');
                            }
                        },
                        complete: function () {
                            // Re-enable submit button
                            $('button[type="submit"]').prop('disabled', false);
                        }
                    });
                }

            });
        });

        // $('#jobApplicationForm').on('submit', function (e) {
        //     e.preventDefault();
        //     var successModal = new bootstrap.Modal(document.getElementById('successModal'));
        //     successModal.show();
        //     $('#jobApplicationForm')[0].reset();
        // });

    </script>
@endpush