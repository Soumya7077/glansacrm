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
          <div class="form-floating form-floating-outline mb-4">
            <input type="text" id="Message" class="form-control" placeholder="Message" required />
            <label for="Message">Message </label>
            <div class="invalid-feedback">Please provide a Message.</div>
          </div>
        </div>
      </div>

      <div class="table-responsive mt-2">
        <table class="table table-bordered" id="tableEmail">
          <thead>
            <tr class="text-center align-middle">
              <th>Applicant Name</th>
              <th>Key Skills</th>
              <th>Job Description</th>
              <th>Experience</th>
            </tr>
          </thead>
          <tbody id="employerTableBody">

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

<script>

  $(document).ready(function () {
    // Get the URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    let applicants = urlParams.get('applicants');

    // If no applicants data is found in the URL, show a message
    if (!applicants) {
      console.log("No data found in URL");
      $("#employerTableBody").html('<tr><td colspan="4" class="text-center text-muted py-3">No applicants selected.</td></tr>');
      return;
    }

    // Decode the URL-encoded applicants data (if it's base64 encoded)
    try {
      applicants = JSON.parse(decodeURIComponent(applicants)); // Decode URL component and parse JSON
    } catch (error) {
      console.error("Failed to decode or parse applicants data", error);
      $("#employerTableBody").html('<tr><td colspan="4" class="text-center text-muted py-3">Failed to retrieve applicants data.</td></tr>');
      return;
    }

    console.log("Retrieved Data:", applicants);

    // Function to populate the employer table
    function populateEmployerTable() {
      let tbody = $("#employerTableBody");
      tbody.empty();

      // If no applicants, show the "No applicants" message
      if (applicants.length === 0) {
        tbody.append('<tr><td colspan="4" class="text-center text-muted py-3">No applicants selected.</td></tr>');
        return;
      }

      // Loop through the applicants and create rows for the table
      applicants.forEach(applicant => {
        let row = `<tr class="text-center align-middle">
        <td>${applicant.name}</td>
        <td>${applicant.keySkills}</td>
        <td>${applicant.jobDescription}</td>
        <td>${applicant.experience} years</td>
      </tr>`;
        tbody.append(row);
      });
    }

    // Populate the table with data
    populateEmployerTable();
  });

  $.ajax({
    url: '/api/getEmployer', // Replace with your actual API endpoint
    type: 'GET',
    dataType: 'json',
    success: function (response) {
      if (response.status === "success") {
        let select = $('#to');
        select.empty(); // Clear existing options

        select.append('<option value="" hidden>Select Recipient</option>');

        response.data.forEach(employer => {
          select.append(`<option value="${employer.FirstContactEmail}">${employer.OrganizationName}  - ${employer.FirstContactEmail}</option>`);
        });
      } else {
        console.error("Error fetching employers:", response.message);
        // Handle error, e.g., display an error message to the user
      }
    },
    error: function () {
      console.error("Error fetching employers from server.");
      // Handle error, e.g., display an error message to the user
    }
  });

  // Form submission handler
  // Form submission handler
  $('#emailForm').on('submit', function (e) {
    e.preventDefault(); // Prevent the default form submission

    // Get form data
    const formData = {
      to: $('#to').val(),
      subject: $('#Subject-description').val(),
      message: $('#Message').val(),
      cc: $('#cc').val() ? $('#cc').val().trim().split(',').map(email => email.trim()) : [],
      table: $('#tableEmail').html()
    };

    // Send AJAX request
    $.ajax({
      url: '/api/send-formatted-email', // Replace with your actual API endpoint
      type: 'POST',
      data: JSON.stringify(formData),
      contentType: 'application/json',
      success: function (response) {
        console.log(response); // Log the response from the server
        if (response.message === 'Email sent successfully!') {
          // Display the success modal
          var successModal = new bootstrap.Modal(document.getElementById('successModal'));
          successModal.show(); // Show the success modal

          // Reset the form after displaying the modal
          $('#emailForm')[0].reset();
        } else {
          // Handle error, e.g., display an error message to the user
          alert('Error sending email: ' + response.message);
        }
      },
      error: function () {
        console.error('Error sending email request.');
        // Handle error, e.g., display an error message to the user
        alert('Error sending email.');
      }
    });
  });

</script>

@endsection