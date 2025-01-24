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
            <!-- <th>Job Description</th> -->
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
      <a id="scheduleButton" class="btn btn-primary text-white">Schedule an interview</a>
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
          <input type="hidden" id="applicantId">
          <input type="hidden" id="sid">
          <div class="row">
            <div class="col-md-12">

              <div class="form-floating form-floating-outline mb-4">
                <input type="text" class="form-control" id="feedback" placeholder="Feedback" required />
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

    $('#addUserForm').on('submit', function (e) {
      e.preventDefault();

      const applicantId = $('#applicantId').val();
      const feedback = $('#feedback').val();
      const status = $('#sid').val();

      if (!feedback) {
      alert('Please enter feedback.');
      return;
      }

      $.ajax({
      url: `/api/applicantStatusUpdate/${applicantId}`,
      type: 'PUT',
      data: {
        feedback: feedback,
        status: status
      },
      success: function (response) {
        if (response.success) {
        $('#successModal').modal('show');
        $('#addUserForm')[0].reset();
        $('#offcanvasBackdrop').offcanvas('hide');
        } else {
        console.log('Error updating feedback.');
        }
      },
      error: function () {
        alert('Error occurred. Please try again later.');
      }
      });
    });
    });





    $(document).on('dblclick', '.status-text', function () {
    let currentStatus = $(this).data('sid');
    console.log(currentStatus);
    let selectDropdown = $(this).siblings('.status-dropdown');

    $(this).hide();
    selectDropdown.show().val(currentStatus);
    });

    $(document).on('change', '.status-dropdown', function () {
    let newStatus = $(this).val();
    let applicantId = $(this).closest('.status-cell').data('id');
    let statusText = $(this).find('option:selected').text();

    $(this).hide();
    $(this).siblings('.status-text').text(statusText).show();

    $.ajax({
      url: '/api/applicantStatusUpdate/' + applicantId,
      type: 'PUT',
      data: { status: newStatus },
      success: function (response) {
      if (response) {
        console.log('Status updated successfully!');
      } else {
        console.log('Failed to update status!');
      }
      },
      error: function () {
      console.log('Error updating status');
      }
    });
    });





    $(document).ready(function () {
    let selectedApplicants = [];

    const userData = JSON.parse(localStorage.getItem('userData'));



    function fetchApplicants() {
      $("#tableBody").html('<tr id="loadingRow"><td colspan="13" class="text-center text-muted py-3">Loading data, please wait...</td></tr>');

      $.ajax({
      url: userData.RoleId == 1 ? '/api/getapplicant' : `/api/getformattedapplicantbyrecruiter/${userData.id}`,
      type: 'GET',
      dataType: 'json',
      success: function (response) {
        console.log(response, 'resssssss');

        if (response) {
        let filteredApplicants = response.data.filter(applicant => (applicant.StatusId == "2" || applicant.StatusId == "3" || applicant.StatusId == "4" || applicant.StatusId == "6" || applicant.StatusId == "7"));

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
      var table = $('#table').DataTable();
      let tbody = $("#table tbody");
      tbody.empty();
      console.log(applicants);

      applicants.forEach(applicant => {
      let row = `<tr class="text-center small align-middle">
    <td><input type="checkbox" class="applicant-checkbox" data-email="${applicant.Email}" data-id="${applicant.id}" data-name="${applicant.FirstName} ${applicant.LastName}" data-keyskills="${applicant.KeySkills}" data-jobid="${applicant.jobpost_id}" data-empid="${applicant.empId}" data-jobdesc="${applicant.Title}" data-exp="${applicant.Experience}"></td>
     <td>${applicant.FirstName} ${applicant.LastName}</td>
      <td>${applicant.Title}</td>
      <td>${applicant.Experience}</td>
      <td>${applicant.KeySkills}</td>
      <td>${applicant.CurrentSalary}</td>
      <td>${applicant.ExpectedSalary}</td>
      <td>${applicant.NoticePeriod} </td>
      <td>${applicant.Qualification}</td>
      <td>${applicant.Feedback && applicant.Feedback.length > 30 ? applicant.Feedback.substring(0, 30) + '...' : applicant.Feedback || "-"}</td>
     <td class="status-cell text-primary" data-id="${applicant.id}" data-current-status="${applicant.Status}">
    <span class="status-text" data-sid="${applicant.sid}">${applicant.sname}</span>
    <select class="form-select status-dropdown" style="width: 150px; display: none;">
    <option value="1" class="text-warning">Pending</option>
    <option value="2" class="text-warning">Formatted</option>
    <option value="3" class="text-warning">Mail Sent to Employer</option>
    <option value="4" class="text-success">Shortlisted</option>
    <option value="5" class="text-warning">Not Shortlisted</option>
    <option value="6" class="text-primary">Mail Sent to Candidate</option>
    <option value="7" class="text-primary">Selected</option>
    <option value="8" class="text-danger">Rejected</option>
    </select>
    </td>

      <td><button class="btn btn-primary update-btn" data-id="${applicant.id}" data-status="${applicant.sid}">Update</button></td>
      </tr>`;
      tbody.append(row);
      table.clear();
      table.rows.add(tbody.find('tr')).draw();
      });
    }

    fetchApplicants();


    $('#addUserForm').on('submit', function (e) {
      e.preventDefault();

      const applicantId = $('#applicantId').val();
      const feedback = $('#feedback').val();
      const status = $('#sid').val();

      if (!feedback) {
      alert('Please enter feedback.');
      return;
      }

      $.ajax({
      url: `/api/applicantStatusUpdate/${applicantId}`,
      type: 'PUT',
      data: {
        feedback: feedback,
        status: status
      },
      success: function (response) {
        if (response) {
        $('#successModal').modal('show');
        $('#addUserForm')[0].reset();
        $('#offcanvasBackdrop').offcanvas('hide');
        fetchApplicants();
        } else {
        console.log('Error updating feedback.');
        }
      },
      error: function () {
        alert('Error occurred. Please try again later.');
      }
      });
    });



    $(document).on('dblclick', '.status-text', function () {
      let currentStatus = $(this).data('sid');
      console.log(currentStatus);
      let selectDropdown = $(this).siblings('.status-dropdown');

      $(this).hide();
      selectDropdown.show().val(currentStatus);
    });

    $(document).on('change', '.status-dropdown', function () {
      let newStatus = $(this).val();
      let applicantId = $(this).closest('.status-cell').data('id');
      let statusText = $(this).find('option:selected').text();

      $(this).hide();
      $(this).siblings('.status-text').text(statusText).show();

      $.ajax({
      url: '/api/applicantStatusUpdate/' + applicantId,
      type: 'PUT',
      data: { status: newStatus },
      success: function (response) {
        if (response) {
        console.log('Status updated successfully!');
        } else {
        console.log('Failed to update status!');
        }
      },
      error: function () {
        console.log('Error updating status');
      }
      });
    });



    $(document).on('change', '.applicant-checkbox', function () {
      let applicantData = {
      id: $(this).data('id'),
      name: $(this).data('name'),
      keySkills: $(this).data('keyskills'),
      jobDescription: $(this).data('jobdesc'),
      experience: $(this).data('exp'),
      email: $(this).data('email'),
      jobId:$(this).data('jobid'),
      empId:$(this).data('empid')
      };

      console.log(applicantData);

      if ($(this).is(':checked')) {
      selectedApplicants.push(applicantData);
      } else {
      selectedApplicants = selectedApplicants.filter(app => app.id !== applicantData.id);
      }
    });

    $("#scheduleButton").click(function () {
      if (selectedApplicants.length === 0) {
      alert("Please select at least one applicant.");
      return;
      }
      const applicantsJSON = JSON.stringify(selectedApplicants);
      const encodedApplicants = encodeURIComponent(applicantsJSON);
      window.location.href = "/schedule?applicants=" + encodedApplicants;

    });

    $("#sendButton").click(async function () {
      if (selectedApplicants.length === 0) {
      alert("Please select at least one applicant.");
      return;
      }

      $("#sendButton").prop("disabled", true).text("Sending...");

      try {
      for (let applicant of selectedApplicants) {
        await $.ajax({
        url: `/api/applicantStatusUpdate/${applicant.id}`,
        type: 'PUT',
        contentType: 'application/json',
        data: JSON.stringify({ status: 3 }),
        success: function (response) {
          console.log(`Applicant ${applicant.id} status updated successfully.`);
        },
        error: function (xhr) {
          console.error(`Error updating status for applicant ${applicant.id}:`, xhr.responseText);
        }
        });
      }

      // Proceed with redirection after updating status
      const applicantsJSON = JSON.stringify(selectedApplicants);
      const encodedApplicants = encodeURIComponent(applicantsJSON);

      setTimeout(() => {
        window.location.href = "/formattedapplicantstoemployer?applicants=" + encodedApplicants;
      })

      } catch (error) {
      console.error("An error occurred:", error);
      alert("Failed to update applicant status. Please try again.");
      } finally {
      $("#sendButton").prop("disabled", false).text("Send");
      }
    });

    // Show offcanvas when Update button is clicked
    $(document).on('click', '.update-btn', function () {
      let applicantId = $(this).data('id');
      let sid = $(this).data('status');
      $('#offcanvasBackdrop').offcanvas('show');
      $('.offcanvas-title').text('Update Feedback');
      $('#applicantId').val(applicantId);
      $('#sid').val(sid);
    });
    });
  </script>

@endpush

@endsection
