@extends('layouts/contentNavbarLayout')

@section('title', 'Users List')

@section('content')
<div class="d-flex justify-content-between align-items-center py-3">
  <h3 class="mb-0">User</h3>
  <a class="btn btn-primary" href="/userForm">+Add User</a>
</div>

<!-- Basic Bootstrap Table -->
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
      <tbody>
        {{-- <tr class="text-center small">
          <td>1</td>
          <td>Albert Cook</td>
          <td>albert@gmail.com</td>
          <td>Recruiter</td>
          <td>
            <a href="#" class="btn btn-warning btn-sm">Edit</a>
            <a href="#" class="btn btn-danger btn-sm">Delete</a>
          </td>
        </tr>
        <tr class="text-center small">
          <td>2</td>
          <td>Barry Hunter</td>
          <td>barry@gmail.com</td>
          <td>Telecaller</td>
          <td>
            <a href="#" class="btn btn-warning btn-sm">Edit</a>
            <a href="#" class="btn btn-danger btn-sm">Delete</a>
          </td>
        </tr>
        <tr class="text-center small">
          <td>3</td>
          <td>Trevor Baker</td>
          <td>trevor@gmail.com</td>
          <td>Recruiter</td>
          <td>
            <a href="#" class="btn btn-warning btn-sm">Edit</a>
            <a href="#" class="btn btn-danger btn-sm">Delete</a>
          </td>
        </tr>
        <tr class="text-center small">
          <td>4</td>
          <td>Jerry Milton</td>
          <td>jerry@gmail.com</td>
          <td>Telecaller</td>
          <td>
            <a href="#" class="btn btn-warning btn-sm">Edit</a>
            <a href="#" class="btn btn-danger btn-sm">Delete</a>
          </td>
        </tr> --}}
      </tbody>
    </table>
  </div>
</div>


@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    // Fetch data from the server
    function fetchUsers() {
      $.ajax({
        url: 'http://127.0.0.1:8000/getuser',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
          if (response.status == 200) {
            console.log(response);
            const users = response.data;
            let userRows = '';
            users.forEach((user, index) => {
              userRows += `
                <tr class="text-center small">
                  <td>${index + 1}</td>
                  <td>${user.Name}</td>
                  <td>${user.Email}</td>
                  <td>${user.RoleId}</td>
                  <td>
                    <a href="#" class="btn btn-warning btn-sm">Edit</a>
                    <a href="#" class="btn btn-danger btn-sm">Delete</a>
                  </td>
                </tr>
              `;
            });
            $('#userTable tbody').html(userRows);
          } else {
            $('#userTable tbody').html('<tr><td colspan="5" class="text-center">No users found</td></tr>');
          }
        },
        error: function() {
          $('#userTable tbody').html('<tr><td colspan="5" class="text-center">Error fetching users</td></tr>');
        }
      });
    }

    // Call fetchUsers on page load
    fetchUsers();
  });
</script>

@endsection
