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
          <input type="text" hidden id="smid">
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
                <label for="experience">Work Experience (in years)</label>
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
                <select name="" id="noticeperiod" class="form-select" required>
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
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const applicantId = urlParams.get('applicant_id'); // Still fetching but not using it

        console.log("Applicant ID:", applicantId);

        // if (applicantId) {
        //   $.ajax({
        //     url: '/api/getapplicant/' + applicantId,
        //     type: 'GET',
        //     success: function (response) {
        //       console.log("Response Data:", response);
        //       if (response) {
        //         const data = response.data;

        //         $('#firstname').val(data.FirstName);
        //         $('#lastname').val(data.LastName);
        //         $('#phone').val(data.PhoneNumber);
        //         $('#email').val(data.Email);
        //         $('#qualification').val(data.Qualification);
        //         $('#experience').val(data.Experience);
        //         $('#current-salary').val(data.CurrentSalary);
        //         $('#expected-salary').val(data.ExpectedSalary);
        //         $('#remarks').val(data.Remarks);
        //         $('#noticeperiod').val(data.NoticePeriod);
        //         $('#job-post').val(data.JobPostId);

        //         if (data.Resume) {
        //           $('#uploadResume').val(data.Resume);
        //         }
        //       } else {
        //         console.error('Error fetching applicant data:', response.message);
        //       }
        //     },
        //     error: function (xhr) {
        //       console.error('Failed to fetch applicant data:', xhr.responseText);
        //     }
        //   });
        // } else {
          $('#enquiryForm').on('submit', function (e) {
            e.preventDefault();
            let isValid = true;

            let firstName = $('#firstname').val().trim();
            if (!/^[A-Za-z\s]+$/.test(firstName)) {
              $('#firstname').addClass('is-invalid');
              isValid = false;
            } else {
              $('#firstname').removeClass('is-invalid');
            }

            let lastName = $('#lastname').val().trim();
            if (!/^[A-Za-z\s]+$/.test(lastName)) {
              $('#lastname').addClass('is-invalid');
              isValid = false;
            } else {
              $('#lastname').removeClass('is-invalid');
            }

            let phoneNumber = $('#phone').val().trim();
            if (!/^\d{10}$/.test(phoneNumber)) {
              $('#phone').addClass('is-invalid');
              isValid = false;
            } else {
              $('#phone').removeClass('is-invalid');
            }

            let email = $('#email').val().trim();
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
              $('#email').addClass('is-invalid');
              isValid = false;
            } else {
              $('#email').removeClass('is-invalid');
            }

            if ($('#job-post').val() === '') {
              $('#job-post').addClass('is-invalid');
              isValid = false;
            } else {
              $('#job-post').removeClass('is-invalid');
            }

            if ($('#qualification').val().trim() === '') {
              $('#qualification').addClass('is-invalid');
              isValid = false;
            } else {
              $('#qualification').removeClass('is-invalid');
            }

            let currentSalary = $('#current-salary').val().trim();
            let expectedSalary = $('#expected-salary').val().trim();
            let remarks = $('#remarks').val().trim();
            let noticePeriod = $('#noticeperiod').val();
            let jobPost = $('#job-post').val();

            if (!isValid) return;

            // Prepare form data for submission
            var formData = new FormData(this);
            formData.append('jobpost_id', jobPost);
            formData.append('Source', 'Enquiry');
            formData.append('FirstName', firstName);
            formData.append('LastName', lastName);
            formData.append('email', email);
            formData.append('phone', phoneNumber);
            formData.append('Qualification', $('#qualification').val().trim());
            formData.append('Experience', $('#experience').val().trim());
            formData.append('CurrentSalary', currentSalary);
            formData.append('ExpectedSalary', expectedSalary);
            formData.append('Resume', $('#uploadResume')[0].files[0]);
            formData.append('NoticePeriod', noticePeriod);
            formData.append('Remarks', remarks);
            formData.append('StatusId', 1);

            $.ajax({
              url: '/api/applicant',
              type: 'POST',
              data: formData,
              processData: false,
              contentType: false,
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              beforeSend: function () {
                $('button[type="submit"]').prop('disabled', true);
              },
              success: function (response) {
                if (response.status === 'success') {
                  var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                  successModal.show();
                  $('#enquiryForm')[0].reset();
                } else {
                  console.error('Error submitting form:', response.message);
                }
              },
              error: function (xhr) {
                var errors = xhr.responseJSON;
                if (errors && errors.message) {
                  console.error(errors.message);
                } else {
                  console.error('Something went wrong. Please try again.');
                }
              },
              complete: function () {
                $('button[type="submit"]').prop('disabled', false);
              }
            });
          });
        // }

        $.ajax({
          url: '/api/getJob',
          type: 'GET',
          success: function (response) {
            if (response.status === 'success' && response.data) {
              const jobData = response.data;
              const $dropdown = $('#job-post');
              jobData.forEach(function (job) {
                const option = $('<option></option>').val(job.id).text(job.Title);
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


      });

    </script>
    @endsection