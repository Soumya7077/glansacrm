@extends('layouts/contentNavbarLayout')
@section('title', 'Jobs - Job List')

@section('content')
<!-- <h4><span class="text-muted fw-light">Home /</span> Job List</h4> -->
<div class="container-fluid mt-3 px-0">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Job List</h3>
    <a class="btn btn-primary btn-sm" href="/jobpost">Add New Job</a>
  </div>
  <div id="loading-spinner" style="display: none;">
    <span>
      <h4 class="text-primary">Loading...</h4>
    </span>
  </div>
  <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover shadow-sm text-sm" id="table">
      <thead class="table-dark text-center small">
        <tr class="text-center align-middle">
          <th>Organisation Name</th>
          <th>Job Title</th>
          <th>Count</th>
          <th>Description</th>
          <th>Openings</th>
          <th>Job's Location</th>
          <th>Education</th>
          <th>Key Skills</th>
          <th>Department</th>
          <th>Min Salary</th>
          <th>Max Salary</th>
          <th>Min Experience</th>
          <th>Max Experience</th>
          <th>Employment Type</th>
          <th>Time line</th>
          <th>Location</th>
          <th>Shift</th>
          <th>Benefits</th>
          <th>Gender</th>
          <th>Remarks</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="tbody">

      </tbody>
    </table>
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

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

<!-- Error Modal -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="errorModalLabel">Error</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmationModalLabel">Delete Job</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this job?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    function fetchJobs() {
      // $('#loading-spinner').show();
      let userData = JSON.parse(localStorage.getItem('userData'));
      var tableBody = $('#tbody');
      var table = $('#table').DataTable();

      tableBody.html('<tr><td colspan="20" class="text-bold text-primary">Loading...</td></tr>');
      $.ajax({
        url: userData?.RoleId == 1 ? '/api/getJob' : `/api/assignedrecruiter/${userData?.id}`,
        type: 'GET',
        dataType: 'json',
        success: function (response) {
          // console.log(response);
          // $('#loading-spinner').hide();
          // $('#jobList').empty();
          tableBody.empty();
          if (response) {
            response.data.forEach((job) => {
              const rows = `
                <tr class="text-center small" data-id="${job.id}">
                  <td>${job.OrganizationName || 'N/A'}</td>
                  <td>${job.Title || 'N/A'}</td>
                  <td>${job.applicant_count || '0'}</td>
                  <td>${job.Description && job.Description.length > 30 ? job.Description.substring(0, 30) + '...' : job.Description || 'N/A'}</td>
                  <td>${job.Opening || 'N/A'}</td>
                  <td>${job.JobsLocation || 'N/A'}</td>
                  <td>${job.Education && job.Education.length > 30 ? job.Education.substring(0, 30) + '...' : job.Education || 'N/A'}</td>
                  <td>${job.KeySkills && job.KeySkills.length > 30 ? job.KeySkills.substring(0, 30) + '...' : job.KeySkills || 'N/A'}</td>
                  <td>${job.DepartmentName || 'N/A'}</td>
                  <td>${job.MinSalary || 'N/A'}</td>
                  <td>${job.MaxSalary || 'N/A'}</td>
                  <td>${job.MinExperience || 'N/A'}</td>
                  <td>${job.MaxExperience || 'N/A'}</td>
                  <td>${job.EmploymentType || 'N/A'}</td>
                  <td>${job.Timeline || 'N/A'}</td>
                  <td>${job.Location || 'N/A'}</td>
                  <td>${job.Shift || 'N/A'}</td>
                  <td>${job.Benefits || 'N/A'}</td>
                  <td>${job.Gender || 'N/A'}</td>
                  <td>${job.Remarks && job.Remarks.length > 30 ? job.Remarks.substring(0, 30) + '...' : job.Remarks || 'N/A'}</td>
                  <td>
                    <div class="d-inline-flex gap-2">
                      <a href="/applicantlist?job_id=${userData?.RoleId == 1 ? job.id : job.assignedId}" class="btn btn-primary btn-xs">View</a>
                      <a href="/jobpost?job_id=${userData?.RoleId == 1 ? job.id : job.assignedId}" class="btn btn-info btn-xs">Edit</a>
                      <button class="btn btn-danger btn-xs delete-btn" data-id="${userData?.RoleId == 1 ? job.id : job.assignedId}">Delete</button>
                    </div>
                  </td>
                </tr>
              `;
              tableBody.append(rows);

            });
            table.clear(); // Clear any previous DataTable data
            table.rows.add(tableBody.find('tr')).draw();
          } else {
            $('#jobList').append(`
              <tr>
                <td colspan="20" class="text-center">No jobs found.</td>
              </tr>
            `);
          }
        },
        error: function () {
          // $('#loading-spinner').hide();
          tableBody.html('<tr><td colspan="20" class="text-danger">Error fetching job data</td></tr>');
          showErrorModal('Failed to fetch job data. Please try again later.');
        }
      });
    }

    fetchJobs();

    $(document).on('click', '.delete-btn', function () {
      const jobId = $(this).data('id');
      $('#confirmationModal').modal('show');

      $('#confirmDeleteButton').off('click').on('click', function () {
        $.ajax({
          url: `/api/deleteJob/${jobId}`,
          type: 'DELETE',
          success: function (response) {
            $('#confirmationModal').modal('hide');

            if (response) {
              showSuccessModal('Job deleted successfully');
              fetchJobs();
              $(`#jobList tr[data-id="${jobId}"]`).remove();
            } else {
              showErrorModal('Failed to delete the job. Please try again.');
            }
          },
          error: function () {
            $('#confirmationModal').modal('hide');
            showErrorModal('An error occurred while trying to delete the job. Please try again later.');
          }
        });
      });
    });

    function showSuccessModal(message) {
      $('#successModal .modal-body').text(message);
      $('#successModal').modal('show');
    }

    function showErrorModal(message) {
      $('#errorModal .modal-body').text(message);
      $('#errorModal').modal('show');
    }
  });
</script>

@endsection