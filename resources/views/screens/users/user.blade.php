@extends('layouts/contentNavbarLayout')

@section('title', 'Users List')

@section('content')


<div class="d-flex justify-content-between align-items-center py-3">
  <h3 class="mb-0">User Master List</h3>
  <button id="addbtn" class="btn btn-primary" type="button">Add </button>
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
      <tbody id="tbody">

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
        <form id="addUserForm" class="needs-validation" novalidate>
          @csrf
          <!-- <input type="hidden" id="userId"> -->
          <div class="row">
            <div class="col-md-12">


              <div class="form-floating form-floating-outline mb-4">
                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name"
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
                <div class="invalid-feedback" id="passwordMatchFeedback">Passwords do not match.</div>
              </div>

              <div class="form-floating form-floating-outline mb-4">
                <select id="role_id" name="role_id" class="form-select" required>
                  <option hidden value="">Select Role</option>
                  <option value="1">Admin</option>
                  <option value="2">Recruiter</option>
                </select>
                <label for="role_id">Role</label>
                <div class="invalid-feedback">Please select a role.</div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary w-100 mb-2">Add</button>
        </form>

        <button type="button" class="btn btn-outline-secondary d-grid w-100 cancelButton">Cancel</button>
      </div>
    </div>
  </div>
</div>


<!-- Edit Form Start -->
<div class="col-lg-4 col-md-6">
  <div class="mt-3">
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEditBackdrop"
      aria-labelledby="offcanvasEditBackdropLabel">
      <div class="offcanvas-header">
        <h5 id="offcanvasEditBackdropLabel" class="offcanvas-titleedit"></h5>
        <button type="button" class="btn-close text-reset"></button>
      </div>
      <hr>
      <div class="offcanvas-body mx-0 flex-grow-0">
        <form id="updateUserForm" class="needs-validation" novalidate>

          @csrf
          <input type="hidden" id="userId">
          <div class="row">
            <div class="col-md-12">
              <div class="form-floating form-floating-outline mb-4">
                <input type="text" class="form-control" id="firstname" name="first_name" placeholder="First Name"
                  required />
                <label for="first_name">First Name</label>
                <div class="invalid-feedback">Please provide a First Name.</div>
              </div>

              <div class="form-floating form-floating-outline mb-4">
                <input type="text" class="form-control" id="lastname" name="last_name" placeholder="Last Name"
                  required />
                <label for="last_name">Last Name</label>
                <div class="invalid-feedback">Please provide a Last Name.</div>
              </div>

              <div class="form-floating form-floating-outline mb-4">
                <input type="email" class="form-control" id="Email" name="email" placeholder="Email" required />
                <label for="email">Email</label>
                <div class="invalid-feedback">Please provide a valid email.</div>
              </div>

              <div class="form-floating form-floating-outline mb-4">
                <select id="roleid" name="role_id" class="form-select" required>
                  <option hidden value="">Select Role</option>
                  <option value="1">Admin</option>
                  <option value="2">Recruiter</option>
                </select>
                <label for="roleid">Role</label>
                <div class="invalid-feedback">Please select a role.</div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary w-100 mb-2">Update</button>
        </form>
        <button type="button" class="btn btn-outline-secondary d-grid w-100 cancelButton">Cancel</button>
      </div>
    </div>
  </div>
</div>
<!-- Edit Form End -->

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
<div class="modal fade" id="successModalupdate">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="successModalLabel">Success</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        The user has been successfully updated!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="successModaldelete">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="successModalLabel">Success</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        The user has been successfully deleted!
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
        <p id="errorMessage"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- Confirmation Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <x-alert id="alert" title="Delete User" message="Are you sure you want to delete this user?" showCancelButton="true"
    cancelButtonText="No, Keep User" showConfirmButton="true" confirmButtonText="Yes, Delete"
    confirmButtonId="deleteUserButton" confirmButtonClass="btn btn-danger" />
</div>




@push('scripts')
  <script>

    document.addEventListener("DOMContentLoaded", function () {
    const addUserForm = document.getElementById("addUserForm");
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirm_password");
    const passwordMatchFeedback = document.getElementById("passwordMatchFeedback");

    addUserForm.addEventListener("submit", function (event) {
      if (password.value !== confirmPassword.value) {
      event.preventDefault();
      passwordMatchFeedback.textContent = "Passwords do not match.";
      confirmPassword.setCustomValidity("Passwords do not match.");
      confirmPassword.classList.add("is-invalid");
      } else {
      confirmPassword.setCustomValidity("");
      confirmPassword.classList.remove("is-invalid");
      }
    });

    confirmPassword.addEventListener("input", function () {
      if (password.value === confirmPassword.value) {
      confirmPassword.setCustomValidity("");
      confirmPassword.classList.remove("is-invalid");
      } else {
      confirmPassword.setCustomValidity("Passwords do not match.");
      confirmPassword.classList.add("is-invalid");
      }
    });
    });



    $(document).ready(function () {
    function fetchUsers() {
      var table = $('#table').DataTable();
      $.ajax({
      url: '/api/getuser',
      type: 'GET',
      dataType: 'json',
      success: function (response) {
        console.log('Response:', response);
        let rows = '';
        if (response.status === 200) {
        var tableBody = $('#tbody');
        tableBody.empty();
        $.each(response.data, function (index, user) {
          rows += `<tr class="text-center align-middle">
      <td>${index + 1}</td>
      <td>${user.FirstName}</td>
      <td>${user.LastName}</td>
      <td>${user.Email}</td>
      <td>${user.RoleId == 1 ? "Admin" : "Recruiter"}</td>
      <td class="text-center">
      <div class="d-flex justify-content-center align-items-center gap-2">
      <button class="btn btn-primary btn-sm editBtn" data-id="${user.id}">Edit</button>
      <button class="btn btn-danger btn-sm deleteBtn" data-id="${user.id}">Delete</button>
      </div>
      </td>
      </tr>`;

        });
        tableBody.append(rows);
        table.clear();
        table.rows.add(tableBody.find('tr')).draw();
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

    let userIdToDelete;

    $(document).on('click', '.deleteBtn', function () {
      userIdToDelete = $(this).data('id');
      $('#confirmModal').modal('show');
    });

    $('#confirmDeleteButton').on('click', function () {
      $.ajax({
      url: `/api/delete/${userIdToDelete}`,
      type: 'DELETE',
      dataType: 'json',
      success: function (response) {
        $('#confirmModal').modal('hide');
        $('#successMessage').text('User deleted successfully.');
        $('#successModaldelete').modal('show');
        $('#successModal').on('hidden.bs.modal', function () {
        fetchUsers();
        });
      },
      error: function (error) {
        $('#confirmModal').modal('hide');
        $('#errorMessage').text('Error deleting user: ' + error.responseJSON.message);
        $('#errorModal').modal('show');
      }
      });
    });

    $(document).on('click', '.editBtn', function () {
      const userId = $(this).data('id');
      $.ajax({
      url: `/api/getuser/${userId}`,
      type: 'GET',
      dataType: 'json',
      success: function (response) {
        console.log(response)
        if (response.status == 200) {
        const user = response.data;
        $('#userId').val(user.id);
        $('#firstname').val(user.FirstName);
        $('#lastname').val(user.LastName);
        $('#Email').val(user.Email);
        $('#roleid').val(user.RoleId);
        $('#offcanvasEditBackdrop').offcanvas('show');
        $('.offcanvas-titleedit').text('Edit User');
        }
      },
      error: function (error) {
        console.error('Error fetching user data:', error);
      }
      });
    });
    $(document).ready(function () {

      $('#addUserForm').on('submit', function (e) {
      e.preventDefault();

      var form = $(this);
      form.addClass('was-validated');

      if (form[0].checkValidity() === false) {
        e.stopPropagation();
      } else {
        $.ajax({
        url: `/api/users`,
        type: 'POST',
        data: form.serialize(),
        success: function (response) {
          $('#offcanvasBackdrop').offcanvas('hide');
          $('#successModal').modal('show');
          $('#addUserForm')[0].reset();
          fetchUsers();
        },
        error: function (error) {
          console.error('Error:', error.responseJSON);
        }
        });
      }
      });

    });


    $(document).ready(function () {

      $('#updateUserForm').on('submit', function (e) {
      e.preventDefault();

      var form = $(this);
      form.addClass('was-validated');

      if (form[0].checkValidity() === false) {
        e.stopPropagation();
      } else {
        const userId = $('#userId').val();

        $.ajax({
        url: `/api/update/${userId}`,
        type: 'PUT',
        data: form.serialize(),
        success: function (response) {
          $('#offcanvasBackdrop').offcanvas('hide');
          $('#successModalupdate').modal('show');
          $('#updateUserForm')[0].reset();
          fetchUsers();
        },
        error: function (error) {
          console.error('Error:', error.responseJSON);
        }
        });
      }
      });

    });


    $('.cancelButton, .btn-close').on('click', function () {
      $('#offcanvasBackdrop').offcanvas('hide');
      $('#addUserForm')[0].reset();
      $('#userId').val('');
      $('.offcanvas-title').text('Add User');
    });

    $('.cancelButton, .btn-close').on('click', function () {
      $('#addUserForm')[0].reset();
      $('#addUserForm').find('.is-invalid').removeClass('is-invalid');
      // $('#updateUserForm')[0].reset();
      // $('#updateUserForm').find('.is-invalid').removeClass('is-invalid');
    });

    $(document).on('click', '#addbtn', function () {
      $('#offcanvasBackdrop').offcanvas('show');
      $('.offcanvas-title').text('Add User');
    });

    // $(document).on('click', '.btn-close', function () {
    $('.cancelButton, .btn-close').on('click', function () {

      $('#offcanvasBackdrop').offcanvas('hide');
      $('#offcanvasEditBackdrop').offcanvas('hide');
      $('#addUserForm')[0].reset();
      $('#updateUserForm')[0].reset();
    });
    });

  </script>
@endpush
@endsection