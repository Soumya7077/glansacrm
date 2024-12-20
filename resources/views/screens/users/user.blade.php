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

    @push('scripts')
        <script>
            $(document).ready(function() {
                // Initialize DataTable
                var table = $('#table').DataTable();

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

                            // Loop through the user data and add it to the table
                            $.each(data.data, function(index, user) {
                                var row = '<tr>';
                                row += '<td>' + (index + 1) + '</td>';
                                row += '<td>' + user.Name + '</td>';
                                row += '<td>' + user.Email + '</td>';
                                row += '<td>' + user.RoleId + '</td>';
                                row += '<td>';
                                row +=
                                    `<a href="/userForm/${user.id}" class="btn btn-info btn-sm">Edit</a>`;
                                row +=
                                    ` <button type="button" class="btn btn-danger btn-sm deleteButton" data-id="${user.id}">Delete</button>`;
                                row += '</td>';
                                row += '</tr>';
                                tableBody.append(row); // Append row to table body
                            });

                            table.clear();
                            table.rows.add(tableBody.find('tr')).draw();
                            
                        } else {
                            alert('No users found');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr, status, error);
                        alert('Error fetching data: ' + error);
                    }
                });

                // Delete Ajax call
                // Delete Ajax call
                $(document).on('click', '.deleteButton', function() {
                    var userId = $(this).data('id'); // Get user ID from the button's data attribute

                    if (!userId) {
                        alert('No user selected for deletion');
                        return;
                    }

                    if (confirm('Are you sure you want to delete this user?')) {
                        $.ajax({
                            url: '/api/delete/' + userId, // API URL for delete
                            type: 'DELETE',
                            dataType: 'json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                alert('User deleted successfully!');
                                window.location.href =
                                '/user'; // Redirect to users list after delete
                            },
                            error: function(xhr, status, error) {
                                alert('Error deleting user: ' + xhr.responseText);
                            }
                        });
                    }
                });
            });
        </script>
    @endpush
@endsection
