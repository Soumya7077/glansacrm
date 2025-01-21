@extends('layouts/contentNavbarLayout')

@section('title', 'Enquiry Form')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Home /</span> Enquiry Form</h4>

<div class="row">
  <div class="col-xl">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Enquiry Form</h5>
        <small class="text-muted float-end"></small>
      </div>
      <div class="card-body">
        <form id="enquiryForm" novalidate>
          <!-- First Row -->
          <div class="row mb-3">
            <div class="col-md-6 mb-3">
              <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" id="firstname" placeholder="First Name" required />
                <label for="name">First Name</label>
                <div class="invalid-feedback">Please enter your First Name.</div>
              </div>
            </div>

            <div class="col-md-6 mb-3">
              <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" id="lastname" placeholder="Last Name" required />
                <label for="name">Last Name</label>
                <div class="invalid-feedback">Please enter your Last Name.</div>
              </div>
            </div>

          </div>

          <!-- Second Row -->
          <div class="row mb-3">
            <div class="col-md-6">
              <div class="form-floating form-floating-outline">
                <input type="tel" maxlength="10" class="form-control phone-mask" id="phone" placeholder="1234567890"
                  pattern="^\d{10}$" required />
                <label for="phone">Phone No</label>
                <div class="invalid-feedback">Please enter a valid 10-digit phone number.</div>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <div class="input-group input-group-merge">
                <div class="form-floating form-floating-outline">
                  <input type="email" class="form-control" id="email" placeholder="Email" required />
                  <label for="email">Email</label>
                  <div class="invalid-feedback">Please enter a valid email address.</div>
                </div>
              </div>
            </div>

          </div>

          <!-- Third Row -->
          <div class="row mb-3">
            <div class="col-md-6">
              <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" id="qualification" placeholder="Qualification" required />
                <label for="qualification">Qualification</label>
                <div class="invalid-feedback">Please enter your qualification.</div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" id="experience" placeholder="Work Experience" required />
                <label for="experience">Work Experience</label>
                <div class="invalid-feedback">Please enter your work experience.</div>
              </div>
            </div>
          </div>

          <!-- Fourth Row -->
          <div class="row mb-3">
            <div class="col-md-6 mb-3">
              <div class="form-floating form-floating-outline">
                <input type="number" class="form-control" id="current-salary" placeholder="Current Salary" required />
                <label for="current-salary">Current Salary</label>
                <div class="invalid-feedback">Please enter your current salary.</div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating form-floating-outline">
                <input type="number" class="form-control" id="expected-salary" placeholder="Expected Salary" required />
                <label for="expected-salary">Expected Salary</label>
                <div class="invalid-feedback">Please enter your expected salary.</div>
              </div>
            </div>
          </div>

          <!-- Resume Upload -->
          <div class="row mb-3">
            <div class="col-md-6 mb-3">
              <div class="form-floating form-floating-outline">
                <select class="form-control" id="job-post" required>
                  <option value="" hidden>Select Job Post</option>
                  
                </select>
                <label for="job-post">Job Post</label>
                <div class="invalid-feedback">Please select a job post.</div>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <div class="form-floating form-floating-outline">
                <input type="file" class="form-control" id="uploadResume" required />
                <label for="uploadResume">Upload Resume</label>
                <div class="invalid-feedback">Please upload your resume.</div>
              </div>
            </div>
          </div>

          <!-- six Row -->
          <div class="row mb-3">
            <div class="col-md-6">
              <div class="form-floating form-floating-outline">
                <select name="" id="noticeperiod" class="form-select">
                  <option value="Immediate">Immediate Joiner</option>
                  <option value="30">0-30 days</option>
                  <option value="45">30-45 days</option>
                  <option value="60">45-60 days</option>
                  <option value="60+">More than 60 days</option>
                </select>
                <label for="qualification">Notice Period</label>
                <div class="invalid-feedback">Please enter your Remark.</div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" id="remarks" placeholder="Remark" required />
                <label for="qualification">Remark</label>
                <div class="invalid-feedback">Please enter your Remark.</div>
              </div>
            </div>
          </div>


          <!-- Submit Button -->
          <div class="col-md-6">
            <button type="submit" class="btn btn-primary">Submit</button>
            <!-- <a href="enquiry?" type="submit" class="btn btn-primary">Submit</a> -->
          </div>
        </form>
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
            Enquiry Form Submitted Successfully
          </div>
          <div class="modal-footer">
            <a href="/enquiry" class="btn btn-primary">OK</a>

          </div>
        </div>
      </div>
    </div>

    <script>
        $(document).ready(function () {

            $.ajax({
                url: '/api/getJob',
                type: 'GET',
                success: function (response) {
                    if (response.status === 'success' && response.data) {
                        const jobData = response.data; // Array of job objects
                        const $dropdown = $('#job-post');

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

            $('#enquiryForm').on('submit', function (e) {
                e.preventDefault();
                let isValid = true;

                // First Name Validation (Only alphabets and spaces allowed)
                let firstName = $('#firstname').val().trim();
                if (!/^[A-Za-z\s]+$/.test(firstName)) {
                    $('#firstname').addClass('is-invalid');
                    isValid = false;
                } else {
                    $('#firstname').removeClass('is-invalid');
                }

                // Last Name Validation (Only alphabets and spaces allowed)
                let lastName = $('#lastname').val().trim();
                if (!/^[A-Za-z\s]+$/.test(lastName)) {
                    $('#lastname').addClass('is-invalid');
                    isValid = false;
                } else {
                    $('#lastname').removeClass('is-invalid');
                }

                // Phone Number Validation (Exactly 10 digits)
                let phoneNumber = $('#phone').val().trim();
                if (!/^\d{10}$/.test(phoneNumber)) {
                    $('#phone').addClass('is-invalid');
                    isValid = false;
                } else {
                    $('#phone').removeClass('is-invalid');
                }

                // Email Validation
                let email = $('#email').val().trim();
                if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                    $('#email').addClass('is-invalid');
                    isValid = false;
                } else {
                    $('#email').removeClass('is-invalid');
                }

               
                // Job Post Selection Validation
                if ($('#job-post').val() === '') {
                    $('#job-post').addClass('is-invalid');
                    isValid = false;
                } else {
                    $('#ajob-post').removeClass('is-invalid');
                }

                // let typeValue = $('#type').val().trim();
                // if (!typeValue || typeValue === '' || typeValue === '0') { // Check if it's empty or default
                //     $('#type').addClass('is-invalid');
                //     isValid = false;
                // } else {
                //     $('#type').removeClass('is-invalid');
                // }

                // Qualification Validation
                if ($('#qualification').val().trim() === '') {
                    $('#qualification').addClass('is-invalid');
                    isValid = false;
                } else {
                    $('#qualification').removeClass('is-invalid');
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

                // Notice Period Validation
                if ($('#noticeperiod').val() === '') {
                    $('#noticeperiod').addClass('is-invalid');
                    isValid = false;
                } else {
                    $('#noticeperiod').removeClass('is-invalid');
                }

                // Resume Upload Validation
                if ($('#uploadResume')[0].files.length === 0) {
                    $('#uploadResume').addClass('is-invalid');
                    isValid = false;
                } else {
                    $('#uploadResume').removeClass('is-invalid');
                }

                if (isValid) {
                    var formData = new FormData(this);
                    formData.append('jobpost_id', $('#job-post').val());
                    formData.append('Source', 'Enquiry');
                    formData.append('FirstName', $('#firstname').val());
                    formData.append('LastName', $('#lastname').val());
                    formData.append('email', $('#email').val());
                    formData.append('phone', $('#phone').val());
                    formData.append('Qualification', $('#qualification').val());
                    // formData.append('Applying For', $('#applyingfor').val());
                    formData.append('Experience', $('#experience').val());
                    formData.append('CurrentSalary', $('#current-salary').val());
                    formData.append('ExpectedSalary', $('#expected-salary').val());
                    formData.append('Resume', $('#uploadResume')[0].files[0]); // Get the file input                   
                    formData.append('NoticePeriod', $('#noticeperiod').val());                  
                    formData.append('Remarks', $('#remarks').val());

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
    @endsection