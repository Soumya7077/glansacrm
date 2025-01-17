@extends('layouts/contentNavbarLayout')
@section('title', 'Department - Department')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
<h4><span class="text-muted fw-light">Home /</span> Department</h4>
<div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Department</h5>
    <button id="addbtn" class="btn btn-primary" type="button">Add</button>
</div>

<div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover shadow-sm text-sm" id="table">
            <thead class="table-dark text-center small">
                <tr class="text-center align-middle">
                    <th>S No.</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr class="text-center align-middle">
                    <td>01</td>
                    <td>Operation</td>
                    <td class="text-center">
                        <!-- <a href="" class="btn btn-primary btn-sm">Edit</a> -->
                        <a id="addbtn" class="btn btn-primary btn-sm text-white">Edit</a>
                        <a href="" class="btn btn-danger btn-sm">Delete</a>
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
                <h5 id="offcanvasBackdropLabel" class="offcanvas-title"></h5>
                <button type="button" class="btn-close text-reset"></button>
            </div>
            <hr>
            <div class="offcanvas-body mx-0 flex-grow-0">
                <form id="addNameForm" novalidate>
                    <!-- @csrf -->
                    <input type="hidden" id="nameid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                                        required />
                                    <label for="name">Name</label>
                                    <div class="invalid-feedback">Please enter a valid Name.</div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mb-2">Add</button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-outline-secondary d-grid w-100"
                        id="cancelButton">Cancel</button>
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
                Department has been successfully added!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>


@push('scripts')
    <script>
        $(document).ready(function () {
            fetchDepartments();
            
            // Fetch Departments
            function fetchDepartments() {
                $.ajax({
                    url: 'http://127.0.0.1:8000/api/getdepartment',
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        let rows = '';
                        $.each(response.data, function (index, department) {
                            rows += `<tr class="text-center align-middle">
                                        <td>${index + 1}</td>
                                        <td>${department.Name}</td>
                                        <td>
                                            <button class="btn btn-primary btn-sm editBtn" data-id="${department.id}" data-name="${department.Name}">Edit</button>
                                            <button class="btn btn-danger btn-sm deleteBtn" data-id="${department.id}">Delete</button>
                                        </td>
                                    </tr>`;
                        });
                        $('#tbody').html(rows);
                    }
                });
            }

            // Open Add Modal
            $('#addbtn').click(function () {
                $('#deptId').val('');
                $('#deptName').val('');
                $('#offcanvasBackdropLabel').text('Add Department');
                let offcanvas = new bootstrap.Offcanvas(document.getElementById('offcanvasBackdrop'));
                offcanvas.show();
            });

            // Open Edit Modal
            $(document).on('click', '.editBtn', function () {
                let id = $(this).data('id');
                let name = $(this).data('name');

                $('#deptId').val(id);
                $('#deptName').val(name);
                $('#offcanvasBackdropLabel').text('Edit Department');

                let offcanvas = new bootstrap.Offcanvas(document.getElementById('offcanvasBackdrop'));
                offcanvas.show();
            });

            // Save (Add / Update) Department
            $('#departmentForm').submit(function (e) {
                e.preventDefault();
                let id = $('#deptId').val();
                let name = $('#deptName').val().trim();

                if (!name) {
                    $('#deptName').addClass('is-invalid');
                    return;
                } else {
                    $('#deptName').removeClass('is-invalid');
                }

                let url = id ? `http://127.0.0.1:8000/api/updateDepartment/${id}` : "http://127.0.0.1:8000/api/department";
                let method = id ? "PUT" : "POST";

                $.ajax({
                    url: url,
                    type: method,
                    data: JSON.stringify({ name: name }),
                    contentType: "application/json",
                    headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content') },
                    success: function (response) {
                        if (response.success) {
                            let offcanvas = bootstrap.Offcanvas.getInstance(document.getElementById('offcanvasBackdrop'));
                            offcanvas.hide();
                            $('#successModal').modal('show');
                            $('#departmentForm')[0].reset();
                            fetchDepartments();
                        } else {
                            alert("Operation failed.");
                        }
                    },
                    error: function (xhr) {
                        alert("Error: " + xhr.responseText);
                    }
                });
            });

            // Delete Department
            $(document).on('click', '.deleteBtn', function () {
                let id = $(this).data('id');

                if (confirm('Are you sure you want to delete this department?')) {
                    $.ajax({
                        url: `http://127.0.0.1:8000/api/deleteDepartment/${id}`,
                        type: 'DELETE',
                        headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content') },
                        success: function (response) {
                            if (response.success) {
                                alert("Department deleted successfully!");
                                fetchDepartments();
                            } else {
                                alert("Failed to delete department.");
                            }
                        },
                        error: function (xhr) {
                            alert("Error: " + xhr.responseText);
                        }
                    });
                }
            });

            // Cancel Button
            $('#cancelButton').click(function () {
                let offcanvas = bootstrap.Offcanvas.getInstance(document.getElementById('offcanvasBackdrop'));
                offcanvas.hide();
            });
        });
    </script>
@endpush


@endsection