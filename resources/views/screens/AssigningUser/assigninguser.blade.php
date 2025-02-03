@extends('layouts/contentNavbarLayout')
@section('title', 'AssigningUser - Assigning User')

@section('content')
<!-- <h4><span class="text-muted fw-light">Home /</span> Assigning User </h4> -->

<div class="d-flex justify-content-between align-items-center py-3">
  <h3 class="mb-0">Assigning User</h3>
  <button id="clearForm" class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
    data-bs-target="#offcanvasBackdrop" aria-controls="offcanvasBackdrop"> Assigning User </button>
</div>

<div>
  <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover shadow-sm text-sm" id="table">
      <thead class="table-dark text-center small">
        <tr class="text-center align-middle">
          <th>S No.</th>
          <th>Name</th>
          <th>Job Title</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="tbody">

      </tbody>
    </table>
  </div>
</div>

<div class="col-lg-4 col-md-6">
  <div class="mt-3">
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasBackdrop" aria-labelledby="offcanvasBackdropLabel">
      <div class="offcanvas-header">
        <h5 id="offcanvasBackdropLabel" class="offcanvas-title">Assigning User</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <hr>
      <div class="offcanvas-body mx-0 flex-grow-0">
        <form id="assignUserForm" novalidate>
          @csrf
          <input type="hidden" id="userId">
          <div class="row">
            <div class="col-md-12">
              <div class="form-floating form-floating-outline mb-4">
                <select class="form-control" id="recruiter" required>
                  <option value="" hidden>Select Recruiter</option>
                </select>
                <label for="recruiter">Recruiter</label>
                <div class="invalid-feedback">Please select a recruiter.</div>
              </div>
              <div class="form-floating form-floating-outline mb-4">
                <select class="form-control" id="Job-Title" required>
                  <option value="" hidden>Select Job Title</option>
                </select>
                <label for="Job-Title">Job Title</label>
                <div class="invalid-feedback">Please select a job title.</div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary w-100 mb-2" id="assignBtn">Submit</button>
        </form>
        <button type="button" class="btn btn-outline-secondary d-grid w-100" id="cancelButton">Cancel</button>
      </div>
    </div>
  </div>
</div>


<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="successModalLabel"></h5>
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

@endsection

@push('scripts')
  <script>

    // Cancel button behavior (if applicable)
    $('#cancelButton').on('click', function () {
    $('#assignUserForm')[0].reset();
    $('#assignUserForm').find('.is-invalid').removeClass('is-invalid');
    });

    // Handle "clear form" button click
    $(document).on('click', '#clearForm', function () {
    $('#assignUserForm')[0].reset();
    $('#offcanvasBackdrop').offcanvas('show');
    $('.offcanvas-title').text('Assign User');
    $('#assignUserForm button[type="submit"]').text('Submit');
    });

    // Cancel button behavior in offcanvas
    $('#cancelButton').on('click', function () {
    $('#assignUserForm')[0].reset();
    $('#recruiter, #Job-Title').removeClass('is-valid is-invalid');
    });
    function fetchAssignedRecruiter(userId) {
    var table = $('#table').DataTable();
    let tbody = $("#tbody");
    tbody.html('<tr><td colspan="4" class="text-primary">Loading...</td></tr>'); // Show loading text

    $.ajax({
      url: `/api/assignedrecruiter`,
      method: "GET",
      dataType: "json",
      success: function (response) {
      console.log(response, 'errre');
      tbody.empty(); // Clear previous data

      if (response.status === "success") {
        let assignedRecruiters = response.data;

        if (assignedRecruiters.length > 0) {
        assignedRecruiters.forEach((recruiter, index) => {
          let rows = `
                  <tr class="text-center align-middle">
                    <td>${index + 1}</td>
                    <td>${recruiter.FirstName} ${recruiter.LastName}</td>
                    <td>${recruiter.Title}</td>
                    <td>
                    <button class="btn btn-primary btn-sm editAssignment"  data-id="${recruiter.assignedId}">
                                  Edit
                                  </button>
                    <button class="btn btn-danger btn-sm deleteAssignment"  data-id="${recruiter.assignedId}">
                                  Delete
                    </td>
                  </tr>`;
          tbody.append(rows);

        });
        table.clear(); // Clear any previous DataTable data
        table.rows.add(tbody.find('tr')).draw();
        } else {
        tbody.append(`<tr><td colspan="4" class="text-center">No assigned recruiters found.</td></tr>`);
        }
        // $('#tbody').html(rows);
      } else {
        tbody.html(`<tr><td colspan="4" class="text-center text-danger">Error: ${response.message}</td></tr>`);
      }
      },
      error: function (xhr, status, error) {
      tbody.html(`<tr><td colspan="4" class="text-center text-danger">Error loading data.</td></tr>`);
      console.error("Error fetching recruiters:", xhr.responseText);
      }
    });
    }

    fetchAssignedRecruiter();

    $(document).ready(function () {
    // Fetch recruiters
    $.ajax({
      url: "/api/getrecruiter",
      method: "GET",
      dataType: "json",
      success: function (data) {
      const recruiterSelect = $('#recruiter');
      recruiterSelect.empty();
      if (data.status === "success" && Array.isArray(data.data) && data.data.length > 0) {
        recruiterSelect.append('<option hidden value="">Select Recruiter</option>');
        data.data.forEach(recruiter => {
        // Concatenate FirstName and LastName
        let recruiterName = recruiter.FirstName + " " + recruiter.LastName;
        recruiterSelect.append('<option value="' + recruiter.id + '">' + recruiterName + '</option>');
        });
      } else {
        recruiterSelect.append('<option value="" hidden>No recruiters available</option>');
        console.warn('No recruiters found.');
      }
      },
      error: function (xhr, status, error) {
      console.error('Error fetching recruiters:', error);
      alert('Error fetching recruiters: ' + error);
      }
    });

    // Fetch job titles
    $.ajax({
      url: "/api/getJob",
      method: "GET",
      dataType: "json",
      success: function (data) {
      const jobTitleSelect = $('#Job-Title');
      jobTitleSelect.empty();
      if (data.status === "success" && Array.isArray(data.data) && data.data.length > 0) {
        jobTitleSelect.append('<option hidden value="">Select Job Title</option>');
        data.data.forEach(job => {
        jobTitleSelect.append('<option value="' + job.id + '">' + job.Title + '</option>');
        });
      } else {
        jobTitleSelect.append('<option value="" hidden>No job titles available</option>');
        console.warn('No job titles found.');
      }
      },
      error: function (xhr, status, error) {
      console.error('Error fetching job titles:', error);
      alert('Error fetching job titles: ' + error);
      }
    });



    // Form submission
    $('#assignUserForm').on('submit', function (e) {
      e.preventDefault();

      let isValid = true;
      const recruiter = $('#recruiter').val();
      const jobTitle = $('#Job-Title').val();
      const userId = $('#userId').val();  // Get stored ID

      if (!recruiter) {
      $('#recruiter').addClass('is-invalid');
      isValid = false;
      } else {
      $('#recruiter').removeClass('is-invalid').addClass('is-valid');
      }

      if (!jobTitle) {
      $('#Job-Title').addClass('is-invalid');
      isValid = false;
      } else {
      $('#Job-Title').removeClass('is-invalid').addClass('is-valid');
      }

      let userData = JSON.parse(localStorage.getItem('userData'));

      if (isValid) {
      const formData = {
        jobId: jobTitle,
        userId: recruiter,
        assignedBy: userData.id
      };

      $('#assignBtn').prop('disabled', true).text('Submitting...');

      let url = userId ? `/api/updateassignuser/${userId}` : "/api/assignrecruitertojob";
      let method = userId ? "PUT" : "POST";

      $.ajax({
        url: url,
        method: method,
        contentType: "application/json",
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: JSON.stringify(formData),
        dataType: "json",
        success: function (data) {
        if (data.status === "success") {
          console.log(data, 'rwewerq');
          $('.modal-title').text("Success");
          $('.modal-body').text(data.message);
          var successModal = new bootstrap.Modal(document.getElementById('successModal'));
          successModal.show();

          // Reset form and close offcanvas
          $('#assignUserForm')[0].reset();
          $('#recruiter, #Job-Title').removeClass('is-valid');
          $('#offcanvasBackdrop').offcanvas('hide');
          fetchAssignedRecruiter();
        } else {
          console.error('Error:', data.message);
        }
        },
        error: function (xhr) {
        console.error('Error:', xhr);
        $('.modal-title').text("Error");
        $('.modal-body').text(xhr.responseJSON.message);
        var errorModal = new bootstrap.Modal(document.getElementById('successModal'));
        errorModal.show();
        },
        complete: function () {
        // Re-enable button and restore text
        $('#assignBtn').prop('disabled', false).text('Submit');
        }
      });
      }
    });


    });

    $(document).on('click', '.editAssignment', function () {

    const id = $(this).data('id');

    $.ajax({
      url: `/api/getassignedrecruiter/${id}`,
      method: "GET",
      dataType: "json",
      success: function (response) {
      if (response.status === "success") {
        let data = response.data;
        console.log("Edit Data:", data);

        // Populate form fields
        $('#userId').val(id);  // Store ID for update
        let checkDropdownsLoaded = setInterval(function () {
        if ($('#recruiter option').length > 0 && $('#Job-Title option').length > 0) {
          clearInterval(checkDropdownsLoaded);

          // Set values and trigger change
          $('#recruiter').val(data.UserId).trigger('change');
          $('#Job-Title').val(data.JobId).trigger('change');
        }
        }, 100); // Check every 100ms

        // Change form button text
        $('.offcanvas-title').text('Edit Assigned User');
        $('#assignUserForm button[type="submit"]').text('Update');

        // Open the offcanvas
        var offcanvas = new bootstrap.Offcanvas(document.getElementById('offcanvasBackdrop'));
        offcanvas.show();
      } else {
        console.error('Error fetching assignment data:', response.message);
      }
      },
      error: function (xhr, status, error) {
      console.error('Error fetching assignment:', xhr.responseText);
      alert('Error fetching assignment details.');
      }
    });
    })


    $(document).on('click', '.deleteAssignment', function () {
    const id = $(this).data('id');
    console.log("Delete clicked for ID:", id);  // Debugging


    $('.modal-title').text("Success");
          $('.modal-body').text(data.message);
          var successModal = new bootstrap.Modal(document.getElementById('successModal'));
          successModal.show();

    if (!confirm('Are you sure you want to delete this assignment?')) return;

    $.ajax({
      url: `/api/deleteassignuser/${id}`,
      method: "DELETE",
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function (response) {
      console.log(response, 'delete response');

      if (response) {
        $('#successModalLabel').text("Success");
        $('.modal-body').text("Assigned Data deleted successfully.");
        var successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();

        // Refresh the assigned recruiters list after modal is closed
        $('#successModal').on('hidden.bs.modal', function () {
        fetchAssignedRecruiter();
        });
      } else {
        $('#successModalLabel').text("Error");
        $('.modal-body').text("Failed to delete data.");
        var errorModal = new bootstrap.Modal(document.getElementById('successModal'));
        errorModal.show();
      }
      },
      error: function (xhr, status, error) {
      console.error("Error deleting assignment:", xhr.responseText);
      $('#successModalLabel').text("Error");
      $('.modal-body').text("Failed to delete data.");
      var errorModal = new bootstrap.Modal(document.getElementById('successModal'));
      errorModal.show();
      }
    });
    });


  </script>
@endpush
