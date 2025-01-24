@extends('layouts/contentNavbarLayout')
@section('title', 'Employer - Employer List')

@section('content')
<!-- <h4><span class="text-muted fw-light">Home /</span> Employer List</h4> -->
<div class="container-fluid mt-3 px-0">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Employer List</h2>
        <button class="btn btn-primary" id="clearForm" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasBackdrop" aria-controls="offcanvasBackdrop">+ Add Employer</button>
    </div>
    <h4 id="loading-spinner" class="text-primary" style="display:none;">Loading...</h4>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover shadow-sm text-sm" id="table">
            <thead class="table-dark text-center small">
                <tr class="text-center align-middle">
                    <th>Sr No</th>
                    <th>Organisation Name</th>
                    <th>Date</th>
                    <th>First Contact Person Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Location</th>
                    <th>Designation</th>
                    <th>Second Contact Person Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Location</th>
                    <th>Designation</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tbody">

            </tbody>
        </table>
    </div>
</div>

<div class="col-lg-4 col-md-6">
    <div class="mt-3">
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasBackdrop"
            aria-labelledby="offcanvasBackdropLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasBackdropLabel" class="offcanvas-title">Add Employer</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <hr>
            <h4 id="edit-loading" class="text-primary" style="display: none; padding:0px 25px;">Loading...</h4>
            <div class="offcanvas-body mx-0 flex-grow-0">
                <form id="addUserForm">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="card-header p-0 mb-3">
                                <h6 class="text-primary mb-0">Organization Details</h6>
                            </div>
                            <input type="hidden" id="empId">
                            <div class="form-floating mb-5">
                                <input type="text" class="form-control" id="organization-name"
                                    placeholder="Organization Name" required />
                                <label for="organization-name">Organization Name</label>
                                <div class="invalid-feedback">Please provide the organization name.</div>
                            </div>

                            <div class="card-header  p-0 mb-3 ">
                                <h6 class="text-primary mb-0">Contact Person 1 Details</h6>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" id="contact-person-1-name"
                                    placeholder="Contact Person Name" required />
                                <label for="contact-person-1-name">Contact Person Name</label>
                                <div class="invalid-feedback">Please provide contact person 1's name.</div>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="tel" class="form-control" id="contact-person-1-phone"
                                    placeholder="Phone Number" required pattern="^\d{10}$" maxlength="10" />
                                <label for="contact-person-1-phone">Phone Number</label>
                                <div class="invalid-feedback">Please provide a valid 10-digit phone number.</div>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="email" class="form-control" id="contact-person-1-email" placeholder="Email"
                                    required />
                                <label for="contact-person-1-email">Email</label>
                                <div class="invalid-feedback">Please provide a valid email address.</div>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" id="contact-person-1-location"
                                    placeholder="Location" required />
                                <label for="contact-person-1-location">Location</label>
                                <div class="invalid-feedback">Please provide a location.</div>
                            </div>
                            <div class="form-floating mb-5">
                                <input type="text" class="form-control" id="contact-person-1-designation"
                                    placeholder="Designation" required />
                                <label for="contact-person-1-location">Designation</label>
                                <div class="invalid-feedback">Please provide a Designation.</div>
                            </div>

                            <div class="card-header  p-0 mb-3">
                                <h6 class="text-primary mb-0">Contact Person 2 Details</h6>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" id="contact-person-2-name"
                                    placeholder="Contact Person Name" />
                                <label for="contact-person-2-name">Contact Person Name</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="tel" class="form-control" id="contact-person-2-phone"
                                    placeholder="Phone Number" pattern="^\d{10}$" maxlength="10" />
                                <label for="contact-person-2-phone">Phone Number</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="email" class="form-control" id="contact-person-2-email"
                                    placeholder="Email" />
                                <label for="contact-person-2-email">Email</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" id="contact-person-2-location"
                                    placeholder="Location" />
                                <label for="contact-person-2-location">Location</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" id="contact-person-2-designation"
                                    placeholder="Designation" />
                                <label for="contact-person-2-location">Designation</label>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
                <h4 id="edit-loading" class="text-primary" style="display: none;">Loading...</h4>
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
                The Employer has been successfully added!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="successModalupdate" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Success</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                The Employer has been updated successfully
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="deletemodalsuccess" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Success</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Employer deleteed successfully.
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
                Error deleting employer.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="errorModaldelete" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorModalLabel">Error</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Failed to delete employer.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this employer?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        var table = $('#table').DataTable();
        $.ajax({
            url: '/api/getEmployer',
            method: 'GET',
            success: function (response) {
                console.log("hdvh zhjgzv dhzjnbcvf", response.data)
                if (response) {
                    let employers = response.data;
                    let tableBody = $('#tbody');
                    tableBody.empty();
                    if (employers.length === 0) {
                        tableBody.append('<tr><td colspan="14" class="text-center">No employers found</td></tr>');
                    }
                    employers.forEach((employer, index) => {
                        let row = `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${employer.OrganizationName}</td>
                            <td>${new Date(employer.created_at).toLocaleDateString()}</td>
                            <td>${employer.FirstContactPersonName}</td>
                            <td>${employer.FirstContactPhoneNumber}</td>
                            <td>${employer.FirstContactEmail}</td>
                            <td>${employer.FirstContactLocation}</td>
                            <td>${employer.FirstContactDesignation}</td>
                            <td>${employer.SecondContactPersonName || 'N/A'}</td>
                            <td>${employer.SecondContactPhoneNumber || 'N/A'}</td>
                            <td>${employer.SecondContactEmail || 'N/A'}</td>
                            <td>${employer.SecondContactLocation || 'N/A'}</td>
                            <td>${employer.SecondContactDesignation || 'N/A'}</td>
                           <td class="text-center">
                                <div class="d-flex justify-content-center align-items-center gap-2">
                                    <button class="btn btn-primary btn-sm edit-btn" data-id="${employer.id}">Edit</button>
                                    <button class="btn btn-danger btn-sm delete-btn" data-id="${employer.id}">Delete</button>
                                </div>
                            </td>

                        </tr>
                    `;
                        tableBody.append(row);
                        table.clear();
                        table.rows.add(tableBody.find('tr')).draw();
                    });
                } else {
                    alert('Failed to fetch employer data.');
                }
            },
            error: function () {
                alert('Error fetching employer data.');
            }
        });


        $('#clearForm').on('click', function () {
            $('#addUserForm')[0].reset();
            $('#addUserForm').find('.is-invalid').removeClass('is-invalid');
        });

        $('#offcanvasBackdrop').on('hidden.bs.offcanvas', function () {
            $('#addUserForm')[0].reset();
            $('#addUserForm').find('.is-invalid').removeClass('is-invalid');
        });

    });



    $(document).ready(function () {

        $('#addUserForm').on('submit', function (e) {
            e.preventDefault();

            const formData = {
                OrganizationName: $('#organization-name').val(),
                FirstContactPersonName: $('#contact-person-1-name').val(),
                FirstContactPhoneNumber: $('#contact-person-1-phone').val(),
                FirstContactEmail: $('#contact-person-1-email').val(),
                FirstContactLocation: $('#contact-person-1-location').val(),
                FirstContactDesignation: $('#contact-person-1-designation').val(),
                SecondContactPersonName: $('#contact-person-2-name').val(),
                SecondContactPhoneNumber: $('#contact-person-2-phone').val(),
                SecondContactEmail: $('#contact-person-2-email').val(),
                SecondContactLocation: $('#contact-person-2-location').val(),
                SecondContactDesignation: $('#contact-person-2-designation').val(),
            };


            const employerId = $('#empId').val();

            const method = employerId ? 'PUT' : 'POST';
            const url = employerId ? `/api/updateEmployer/${employerId}` : '/api/createEmployer';

            $.ajax({
                url: url,
                method: method,
                data: formData,
                success: function (response) {
                    console.log("Response:", response);
                    if (response) {
                        $('#offcanvasBackdrop').offcanvas('hide');
                        var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                        successModal.show();
                        $('#addUserForm')[0].reset();
                    }
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        for (const key in errors) {
                            const input = $(`#${key.replace('_', '-')}`);
                            input.addClass('is-invalid');
                            input.next('.invalid-feedback').text(errors[key][0]);
                        }
                    } else {
                        alert('An error occurred. Please try again.');
                    }
                },
            });
        });
    });



    $(document).on('click', '.edit-btn', function () {
        const employerId = $(this).data('id');
        $('#edit-loading').show();
        $('#empId').val(employerId);
        $.ajax({
            url: `/api/getEmployer/${employerId}`,
            method: 'GET',
            success: function (response) {
                if (response) {
                    const employer = response.data;

                    $('#organization-name').val(employer.OrganizationName);
                    $('#contact-person-1-name').val(employer.FirstContactPersonName);
                    $('#contact-person-1-phone').val(employer.FirstContactPhoneNumber);
                    $('#contact-person-1-email').val(employer.FirstContactEmail);
                    $('#contact-person-1-location').val(employer.FirstContactLocation);
                    $('#contact-person-1-designation').val(employer.FirstContactDesignation);
                    $('#contact-person-2-name').val(employer.SecondContactPersonName || '');
                    $('#contact-person-2-phone').val(employer.SecondContactPhoneNumber || '');
                    $('#contact-person-2-email').val(employer.SecondContactEmail || '');
                    $('#contact-person-2-location').val(employer.SecondContactLocation || '');
                    $('#contact-person-2-designation').val(employer.SecondContactDesignation || '');

                    $('#offcanvasBackdrop').offcanvas('show');
                } else {
                    alert('Failed to fetch employer details.');
                }
            },
            error: function () {
                alert('Error fetching employer data.');
            },
            complete: function () {
                $('#edit-loading').hide();
            }
        });
    });

    $(document).on('click', '.delete-btn', function () {
        const employerId = $(this).data('id');
        const row = $(this).closest('tr');
        $('#confirmModal').modal('show');

        $('#confirmDeleteButton').off('click').on('click', function () {
            $.ajax({
                url: `/api/deleteEmployer/${employerId}`,
                method: 'DELETE',
                success: function (response) {
                    if (response) {
                        row.remove();
                        $('#deletemodalsuccess').modal('show');
                    } else {
                        $('#errorModal').modal('show');
                    }
                },
                error: function () {
                    $('#errorModaldelete').modal('show');
                }
            });
            $('#confirmModal').modal('hide');

        });
    });





    $(document).ready(function () {
        $(document).on('click', '.btn-close', function () {
            $('#offcanvasBackdrop').offcanvas('hide');
            $('#addUserForm')[0].reset();
            $('#userId').val('');
        });

        $(document).on('click', '#addbtn', function () {
            $('#offcanvasBackdrop').offcanvas('show');
            $('.offcanvas-title').text('Add Employer');
            $('#SubBtn').text('Add');
        });

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

@endsection