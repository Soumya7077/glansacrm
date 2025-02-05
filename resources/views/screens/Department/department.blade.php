@extends('layouts/contentNavbarLayout')
@section('title', 'Department - Department')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
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
                <!-- <tr id="loading" class="text-primary">
                    <td colspan="3">Loading...</td>
                    <td></td>
                    <td></td>
                </tr> -->
            </tbody>
        </table>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="messageModalLabel">Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="messageModalBody"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirmation </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to perform this action?
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancel
                </button>
                <button type="button" class='btn btn-danger' id='confirmDeleteButton'>
                    Confirm
                </button>
            </div>
        </div>
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
                <form id="departmentForm" novalidate>
                    <input type="hidden" id="deptId">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-floating form-floating-outline mb-4">
                                <input type="text" class="form-control" id="deptName" name="name" placeholder="Name"
                                    required />
                                <label for="deptName">Name</label>
                                <!-- <div class="invalid-feedback">Departname Name is required. Please enter a valid name.
                                </div> -->
                                <div class="invalid-feedback">Department Name is required. Please enter a valid name
                                    (letters only).</div>
                            </div>
                            <button type="submit" id="submitBtn" class="btn btn-primary w-100 mb-2">Submit</button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-outline-secondary d-grid w-100"
                        id="cancelButton">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>

        $(document).ready(function () {
            fetchDepartments();
            var table = $('#table').DataTable();
            function fetchDepartments() {
                $('#tbody').html('<tr><td colspan="3" class="text-primary">Loading...</td></tr>');
                $.ajax({
                    url: '/api/getdepartment',
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        let rows = '';
                        if (response.data.length > 0) {
                            var tableBody = $('#tbody');
                            tableBody.empty();
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
                            tableBody.append(rows);
                            table.clear(); // Clear any previous DataTable data
                            table.rows.add(tableBody.find('tr')).draw();
                        } else {
                            rows = '<tr><td colspan="3" class="text-danger">No Data Found</td></tr>';
                        }
                        $('#tbody').html(rows);
                    }
                });
            }

            function showMessageModal(message) {
                $('#messageModalBody').text(message);
                new bootstrap.Modal(document.getElementById('messageModal')).show();
            }

            $('#addbtn').click(function () {
                $('#deptId').val('');
                $('#deptName').val('');
                $('#offcanvasBackdropLabel').text('Add Department');
                new bootstrap.Offcanvas(document.getElementById('offcanvasBackdrop')).show();
            });

            $(document).on('click', '.editBtn', function () {
                $('#deptId').val($(this).data('id'));
                $('#deptName').val($(this).data('name'));
                $('#offcanvasBackdropLabel').text('Edit Department');
                new bootstrap.Offcanvas(document.getElementById('offcanvasBackdrop')).show();
            });

            $('#departmentForm').submit(function (e) {
                e.preventDefault();
                let id = $('#deptId').val();
                let name = $('#deptName').val().trim();
                let submitBtn = $('#submitBtn');

                if (!name) {
                    $('#deptName').addClass('is-invalid');
                    return;
                } else {
                    $('#deptName').removeClass('is-invalid');
                }

                let url = id ? `/api/updateDepartment/${id}` : "/api/department";
                let method = id ? "PUT" : "POST";
                let successMessage = id ? "Department updated successfully." : "Department added successfully.";

                submitBtn.prop('disabled', true).text('Submitting...');

                $.ajax({
                    url: url,
                    type: method,
                    data: JSON.stringify({ name: name }),
                    contentType: "application/json",
                    headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content') },
                    success: function (response) {
                        if (response.status == 200) {
                            bootstrap.Offcanvas.getInstance(document.getElementById('offcanvasBackdrop')).hide();
                            fetchDepartments();
                            showMessageModal(successMessage);
                        } else {
                            showMessageModal("Operation failed.");
                        }
                    },
                    error: function (xhr) {
                        showMessageModal("Error: " + xhr.responseText);
                    },
                    complete: function () {
                        // Re-enable button and restore text
                        submitBtn.prop('disabled', false).text('Submit');
                    }
                });
            });
            // $('#deptName').on('input', function () {
            //     if ($(this).val().trim()) {
            //         $(this).removeClass('is-invalid');
            //     }
            // });

            $('#deptName').on('input', function () {
                let inputVal = $(this).val();

                inputVal = inputVal.replace(/[^A-Za-z\s]/g, '');

                $(this).val(inputVal.charAt(0).toUpperCase() + inputVal.slice(1));

                if ($(this).val().trim()) {
                    $(this).removeClass('is-invalid');
                }
            });


            let deleteId = null;

            $(document).on('click', '.deleteBtn', function () {
                deleteId = $(this).data('id');
                new bootstrap.Modal(document.getElementById('confirmModal')).show();
            });

            $('#confirmDeleteButton').click(function () {
                let confirmBtn = $(this);
                confirmBtn.prop('disabled', true).text('Deleting...');

                $.ajax({
                    url: `/api/deleteDepartment/${deleteId}`,
                    type: 'DELETE',
                    headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content') },
                    success: function (response) {
                        if (response) {
                            fetchDepartments();
                            showMessageModal("Department deleted successfully.");
                        } else {
                            showMessageModal("Failed to delete department.");
                        }
                    },
                    error: function (xhr) {
                        showMessageModal("Error: " + xhr.responseText);
                    },
                    complete: function () {
                        // Re-enable button and restore text
                        confirmBtn.prop('disabled', false).text('Confirm');
                        bootstrap.Modal.getInstance(document.getElementById('confirmModal')).hide();
                    }
                });
            });

            // $(document).on('click', '.deleteBtn', function () {
            //     let id = $(this).data('id');
            //     if (confirm('Are you sure you want to delete this department?')) {
            //         $.ajax({
            //             url: `/api/deleteDepartment/${id}`,
            //             type: 'DELETE',
            //             headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content') },
            //             success: function (response) {
            //                 if (response) {
            //                     fetchDepartments();
            //                     showMessageModal("Department deleted successfully.");
            //                 } else {
            //                     showMessageModal("Failed to delete department.");
            //                 }
            //             },
            //             error: function (xhr) {
            //                 showMessageModal("Error: " + xhr.responseText);
            //             }
            //         });
            //     }
            // });

            // When the Cancel button is clicked, clear the form and hide the offcanvas
            $('#cancelButton').click(function () {
                $('#departmentForm')[0].reset();
                $('#deptName').removeClass('is-invalid'); // Remove error class if any
                bootstrap.Offcanvas.getInstance(document.getElementById('offcanvasBackdrop')).hide();
            });

            // When the cross button (close) is clicked, just close the offcanvas
            $('.btn-close').click(function () {
                bootstrap.Offcanvas.getInstance(document.getElementById('offcanvasBackdrop')).hide();
            });
        });
    </script>
@endpush
@endsection