@extends('layouts/contentNavbarLayout')

@section('title', 'Users List')

@section('content')
<div class="d-flex justify-content-between align-items-center py-3">
  <h3 class="mb-0">Users</h3>
  <button id="addbtn" class="btn btn-primary" type="button">Add</button>
</div>

<div>
  <h5 class="card-header">User Master List</h5>
  <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover shadow-sm text-sm" id="table">
      <thead class="table-dark text-center small">
        <tr>
          <th>S No.</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Role</th>
          <th>Actions</th>
        </tr>
      </thead>
      <!-- <tbody id="tbody"></tbody> -->

      <tbody id="">
        <tr>
          <td>01</td>
          <td>Naveen</td>
          <td>Nagam</td>
          <td>naveen@gmail.com</td>
          <td>2</td>
          <td class="text-center">
            <a id="addbtn" class="btn btn-primary btn-sm text-white">Edit</a>
            <a class="btn btn-danger btn-sm text-white">Delete</a>
          </td>
        </tr>
        <tr>
          <td>02</td>
          <td>Anita</td>
          <td>Seth</td>
          <td>anita@gmail.com</td>
          <td>1</td>
          <td class="text-center">
            <a id="addbtn" class="btn btn-primary btn-sm text-white">Edit</a>
            <a href="" class="btn btn-danger btn-sm deleteButton">Delete</a>
            <!-- <button id="addbtn" class="btn btn-primary" type="button">Edit</button> -->
          </td>
        </tr>
      </tbody>

    </table>
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
                <input type="text" class="form-control" id="fullname" placeholder="First Name" required />
                <label for="basic-default-fullname">First Name</label>
                <div class="invalid-feedback">Please provide a FirstName.</div>
              </div>

              <div class="form-floating form-floating-outline mb-4">
                <input type="text" class="form-control" id="fullname" placeholder="Last Name" required />
                <label for="basic-default-fullname">Last Name</label>
                <div class="invalid-feedback">Please provide a LastName.</div>
              </div>

              <div class="form-floating form-floating-outline mb-4">
                <select id="roleSelect" class="form-select" required>
                  <option hidden value="">Select Role</option>
                </select>
                <label for="basic-default-company">Role</label>
                <div class="invalid-feedback">
                  Please select a role.
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div class="mb-4">
                <div class="input-group input-group-merge">
                  <div class="form-floating form-floating-outline">
                    <input type="email" id="email" class="form-control" placeholder="user.name" aria-label="john.doe"
                      aria-describedby="basic-default-email2" required />
                    <label for="basic-default-email">Email</label>
                    <div class="invalid-feedback">Please provide a valid email.</div>
                  </div>
                </div>
              </div>

              <div class="input-group input-group-merge">
                <div class="form-floating form-floating-outline mb-4">
                  <input type="password" class="form-control" id="password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="basic-default-password42" required />
                  <label for="basic-default-phone">Password</label>
                  <div class="invalid-feedback">Please provide a password.</div>
                </div>
              </div>
            </div>
            <div class="input-group input-group-merge">
              <div class="form-floating form-floating-outline mb-4">
                <input type="password" class="form-control" id="password"
                  placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                  aria-describedby="basic-default-password42" required />
                <label for="basic-default-phone">Confirm Password</label>
                <div class="invalid-feedback">Please provide a Confirm password.</div>
              </div>
            </div>
          </div>

          <!-- <button type="submit" class="btn btn-primary w-100 mb-2" id="SubBtn">Add</button> -->
          <button type="submit" class="btn btn-primary w-100 mb-2">Add</button>

        </form>
        <button type="button" class="btn btn-outline-secondary d-grid w-100" id="cancelButton">Cancel</button>
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
        The user has been successfully added!
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
      $('.offcanvas-title').text('Add User');
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