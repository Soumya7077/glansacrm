@extends('layouts/contentNavbarLayout')
@section('title', 'AssigningUser - Assigning User')

@section('content')
<h4><span class="text-muted fw-light">Home /</span> Assigning User </h4>

<div class="card mb-4">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Assigning User</h5> <small class="text-muted float-end">Fill in the required information to
      assign a user</small>
  </div>
  <div class="card-body">
    <form id="assignUserForm" novalidate>
      <div class="row">
        <div class="col-md-6">
          <div class="form-floating form-floating-outline mb-4">
            <select class="form-control" id="recruiter" required>
              <option value="" hidden>Select Recruiter</option>
            </select>
            <label for="recruiter">Recruiter</label>
            <div class="invalid-feedback">
              Please select a recruiter.
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-floating form-floating-outline mb-4">
            <select class="form-control" id="Job-Title" required>
              <option value="" hidden>Select Job Title</option>
            </select>
            <label for="Job-Title">Job Title</label>
            <div class="invalid-feedback">
              Please select a job title.
            </div>
          </div>
        </div>
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>

@endsection

@push('scripts')
  <script>
    $(document).ready(function () {
    $.ajax({
      url: "/roles",
      type: 'GET',
      dataType: 'json',
      success: function (data) {
      var select = $('#recruiter');
      select.empty();
      select.append('<option hidden>Select Role</option>');

      $.each(data.data, function (index, role) {
        var isSelected = (role.id == '{{ $user ? $user->RoleId : '' }}') ? 'selected' : '';
        select.append('<option value="' + role.id + '" ' + isSelected + '>' + role.RoleName + '</option>');
      });
      },
      error: function (xhr, status, error) {
      console.error('Error fetching roles: ' + error);
      alert('Error fetching roles: ' + error);
      }
    });

    $('#assignUserForm').on('submit', function (e) {
      e.preventDefault();
      if (!this.checkValidity()) {
      e.stopPropagation();
      }

      $(this).addClass('was-validated');
    });
    });
  </script>
@endpush