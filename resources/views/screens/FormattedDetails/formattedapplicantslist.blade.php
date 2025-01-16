@extends('layouts/contentNavbarLayout')
@section('title', 'FormattedDetails - Formatted Applicants List')

@section('content')
<h4><span class="text-muted fw-light">Home /</span> Formatted Applicants List </h4>
<div class="container-fluid mt-3 px-0">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Formatted Applicants List</h3>
  </div>
  <div class="container-fluid mt-3 px-0">
    <div class="table-responsive">
      <table class="table table-bordered table-striped table-hover shadow-sm text-sm" id="table">
        <thead class="table-dark text-center small">
          <tr>
            <th>Select Applicant</th>
            <th>Applicant Name</th>
            <th>Job Title</th>
            <th>Job Description</th>
            <th>Experience</th>
            <th>Key Skills</th>
            <th>Current Salary</th>
            <th>Expected Salary</th>
            <th>Notice Period</th>
            <th>Highest Qualification</th>
            <th>Feedback</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr class="text-center small">
            <th><input type="checkbox"></th>
            <td>Nagam</td>
            <td>Physician Assistant</td>
            <td>Physician Assistant</td>
            <td>5 years</td>
            <td>Communication Skills</td>
            <td>200000</td>
            <td>400000</td>
            <td>15 days</td>
            <td>BSc Nursing</td>
            <td>-</td>
            <td class="text-success">Shortlisted</td>
            <td><button id="addbtn" class="btn btn-primary">Update</button></td>
          </tr>
          <tr class="text-center small">
            <th><input type="checkbox"></th>
            <td>Ranjan</td>
            <td>Physician Assistant</td>
            <td>Physician Assistant</td>
            <td>5 years</td>
            <td>Communication Skills</td>
            <td>200000</td>
            <td>400000</td>
            <td>15 days</td>
            <td>BSc Nursing</td>
            <td>-</td>
            <td class="text-warning">Pending Review</td>
            <td><button id="addbtn" class="btn btn-primary">Update</button></td>

          </tr>
          <tr class="text-center small">
            <th><input type="checkbox"></th>
            <td>seth</td>
            <td>Physician Assistant</td>
            <td>Physician Assistant</td>
            <td>5 years</td>
            <td>Communication Skills</td>
            <td>200000</td>
            <td>400000</td>
            <td>15 days</td>
            <td>BSc Nursing</td>
            <td>-</td>
            <td class="text-danger">Rejected</td>
            <td><button id="addbtn" class="btn btn-primary">Update</button></td>

          </tr>
        </tbody>
      </table>
    </div>
    <div class="d-flex justify-content-end mt-3">
      <a href="{{url('formattedapplicantstoemployer')}}" class="btn btn-primary me-2">Send</a>
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
    
    // $(document).ready(function () {

    // $(document).on('click', '#addbtn', function () {
    //   $('#offcanvasBackdrop').offcanvas('show');
    //   $('.offcanvas-title').text('Feedback');
    //   $('#SubBtn').text('Add');
    // });

    // $('#cancelButton').on('click', function () {
    //   $('#addUserForm')[0].reset();
    //   $('#addUserForm').find('.is-invalid').removeClass('is-invalid');
    // });

    // $('#clearForm').on('click', function () {
    //   $('#addUserForm')[0].reset();
    //   $('#addUserForm').find('.is-invalid').removeClass('is-invalid');
    // });
    // });
    $(document).ready(function () {
    // Close offcanvas when close button is clicked
    $(document).on('click', '.btn-close', function () {
      $('#offcanvasBackdrop').offcanvas('hide');
      $('#addUserForm')[0].reset();
      $('#userId').val('');
    });

    // Handle form submission
    $('#addUserForm').on('submit', function (e) {
      e.preventDefault();
      // Hide offcanvas and show success modal
      $('#offcanvasBackdrop').offcanvas('hide');
      $('#successModal').modal('show');
      // Reset form after showing success modal
      $('#addUserForm')[0].reset();
    });

    // Show offcanvas when add button is clicked
    $(document).on('click', '#addbtn', function () {
      $('#offcanvasBackdrop').offcanvas('show');
      $('.offcanvas-title').text('Update feedback');
      $('#SubBtn').text('Add');
    });

    // Cancel button behavior
    $('#cancelButton').on('click', function () {
      $('#addUserForm')[0].reset();
      $('#addUserForm').find('.is-invalid').removeClass('is-invalid');
    });

    // Clear form behavior
    $('#clearForm').on('click', function () {
      $('#addUserForm')[0].reset();
      $('#addUserForm').find('.is-invalid').removeClass('is-invalid');
    });
    });
  </script>

@endpush

@endsection
