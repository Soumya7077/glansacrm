@extends('layouts/contentNavbarLayout')
@section('title', 'Formatted Details - Formatted Applicants to Employer')

@section('content')
<!-- <h4><span class="text-muted fw-light">Home /</span> Formatted Applicants to Employer </h4> -->

<div class="card mb-4">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Formatted Applicants to Employer</h5> <small class="text-muted float-end">Provide the required
      details to process the application</small>
  </div>
  <div class="card-body">
    <form id="emailForm" class="needs-validation" novalidate>
      <div class="row">
        <div class="col-md-6">
          <div class="form-floating form-floating-outline mb-4">
            <select class="form-control" id="to" required>
              <option value="" hidden>Select Recipient</option>
              <option value="1">abc@appolo.com</option>
              <option value="2">soumya@gmail.com</option>
              <option value="3">sourav@gmail.com</option>
            </select>
            <label for="to">To</label>
            <div class="invalid-feedback">Please select a recipient.</div>
          </div>

          <div class="form-floating form-floating-outline mb-4">
            <input type="text" name="" id="" class="form-control" placeholder="Enter email">
            <label for="Applicants">CC</label>
            <div class="invalid-feedback">Please select an applicant.</div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-floating form-floating-outline mb-4">
            <input type="text" id="Subject-description" class="form-control" placeholder="Subject" required />
            <label for="Subject-description">Subject </label>
            <div class="invalid-feedback">Please provide a subject description.</div>
          </div>
        </div>
      </div>

      <div class="table-responsive mt-2">
        <table class="table table-bordered">
          <thead>
            <tr class="text-center align-middle">
              <th>Applicant Name</th>
              <th>Key Skills</th>
              <th>Job Description</th>
              <th>Experience</th>
            </tr>
          </thead>
          <tbody>
            <tr class="text-center align-middle">
              <td>Naveen Nagam</td>
              <td>Medical Assistant, Surgeon</td>
              <td>Frontend Developer</td>
              <td>3 Years</td>
            </tr>
            <tr class="text-center align-middle">
              <td>Anita Seth</td>
              <td>Medical Assistant, Surgeon</td>
              <td>Backend Developer</td>
              <td>4 Years</td>
            </tr>
            <!-- Add more rows as needed -->
          </tbody>
        </table>
      </div>

      <button type="submit" class="btn btn-primary mt-3">Send Mail</button>
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
        Mail Sent Successfully
      </div>
      <div class="modal-footer">
        <a href="/formattedapplicantslist" class="btn btn-primary">OK</a>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  // Form submission handler
  $('#emailForm').on('submit', function (e) {
    e.preventDefault(); // Prevent the default form submission

    // Display the success modal
    var successModal = new bootstrap.Modal(document.getElementById('successModal'));
    successModal.show(); // Show the success modal

    // Reset the form after displaying the modal
    $('#emailForm')[0].reset();
  });

  // Example of validation if needed:
  // $(document).ready(function () {
  //     $('#emailForm').on('submit', function (event) {
  //         let isValid = true;
  //         const toField = $('#to');
  //         if (toField.val() === '') {
  //             toField.addClass('is-invalid');
  //             isValid = false;
  //         } else {
  //             toField.removeClass('is-invalid').addClass('is-valid');
  //         }

  //         const applicantsField = $('#Applicants');
  //         if (applicantsField.val() === '') {
  //             applicantsField.addClass('is-invalid');
  //             isValid = false;
  //         } else {
  //             applicantsField.removeClass('is-invalid').addClass('is-valid');
  //         }

  //         const subjectDescription = $('#Subject-description');
  //         if (subjectDescription.val().trim() === '') {
  //             subjectDescription.addClass('is-invalid');
  //             isValid = false;
  //         } else {
  //             subjectDescription.removeClass('is-invalid').addClass('is-valid');
  //         }

  //         if (!isValid) {
  //             event.preventDefault();
  //             event.stopPropagation();
  //         }

  //         $(this).addClass('was-validated');
  //     });
  // });
</script>

@endsection