@extends('layouts/contentNavbarLayout')

@section('title', 'Users List')

@section('content')
<div class="d-flex justify-content-between align-items-center py-3">
  <h3 class="mb-0">User Master List</h3>
  <button id="addbtn" class="btn btn-primary" type="button">Add</button>
</div>

<div>
  <!-- <h5 class="card-header">User Master List</h5> -->
  <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover shadow-sm text-sm" id="table">
      <thead class="table-dark text-center small">
        <tr class="text-center align-middle">
          <th>S No.</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Role</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>

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
        <form id="addUserForm" method="POST" action="{{ route('user.store') }}">
          @csrf
          <input type="hidden" id="userId">
          <div class="row">
            <div class="col-md-12">


              <div class="form-floating form-floating-outline mb-4">
                <input type="text" class="form-control" id="first_name" name="username" placeholder="First Name"
                  required />
                <label for="first_name">First Name</label>
                <div class="invalid-feedback">Please provide a First Name.</div>
              </div>

              <div class="form-floating form-floating-outline mb-4">
                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name"
                  required />
                <label for="last_name">Last Name</label>
                <div class="invalid-feedback">Please provide a Last Name.</div>
              </div>

              <div class="form-floating form-floating-outline mb-4">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required />
                <label for="email">Email</label>
                <div class="invalid-feedback">Please provide a valid email.</div>
              </div>

              <div class="form-floating form-floating-outline mb-4">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                  required />
                <label for="password">Password</label>
                <div class="invalid-feedback">Please provide a password.</div>
              </div>

              <div class="form-floating form-floating-outline mb-4">
                <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                  placeholder="Confirm Password" required />
                <label for="confirm_password">Confirm Password</label>
                <div class="invalid-feedback">Please confirm your password.</div>
              </div>

              <div class="form-floating form-floating-outline mb-4">
                <select id="role_id" name="role_id" class="form-select" required>
                  <option hidden value="">Select Role</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                </select>
                <label for="role_id">Role</label>
                <div class="invalid-feedback">Please select a role.</div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary w-100 mb-2">Add</button>
        </form>

        <button type="button" class="btn btn-outline-secondary d-grid w-100" id="cancelButton">Cancel</button>
      </div>
    </div>
  </div>
</div>
</div>



<!-- Success Modal -->
<div class="modal fade" id="successModal">
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

    function fetchUsers() {
      $.ajax({
      url: 'http://127.0.0.1:8000/getuser',
      type: 'GET',
      dataType: 'json',
      success: function (response) {
        let rows = '';
        if (response.status === 200) {
        $.each(response.data, function (index, user) {
          rows += `<tr class="text-center align-middle">
            <td>${index + 1}</td>
            <td>${user.Name}</td>
            <td>${user.last_name}</td>
            <td>${user.email}</td>
            <td>${user.RoleId}</td>
            <td>
            <button class="btn btn-primary btn-sm editBtn" data-id="${user.id}">Edit</button>
            <button class="btn btn-danger btn-sm deleteBtn" data-id="${user.id}">Delete</button>
            </td>
          </tr>`;
        });
        $('#tbody').html(rows);
        } else {
        console.error('Error fetching users:', response.message);
        }
      },
      error: function (err) {
        console.error('API error:', err);
      }
      });
    }

    fetchUsers();

    $(document).on('click', '.editBtn', function () {
      var userId = $(this).data('id');
      console.log('Edit user with ID:', userId);
    });

    $(document).on('click', '.deleteBtn', function () {
      var userId = $(this).data('id');
      console.log('Delete user with ID:', userId);
    });




    $('#addUserForm').on('submit', function (e) {
      e.preventDefault();

      $.ajax({
      url: "{{ route('user.store') }}",
      type: "POST",
      data: $(this).serialize(),
      success: function (response) {
        console.log(response);
        $('#successModal').modal('show');
        $('#addUserForm')[0].reset();
      },
      error: function (error) {
        console.log(error.responseJSON);
      }
      });
    });

    $('#cancelButton').on('click', function () {
      $('#addUserForm')[0].reset();
      $('#addUserForm').find('.is-invalid').removeClass('is-invalid');
    });

    $(document).on('click', '#addbtn', function () {
      $('#offcanvasBackdrop').offcanvas('show');
      $('.offcanvas-title').text('Add User');
    });

    $(document).on('click', '.btn-close', function () {
      $('#offcanvasBackdrop').offcanvas('hide');
      $('#addUserForm')[0].reset();
    });
    });

  </script>
@endpush

@endsection