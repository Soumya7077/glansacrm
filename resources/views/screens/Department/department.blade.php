@extends('layouts/contentNavbarLayout')
@section('title', 'Department - Department')

@section('content')
<h4><span class="text-muted fw-light">Home /</span> Department</h4>
<div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Department</h5>
    <button id="addbtn" class="btn btn-primary" type="button">Add</button>
</div>

<div>
    <h5 class="card-header">User Master List</h5>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover shadow-sm text-sm" id="table">
            <thead class="table-dark text-center small">
                <tr>
                    <th>S No.</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr>
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
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mb-2" id="SubBtn"></button>
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
            var table = $('#table').DataTable();
            let userList = [];

            $(document).on('click', '.btn-close', function () {
                $('#offcanvasBackdrop').offcanvas('hide');
                $('#addNameForm')[0].reset();
                $('#nameId').val('');
            })

            $(document).on('click', '#addbtn', function () {

                $('#offcanvasBackdrop').offcanvas('show');
                $('.offcanvas-title').text('Add Name');
                $('#SubBtn').text('Add');
            })

            $('#cancelButton').on('click', function () {
                $('#addNameForm')[0].reset();
                $('#addNameForm').find('.is-invalid').removeClass('is-invalid');
            });
            $('#clearForm').on('click', function () {
                $('#addNameForm')[0].reset();
                $('#addNameForm').find('.is-invalid').removeClass('is-invalid');
            });
        });
    </script>
@endpush


@endsection