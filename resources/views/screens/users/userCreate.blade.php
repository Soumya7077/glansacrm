@extends('layouts/contentNavbarLayout')

@php

  $user = request()->route('id');

@endphp

<!-- @section('title', $user ? 'Edit User' : 'Add User') -->

@section('title', 'Add Users')

@section('content')

<div class="col-xxl">
  <div class="card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">{{ $user ? 'Edit User' : 'Add User' }}</h5>
    </div>
    <div class="card-body">
      <form id="addUserForm">
        @csrf
        <div class="row">
          <div class="col-md-6">
            <div class="form-floating form-floating-outline mb-4">
              <input type="text" class="form-control" id="fullname" placeholder="User Name" />
              <label for="basic-default-fullname">User Name</label>
            </div>
            <div class="form-floating form-floating-outline mb-4">
              <select id="roleSelect" class="form-select">

              </select> <label for="basic-default-company">Role</label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-4">
              <div class="input-group input-group-merge">
                <div class="form-floating form-floating-outline">
                  <input type="text" id="email" class="form-control" placeholder="user.name" aria-label="john.doe"
                    aria-describedby="basic-default-email2" />
                  <label for="basic-default-email">Email</label>
                </div>
              </div>
            </div>
            <div class="input-group input-group-merge">
              <div class="form-floating form-floating-outline mb-4">
                <input type="password" class="form-control" id="password"
                  placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                  aria-describedby="basic-default-password42" />
                <label for="basic-default-phone">Password</label>
              </div>
            </div>
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Add</button>
      </form>
    </div>
  </div>
</div>


@endsection
@push('scripts')
  <script>
    $(document).ready(function () {
    // Fetch roles from the API
    $.ajax({
      url: "/roles",  // Make sure this URL is correct
      type: 'GET',
      dataType: 'json',
      success: function (data) {
      console.log(data);  // Check the entire response

      var select = $('#roleSelect');
      select.empty();  // Clear existing options

      // Add default placeholder option
      select.append('<option hidden>Select Role</option>');

      // Loop through the data and append each role to the select element
      $.each(data.data, function (index, role) {
        console.log("Appending role: " + role.RoleName);  // Log role being appended
        select.append('<option value="' + role.id + '">' + role.RoleName + '</option>');
      });
      },
      error: function (xhr, status, error) {
      console.error('Error fetching roles: ' + error); // Log the error for debugging
      alert('Error fetching roles: ' + error);
      }
    });



    // Handle form submission
    $('#addUserForm').on('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission

        // Collect form data
        var formData = {
            username: $('#fullname').val(),
            role_id: $('#roleSelect').val(),
            email: $('#email').val(),
            password: $('#password').val()  // Password is optional
        };

        var userId = '{{ $user ? $user["id"] : "" }}'; // Get user ID for update

        // Determine whether it's an update or add action
        var url = userId ? '/api/update/' + userId : '/api/register';
        var method = userId ? 'PUT' : 'POST';

        // Send AJAX request
        $.ajax({
            url: url,  // API URL for add/update
            type: method,  // POST for add, PUT for update
            dataType: 'json',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Add CSRF token if needed
            },
            success: function (response) {
                var message = userId ? 'User updated successfully!' : 'User added successfully!';
                console.log(message, response);
                alert(message);
                window.location.href =
                '/user'; // Redirect to users list after
                
            },
            error: function (xhr, status, error) {
                console.error('Error:', xhr.responseText);
                alert('Error: ' + xhr.responseText);
            }
        });
    });
    });



  </script>

@endpush
