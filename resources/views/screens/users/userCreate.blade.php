@extends('layouts/contentNavbarLayout')

@section('title', $user ? 'Edit User' : 'Add User')

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
                            <input type="text" class="form-control" id="fullname"
                                placeholder="User Name" />
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
                                    <input type="text" id="email" class="form-control"
                                        placeholder="user.name" aria-label="john.doe"
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


<<<<<<< HEAD

@endsection
=======
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Fetch roles from the API
    $.ajax({
        url: "/roles",  // Make sure this URL is correct
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            console.log(data);  // Check the entire response

            var select = $('#roleSelect');
            select.empty();  // Clear existing options
            
            // Add default placeholder option
            select.append('<option hidden>Select Role</option>');

            // Loop through the data and append each role to the select element
            $.each(data.data, function(index, role) {
                console.log("Appending role: " + role.RoleName);  // Log role being appended
                select.append('<option value="' + role.id + '">' + role.RoleName + '</option>');
            });
        },
        error: function(xhr, status, error) {
            console.error('Error fetching roles: ' + error); // Log the error for debugging
            alert('Error fetching roles: ' + error);
        }
    });



    // Post Data

    // Handle form submission
    $('#addUserForm').on('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        // Collect form data
        var formData = {
            username: $('#fullname').val(),
            role_id: $('#roleSelect').val(),
            email: $('#email').val(),
            password: $('#password').val()
        };

        // Send AJAX POST request
        $.ajax({
            url: "/api/register", // Replace with your actual endpoint for adding users
            type: 'POST',
            dataType: 'json',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Add CSRF token if needed
            },
            success: function(response) {
                // Handle success response
                console.log('User added successfully:', response);
                alert('User added successfully!');
                // Optionally reset the form
                $('#addUserForm')[0].reset();
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error('Error adding user:', xhr.responseText);
                alert('Error adding user: ' + xhr.responseText);
            }
        });
    });
});



</script>
>>>>>>> 66a00f5c1038e557fde54acfa2769dbe272c72de
