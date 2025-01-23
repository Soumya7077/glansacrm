@extends('layouts/contentNavbarLayout')
@section('title', 'FormattedDetails - Formatted Applicants List')

@section('content')
<!-- <h4><span class="text-muted fw-light">Home /</span> Formatted Applicants List </h4> -->
<div class="container-fluid mt-3 px-0">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Formatted Applicants List</h3>
  </div>
  <div class="container-fluid mt-3 px-0">
    <div class="table-responsive">
      <table class="table table-bordered table-striped table-hover shadow-sm text-sm" id="table">
        <thead class="table-dark text-center small">
          <tr class="text-center align-middle">
            <th>Select Applicant</th>
            <th>Applicant Name</th>
            <th>Job Title</th>
            <th>Job Description</th>
            <th>Experience(In Years)</th>
            <th>Key Skills</th>
            <th>Current Salary</th>
            <th>Expected Salary</th>
            <th>Notice Period(In Days)</th>
            <th>Highest Qualification</th>
            <th>Feedback</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="tableBody">

        </tbody>
      </table>
    </div>
    <div class="d-flex justify-content-end mt-3">
      <a class="btn btn-primary text-white me-2" id="sendButton">Send</a>
      <a href="{{ url('schedule') }}" class="btn btn-primary">Schedule an interview</a>
    </div>
  </div>
</div>

<div class="col-lg-4 col-md-6">
  <div class="mt-3">
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasBackdrop" aria-labelledby="offcanvasBackdropLabel">
      <div class="offcanvas-header">
        <h5 id="offcanvasBackdropLabel" class="offcanvas-title"></h5>
        <button type="button" class="btn-close text-reset"></button>
      </div>
      <hr>
      <div class="offcanvas-body mx-0 flex-grow-0">
        <form id="addUserForm" novalidate>
          @csrf
          <input type="hidden" id="userId">
          <div class="row">
            <div class="col-md-12">

              <div class="form-floating form-floating-outline mb-4">
                <input type="text" class="form-control" id="fullname" placeholder="Feedback" required />
                <label for="basic-default-fullname">Feedback</label>
                <div class="invalid-feedback">Please fill .</div>
              </div>
              <button type="submit" class="btn btn-primary w-100 mb-2">Submit</button>
              <button type="button" class="btn btn-outline-secondary d-grid w-100" id="cancelButton">Cancel</button>
            </div>
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
        <h5 class="modal-title" id="successModalLabel">Success</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Feedback Updated successfully
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

@push('scripts')
  <script>
    $(document).ready(function () {
    let selectedApplicants = [];

    function fetchApplicants() {
      $("#tableBody").html('<tr id="loadingRow"><td colspan="13" class="text-center text-muted py-3">Loading data, please wait...</td></tr>');

      $.ajax({
      url: '/api/getapplicant',
      type: 'GET',
      dataType: 'json',
      success: function (response) {
        if (response.status === "success") {
        let filteredApplicants = response.data.filter(applicant => applicant.StatusId == "2");

        if (filteredApplicants.length > 0) {
          populateTable(filteredApplicants);
        } else {
          $("#tableBody").html('<tr><td colspan="13" class="text-center text-muted py-3">No applicants found.</td></tr>');
        }
        } else {
        $("#tableBody").html('<tr><td colspan="13" class="text-center text-muted py-3">No applicants found.</td></tr>');
        }
      },
      error: function () {
        $("#tableBody").html('<tr><td colspan="13" class="text-center text-danger py-3">Error loading data! Please try again.</td></tr>');
      }
      });
    }

    function populateTable(applicants) {
      let tbody = $("#table tbody");
      tbody.empty(); // Clear existing rows

      applicants.forEach(applicant => {
      let row = `<tr class="text-center small align-middle">
    <td><input type="checkbox" class="applicant-checkbox" data-id="${applicant.id}" data-name="${applicant.FirstName} ${applicant.LastName}" data-keyskills="${applicant.KeySkills}" data-jobdesc="Physician Assistant" data-exp="${applicant.Experience}"></td>     
     <td>${applicant.FirstName} ${applicant.LastName}</td>
      <td>Physician Assistant</td>
      <td>Physician Assistant</td>
      <td>${applicant.Experience}</td>
      <td>${applicant.KeySkills}</td>
      <td>${applicant.CurrentSalary}</td>
      <td>${applicant.ExpectedSalary}</td>
      <td>${applicant.NoticePeriod} </td>
      <td>${applicant.Qualification}</td>
      <td>${applicant.Feedback || "-"}</td>
      <td class="text-success">Shortlisted</td>
      <td><button class="btn btn-primary update-btn" data-id="${applicant.id}">Update</button></td>
      </tr>`;
      tbody.append(row);
      });
    }

    // Fetch applicants when the page loads
    fetchApplicants();

    $(document).on('change', '.applicant-checkbox', function () {
      let applicantData = {
      id: $(this).data('id'),
      name: $(this).data('name'),
      keySkills: $(this).data('keyskills'),
      jobDescription: $(this).data('jobdesc'),
      experience: $(this).data('exp')
      };

      if ($(this).is(':checked')) {
      selectedApplicants.push(applicantData);
      } else {
      selectedApplicants = selectedApplicants.filter(app => app.id !== applicantData.id);
      }
    });

    $("#sendButton").click(function () {
      if (selectedApplicants.length === 0) {
      alert("Please select at least one applicant.");
      return;
      }
      const applicantsJSON = JSON.stringify(selectedApplicants);

      // Encode the JSON string to base64
      const encodedApplicants = btoa(applicantsJSON);

      // Redirect with the base64 encoded data as a URL parameter
      window.location.href = "/formattedapplicantstoemployer?applicants=" + encodedApplicants;
    });

    // Show offcanvas when Update button is clicked
    $(document).on('click', '.update-btn', function () {
      let applicantId = $(this).data('id');
      $('#offcanvasBackdrop').offcanvas('show');
      $('.offcanvas-title').text('Update Feedback');
      $('#userId').val(applicantId);
    });

    // Handle form submission
    $('#addUserForm').on('submit', function (e) {
      e.preventDefault();
      $('#offcanvasBackdrop').offcanvas('hide');
      $('#successModal').modal('show');
      $('#addUserForm')[0].reset();
    });
    });
  </script>

@endpush

@endsection