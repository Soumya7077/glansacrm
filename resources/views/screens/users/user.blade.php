@extends('layouts/contentNavbarLayout')


@section('title', 'Users List')

@section('content')
    <div class="d-flex justify-content-between align-items-center py-3">
        <h3 class="mb-0">Users</h3>
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
                <tbody id="tbody">

                </tbody>
            </table>
        </div>
    </div>


@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Users Data Getting
    $(document).ready(function() {
        // Fetch user data using Ajax
        $.ajax({
            url: "/api/getuser",
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log(data, "here");
                if (data.status === 200) {
                    var tableBody = $('#tbody');
                    tableBody.empty(); // Clear the existing table data
                    console.log("hiiii")
                    // Loop through the user data and add it to the table
                    $.each(data.data, function(index, user) {
                        var row = '<tr>';
                        row += '<td>' + (index + 1) + '</td>';
                        row += '<td>' + user.Name + '</td>';
                        row += '<td>' + user.Email + '</td>';
                        row += '<td>' + user.RoleId + '</td>';
                        row += '<td>';
                        row += `<a href="/userForm/${user.id}" class="btn btn-info btn-sm">Edit</a>`;
                        row += ' <button class="btn btn-danger btn-sm">Delete</button>';
                        row += '</td>';
                        row += '</tr>';
                        tableBody.append(row); // Append row to table body
                    });
                } else {
                    alert('No users found');
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr, status, error); // Log error details
                alert('Error fetching data: ' + error);
            }
        });
    });
</script>
