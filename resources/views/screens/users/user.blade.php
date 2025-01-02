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
          <th>Name</th>
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
          <td>anita@gmail.com</td>
          <td>1</td>
          <td class="text-center">
            <a id="addbtn" class="btn btn-primary btn-sm text-white">Edit</a>
            <a href="" class="btn btn-danger btn-sm">Delete</a>
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
                <input type="text" class="form-control" id="fullname" placeholder="User Name" required />
                <label for="basic-default-fullname">User Name</label>
                <div class="invalid-feedback">Please provide a username.</div>
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
          </div>

          <button type="submit" class="btn btn-primary w-100 mb-2" id="SubBtn"></button>
        </form>
        <button type="button" class="btn btn-outline-secondary d-grid w-100" id="cancelButton">Cancel</button>
      </div>
    </div>
  </div>
</div>

@push('scripts')
  <script>
    $(document).ready(function () {
    var table = $('#table').DataTable();
    let userList = [];

    // function fetchUsers() {
    //   $.ajax({
    //   url: "/api/getuser",
    //   type: 'GET',
    //   dataType: 'json',
    //   success: function (data) {
    //     if (data.status === 200) {
    //     var tableBody = $('#tbody');
    //     tableBody.empty();

    //     $.each(data.data, function (index, user) {
    //       userList.push(user);
    //       var row = '<tr>';
    //       row += '<td>' + (index + 1) + '</td>';
    //       row += '<td>' + user.Name + '</td>';
    //       row += '<td>' + user.Email + '</td>';
    //       row += '<td>' + user.RoleId + '</td>';
    //       row += '<td>';
    //       row += `<button type="button" class="btn btn-info btn-sm editButton" data-id="${user.id}">Edit</button>`;
    //       row += ` <button type="button" class="btn btn-danger btn-sm deleteButton" data-id="${user.id}">Delete</button>`;
    //       row += '</td>';
    //       row += '</tr>';
    //       tableBody.append(row);
    //     });
    //     table.clear();
    //     table.rows.add(tableBody.find('tr')).draw();
    //     } else {
    //     alert('No users found');
    //     }
    //   },
    //   error: function (xhr, status, error) {
    //     alert('Error fetching data: ' + error);
    //   }
    //   });
    // }

    $(document).on('click', '.btn-close', function () {
      $('#offcanvasBackdrop').offcanvas('hide');
      $('#addUserForm')[0].reset();
      $('#userId').val('');
    })

    $(document).on('click', '#addbtn', function () {

      $('#offcanvasBackdrop').offcanvas('show');
      $('.offcanvas-title').text('Add User');
      $('#SubBtn').text('Add');
    })

    // $(document).on('click', '#SubBtn', function () {
    //   // $('.offcanvas-title').text('Add User');

    //   // $('#SubBtn').text('Update');
    // })

    fetchUsers();

    // $(document).on('click', '.editButton', function () {
    //   $('#offcanvasBackdrop').offcanvas('show');
    //   $('.offcanvas-title').text('Update User');
    //   $('#SubBtn').text('Update');
    //   var userId = $(this).data('id');
    //   $.ajax({
    //   url: `/api/getuser/${userId}`,
    //   type: 'GET',
    //   dataType: 'json',
    //   success: function (data) {
    //     if (data.status === 200) {
    //     var user = data.data;
    //     $('#userId').val(user.id);
    //     $('#fullname').val(user.Name);
    //     $('#email').val(user.Email);
    //     $('#roleSelect').val(user.RoleId);
    //     $('#password').val(user.Password);
    //     // $('#offcanvasBackdrop').offcanvas('show');
    //     } else {
    //     alert('User not found');
    //     }
    //   },
    //   error: function (xhr, status, error) {
    //     alert('Error fetching user: ' + error);
    //   }
    //   });
    // });

    // $('#addUserForm').on('submit', function (e) {
    //   e.preventDefault();

    //   $('.invalid-feedback').remove();
    //   $('.form-control').removeClass('is-invalid');

    //   var formData = {
    //   username: $('#fullname').val(),
    //   role_id: $('#roleSelect').val(),
    //   email: $('#email').val(),
    //   password: $('#password').val()
    //   };

    //   var userId = $('#userId').val();
    //   var url = userId ? '/api/update/' + userId : '/api/register';
    //   var method = userId ? 'PUT' : 'POST';

    //   var isValid = true;

    //   if (!formData.username) {
    //   $('#fullname').addClass('is-invalid');
    //   $('#fullname').after('<div class="invalid-feedback">Please provide a username.</div>');
    //   isValid = false;
    //   }

    //   if (!formData.role_id) {
    //   $('#roleSelect').addClass('is-invalid');
    //   $('#roleSelect').after('<div class="invalid-feedback">Please select a role.</div>');
    //   isValid = false;
    //   }

    //   var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    //   if (!formData.email || !emailPattern.test(formData.email)) {
    //   $('#email').addClass('is-invalid');
    //   $('#email').after('<div class="invalid-feedback">Please provide a valid email.</div>');
    //   isValid = false;
    //   }

    //   if (!formData.password) {
    //   $('#password').addClass('is-invalid');
    //   $('#password').after('<div class="invalid-feedback">Please provide a password.</div>');
    //   isValid = false;
    //   }

    //   if (isValid) {
    //   if (!formData.password) {
    //     delete formData.password;
    //   }

    //   $.ajax({
    //     url: url,
    //     type: method,
    //     dataType: 'json',
    //     data: formData,
    //     headers: {
    //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     },
    //     success: function (response) {
    //     alert(response.message);
    //     $('#offcanvasBackdrop').offcanvas('hide');
    //     $('#addUserForm')[0].reset();
    //     fetchUsers();
    //     },
    //     error: function (xhr, status, error) {
    //     alert('Error: ' + xhr.responseText);
    //     }
    //   });
    //   }
    // });

    $(document).on('click', '.deleteButton', function () {
      // var userId = $(this).data('id');
      // console.log(userList);
      // userList = userList.filter((data) => data.id !== userId);
      // console.log(userList);
      // 
      if (confirm('Are you sure you want to delete this user?')) {
      // $.ajax({
      //   url: `/api/delete/${userId}`,
      //   type: 'DELETE',
      //   headers: {
      //   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      //   },
      //   success: function (response) {
      //   alert('User deleted successfully!');
      //   fetchUsers();
      //   },
      //   error: function (xhr, status, error) {
      //   alert('Error deleting user: ' + xhr.responseText);
      //   }
      // });
      }
    });

    // $.ajax({
    //   url: "/roles",
    //   type: 'GET',
    //   dataType: 'json',
    //   success: function (data) {
    //   if (data.status === 200) {
    //     var roleSelect = $('#roleSelect');
    //     roleSelect.empty();
    //     roleSelect.append('<option hidden value="">Select Role</option>');
    //     $.each(data.data, function (index, role) {
    //     roleSelect.append('<option value="' + role.id + '">' + role.RoleName + '</option>');
    //     });
    //   } else {
    //     alert('No roles found');
    //   }
    //   },
    //   error: function (xhr, status, error) {
    //   alert('Error fetching roles: ' + error);
    //   }
    // });

    $('#cancelButton').on('click', function () {
      $('#addUserForm')[0].reset();
      $('#addUserForm').find('.is-invalid').removeClass('is-invalid');
    });
    $('#clearForm').on('click', function () {
      $('#addUserForm')[0].reset();
      $('#addUserForm').find('.is-invalid').removeClass('is-invalid');
    });
    });
  </script>
@endpush
@endsection