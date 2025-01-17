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
                    <th>Job Count</th>
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
                    <th>Remarks</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="empList">
                <tr class="text-center align-middle">
                    <td>1</td>
                    <td>Apollo</td>
                    <td>43</td>
                    <td>01/06/2025</td>
                    <td>Soumya Ranjan</td>
                    <td>1234567890</td>
                    <td>abc@apollo.com</td>
                    <td>Delhi</td>
                    <td>Operation Head</td>
                    <td>Anita</td>
                    <td>1234567890</td>
                    <td>anita@apollo.com</td>
                    <td>Delhi</td>
                    <td>Operation Head</td>
                    <td>Data alignment</td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-sm btn-primary edit-btn" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasBackdrop" aria-controls="offcanvasBackdrop">Edit</button>
                            <button class="btn btn-sm btn-danger delete-btn ms-2" type="button"
                                data-bs-toggle="offcanvas" data-bs-target="#offcanvasBackdrop"
                                aria-controls="offcanvasBackdrop">Delete</button>
                        </div>
                    </td>
                </tr>
                <tr class="text-center align-middle">
                    <td>2</td>
                    <td>Apollo</td>
                    <td>25</td>
                    <td>01/06/2025</td>
                    <td>Naveen Nagam</td>
                    <td>1234567890</td>
                    <td>abc@apollo.com</td>
                    <td>Hyderabad</td>
                    <td>Operation Head</td>
                    <td>Anita</td>
                    <td>1234567890</td>
                    <td>anita@apollo.com</td>
                    <td>Hyderabad</td>
                    <td>Operation Head</td>
                    <td>Data alignment</td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-sm btn-primary edit-btn" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasBackdrop" aria-controls="offcanvasBackdrop">Edit</button>
                            <button class="btn btn-sm btn-danger delete-btn ms-2" type="button"
                                data-bs-toggle="offcanvas" data-bs-target="#offcanvasBackdrop"
                                aria-controls="offcanvasBackdrop">Delete</button>
                        </div>
                    </td>
                </tr>
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
                <form class="needs-validation" id="addUserForm" novalidate>
                    {{-- Organization Details --}}
                    <div class="card mb-4">
                        <div class="card-header">
                            <h6 class="text-primary mb-0">Organization Details</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" id="organization-name"
                                    placeholder="Organization Name" required />
                                <label for="organization-name">Organization Name</label>
                                <div class="invalid-feedback">Please provide the organization name.</div>
                            </div>
                        </div>
                    </div>

                    {{-- Contact Person 1 Section --}}
                    <div class="card mb-4">
                        <div class="card-header">
                            <h6 class="text-primary mb-0">Contact Person 1 Details</h6>
                        </div>
                        <div class="card-body">
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
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" id="contact-person-1-Designation"
                                    placeholder="Designation" required />
                                <label for="contact-person-1-location">Designation</label>
                                <div class="invalid-feedback">Please provide a Designation.</div>
                            </div>
                        </div>
                    </div>

                    {{-- Contact Person 2 Section --}}
                    <div class="card mb-4">
                        <div class="card-header">
                            <h6 class="text-primary mb-0">Contact Person 2 Details</h6>
                        </div>
                        <div class="card-body">
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
                                <input type="text" class="form-control" id="contact-person-1-Designation"
                                    placeholder="Designation" required />
                                <label for="contact-person-1-location">Designation</label>
                                <div class="invalid-feedback">Please provide a Designation.</div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $(document).on('click', '.btn-close', function () {
            $('#offcanvasBackdrop').offcanvas('hide');
            $('#addUserForm')[0].reset();
            $('#userId').val('');
        });

        $('#addUserForm').on('submit', function (e) {
            e.preventDefault();
            $('#offcanvasBackdrop').offcanvas('hide');

            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
            $('#addUserForm')[0].reset();
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