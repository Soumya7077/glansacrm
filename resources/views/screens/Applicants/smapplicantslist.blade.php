@extends('layouts/contentNavbarLayout')
@section('title', 'Applicants - Social Media applicants list')

@section('content')
<div class="container-fluid mt-3 px-0">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Social Media Applicants list</h3>
  </div>
  <div id="loading-spinner" style="display: none;">
    <span>
      <h4 class="text-primary">Loading...</h4>
    </span>
  </div>
  <div class="d-flex align-items-center">
    <input type="checkbox" id="select-all" class="select-all-checkbox m-2">
    <h4 class="m-0">Select All Applicant's</h4>
  </div>
  <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover shadow-sm text-sm" id="table">
      <thead class="table-dark text-center small">
        <tr class="text-center align-middle">
          <th>Select Applicant's</th>
          <th>Applicant's Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Status</th>
          <th>Update</th>
        </tr>
      </thead>
      <tbody id="tbody">
      </tbody>
    </table>
  </div>
  <div class="d-flex justify-content-end mt-3">
    <button id="clearForm" class="btn btn-primary" type="button"> Assign </button>
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
            </div>
          </div>
          <button type="submit" class="btn btn-primary w-100 mb-2">Submit</button>
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
        <h5 class="modal-title" id="successModalLabel">Success</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Your data has been successfully assigned!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="errorModallLabel">Error</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Your data has been successfully assigned! -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
  <script>
    $(document).ready(function () {

    // Handle the "Update" button click
    $(document).on('click', '.update-btn', function (e) {
      e.preventDefault();  // Prevent default link behavior

      var applicantId = $(this).data('id');  // Get applicant ID from data-id attribute
      var applicantFirstName = $(this).data('FirstName');  // Get applicant name (First and Last name)
      var applicantLastName = $(this).data('LastName');
      var applicantEmail = $(this).data('email');  // Get applicant email
      var applicantPhone = $(this).data('phone');  // Get applicant phone number

      console.log(applicantId, applicantFirstName, applicantLastName, applicantEmail, applicantPhone);


      // Dynamically set the href to include the applicant_id in the query string
      var href = '/enquiryForm?applicant_id=' + applicantId + '&firstname=' + applicantFapplicantFirstName + '&lastname=' + applicantLastName + '&email=' + applicantEmail + '&phone=' + applicantPhone;

      // Redirect the user to the enquiry form page
      // window.location.href = href;
    });
    });

    let userData = JSON.parse(localStorage.getItem('userData'));

    if (userData.RoleId == 1) {
    $('#clearForm').addClass('d-block');
    $('#clearForm').removeClass('d-none');
    } else {
    $('#clearForm').removeClass('d-block');
    $('#clearForm').addClass('d-none');
    }

    var table = $('#table').DataTable();
    function fetchApplicants() {
    var tableBody = $('#tbody');
    tableBody.html('<tr><td colspan="6" class="text-primary">Loading...</td></tr>');
    // $('#loading-spinner').show();

    $.ajax({
      url: userData?.RoleId == 1 ? '/api/getsmapplicant' : `api/getsmapplicantbyrecruiter/${userData.id}`,
      type: 'GET',
      dataType: 'json',
      success: function (response) {
      console.log(response);
      // $('#loading-spinner').hide();
      tableBody.empty();
      if (response.status === 'success' && response.data.length > 0) {
        response.data.forEach((applicant) => {
        const applicantdata = JSON.stringify(applicant);
        const encodedApplicantData = encodeURIComponent(applicantdata);
        const rows = `
      <tr class="text-center small" data-id="${applicant.id}" data-firstname="${applicant.FirstName || ''}" data-lastname="${applicant.LastName || ''}" data-email="${applicant.Email || ''}" data-phone="${applicant.PhoneNumber || ''}">
      <td><input type="checkbox" class="select-applicant" data-id="${applicant.id}"></td>
      <td>${applicant.FirstName} ${applicant.LastName || ''}</td>
      <td>${applicant.Email || 'N/A'}</td>
      <td>${applicant.PhoneNumber || 'N/A'}</td>
      <td>${applicant.isAssigned == true ? "Assigned" : "Not Assigned" || 'N/A'}</td>
      <td><a href="/enquiryForm?applicant=${encodedApplicantData}"  class="btn btn-primary btn-sm">Update</a></td>
      </tr>
      `;
        tableBody.append(rows);
        table.clear(); // Clear any previous DataTable data
        table.rows.add(tableBody.find('tr')).draw();
        });
      } else {
        tableBody.append(`<tr><td colspan="5" class="text-center">No applicants found.</td></tr>`);
      }
      },
      error: function () {
      $('#loading-spinner').hide();
      $('#errorModal .modal-body').text('Failed to fetch applicants. Please try again later.');
      $('#errorModal').modal('show');
      // errorModal('Failed to fetch applicants. Please try again later.');
      }

    });
    }

    $('#clearForm').on('click', function (e) {
    e.preventDefault(); // Prevent any unintended behavior

    // Get selected applicants
    let selectedApplicants = $('.select-applicant:checked').map(function () {
      return $(this).data('id');
    }).get();

    if (selectedApplicants.length === 0) {
      $('#errorModal .modal-body').text('Please select at least one applicant.');
      $('#errorModal').modal('show');
      return;
    }

    // If at least one applicant is selected, show the offcanvas
    $('#offcanvasBackdrop').offcanvas('show');
    });

    function fetchRecruiters() {
    $.ajax({
      url: '/api/getrecruiter',
      type: 'GET',
      dataType: 'json',
      success: function (response) {
      if (response.status === 'success' && response.data.length > 0) {
        const recruiterSelect = $('#recruiter');
        recruiterSelect.empty();
        recruiterSelect.append('<option value="" hidden>Select Recruiter</option>');
        response.data.forEach((recruiter) => {
        recruiterSelect.append(`
      <option value="${recruiter.id}">
      ${recruiter.FirstName} ${recruiter.LastName}
      </option>
      `);
        });
      }
      },
      error: function () {
      $('#errorModal .modal-body').text('Failed to fetch Recruiter. Please try again later.');
      $('#errorModal').modal('show');
      }
    });
    }

    fetchApplicants();
    fetchRecruiters();

    $('#assignUserForm').on('submit', function (e) {
    e.preventDefault();

    let form = this;
    if (!form.checkValidity()) {
      $(form).addClass('was-validated');
      return;
    }

    // let selectedApplicants = [];
    // $('.select-applicant:checked').each(function () {
    //   selectedApplicants.push($(this).attr('data-id'));
    // });

    let selectedApplicants = $('.select-applicant:checked').map(function () {
      return $(this).data('id');
    }).get();

    let userData = JSON.parse(localStorage.getItem('userData'));
    let recruiterId = $('#recruiter').val();
    let assignedBy = userData.id;

    if (selectedApplicants.length === 0) {
      console.log('no applicant');

      // errorModal('Please select at least one applicant.');
      return;
    }
    if (!recruiterId) {
      // errorModal('Please select a recruiter.');
      return;
    }
    if (!assignedBy) {
      $('#errorModal .modal-body').text('Invalid Session');
      $('#errorModal').modal('show');
      // errorModal('Invalid session. Please refresh and try again.');
      return;
    }

    // let totalApplicants = selectedApplicants.length;
    // let completedRequests = 0;
    // let failedRequests = 0;
    console.log(selectedApplicants, 'ggsdgsgd');


    $.ajax({
      url: '/api/assignsmapplicant',
      type: 'POST',
      contentType: 'application/json',
      processData: false,
      data: JSON.stringify({
      applicantIds: selectedApplicants,
      userId: recruiterId,
      assignedBy: assignedBy,
      _token: $('meta[name="csrf-token"]').attr('content')
      }),
      success: function (response) {
      fetchApplicants();
      $('#successModal .modal-body').text(response.message);
      $('#successModal').modal('show');
      // $('#table').DataTable().ajax.reload();

      // Uncheck all selected checkboxes after submission
      $('.select-applicant:checked').prop('checked', false);

      // Close the offcanvas after submission
      let offcanvasElement = document.getElementById('offcanvasBackdrop');
      let offcanvasInstance = bootstrap.Offcanvas.getInstance(offcanvasElement);
      if (offcanvasInstance) {
        offcanvasInstance.hide();
      }
      },
      error: function (xhr) {
      if (xhr.status === 400) {
        let errorMessage = xhr.responseJSON.message;
        $('#errorModal .modal-body').text(errorMessage);
        $('#errorModal').modal('show');
        // errorModal(errorMessage);  // Show applicants who were already assigned
      } else {
        $('#errorModal .modal-body').text('Something went wrong. Please try again.');
        $('#errorModal').modal('show');
        // errorModal('Something went wrong. Please try again.');
      }
      }
    });




    $('#cancelButton').on('click', function () {
      $('#assignUserForm')[0].reset();
    });

    $('#select-all').on('change', function () {
      var isChecked = $(this).prop('checked');
      $('.select-applicant').prop('checked', isChecked);
    });

    $(document).on('change', '.select-applicant', function () {
      var allChecked = $('.select-applicant').length === $('.select-applicant:checked').length;
      $('#select-all').prop('checked', allChecked);
    });


    });
  </script>
@endpush