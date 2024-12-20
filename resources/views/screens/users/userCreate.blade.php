@extends('layouts/contentNavbarLayout')

@php
  $user = request()->route('id') ? App\Models\UserModel::find(request()->route('id')) : null;
@endphp

@section('title', 'Add Users')

@section('content')

<div class="col-xxl">
  <div class="card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">{{ $user ? 'Edit User' : 'Add User' }}</h5>
    </div>
    <div class="card-body">
      <form id="addUserForm" novalidate>
        @csrf
        <div class="row">
          <div class="col-md-6">
            <div class="form-floating form-floating-outline mb-4">
              <input type="text" class="form-control" id="fullname" placeholder="User Name"
                value="{{ $user ? $user['Name'] : '' }}" required />
              <label for="basic-default-fullname">User Name</label>
              <div class="invalid-feedback">
                Please provide a username.
              </div>
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
          <div class="col-md-6">
            <div class="mb-4">
              <div class="input-group input-group-merge">
                <div class="form-floating form-floating-outline">
                  <input type="email" id="email" class="form-control" value="{{ $user ? $user['Email'] : '' }}"
                    placeholder="user.name" aria-label="john.doe" aria-describedby="basic-default-email2" required />
                  <label for="basic-default-email">Email</label>
                  <div class="invalid-feedback">
                    Please provide a valid email.
                  </div>
                </div>
              </div>
            </div>
            <div class="input-group input-group-merge">
              <div class="form-floating form-floating-outline mb-4">
                <input type="password" class="form-control" id="password" value="{{ $user ? $user['Password'] : '' }}"
                  placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                  aria-describedby="basic-default-password42" required />
                <label for="basic-default-phone">Password</label>
                <div class="invalid-feedback">
                  Please provide a password.
                </div>
              </div>
            </div>
          </div>
        </div>

        <button type="submit" class="btn btn-primary">{{ $user ? 'Update' : 'Add' }}</button>
      </form>
    </div>
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
      var select = $('#roleSelect');
      select.empty();
      select.append('<option hidden>Select Role</option>');
      $.each(data.data, function (index, role) {
        var isSelected = (role.id == '{{ $user ? $user['RoleId'] : '' }}') ? 'selected' : '';
        select.append('<option value="' + role.id + '" ' + isSelected + '>' + role.RoleName + '</option>');
      });
      },
      error: function (xhr, status, error) {
      console.error('Error fetching roles: ' + error);
      alert('Error fetching roles: ' + error);
      }
    });
    $('#addUserForm').on('submit', function (e) {
      e.preventDefault();
      if (this.checkValidity() === false) {
      e.stopPropagation();
      }

      $(this).addClass('was-validated');

      if (this.checkValidity() === true) {
      var formData = {
        username: $('#fullname').val(),
        role_id: $('#roleSelect').val(),
        email: $('#email').val(),
        password: $('#password').val()
      };

      var userId = '{{ $user ? $user["id"] : "" }}';

      var url = userId ? '/api/update/' + userId : '/api/register';
      var method = userId ? 'PUT' : 'POST';
      $.ajax({
        url: url,
        type: method,
        dataType: 'json',
        data: formData,
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
        var message = userId ? 'User updated successfully!' : 'User added successfully!';
        console.log(message, response);
        alert(message);
        window.location.href = '/user';
        },
        error: function (xhr, status, error) {
        console.error('Error:', xhr.responseText);
        alert('Error: ' + xhr.responseText);
        }
      });
      }
    });
    });
  </script>
@endpush
