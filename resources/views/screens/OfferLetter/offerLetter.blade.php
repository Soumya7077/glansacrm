@extends('layouts/contentNavbarLayout')

@section('title', 'Social Media Form')

@section('content')

<div class="col-xxl">
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Offer Letter</h5>
        </div>
        <div class="card-body">
            <form id="myForm" class="needs-validation" novalidate>
                <div class="row">
                    <div class="col-md-6">

                        <div class="form-floating form-floating-outline mb-4">
                            <select id="" class="form-select" required>
                                <option value="" hidden>Organisation Name</option>
                                <option value="1"></option>
                            </select>
                            <label for="Organisation-Name">Organisation Name</label>
                            <div class="invalid-feedback">Please enter the organisation name.</div>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" id="interviewDate" name="interviewDate"
                                placeholder="Subject" required />
                            <label for="Subject">Subject</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <select id="" class="form-select" required>
                                <option value="" hidden>To</option>
                                <option value="1">naveen@gmail.com</option>
                                <option value="1">soumya@gmail.com</option>
                                <option value="1">anita@gmail.com</option>
                            </select>
                            <label for="to">To</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="file" class="form-control" id="file" required />
                            <label for="file">File</label>
                            <div class="invalid-feedback">Please upload a file.</div>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <textarea id="description" name="description" class="form-control" placeholder="Description"
                                style="height: 122px;" required></textarea>
                            <label for="description">Description</label>
                            <div class="invalid-feedback">Please provide a description.</div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Send</button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#myForm').on('submit', function (event) {
            let isValid = true;

            const organisationName = $('#organisationName');
            if (organisationName.val().trim() === '') {
                organisationName.addClass('is-invalid');
                organisationName.removeClass('is-valid');
                isValid = false;
            } else {
                organisationName.removeClass('is-invalid').addClass('is-valid');
            }

            const fileInput = $('#file');
            if (fileInput.val() === '') {
                fileInput.addClass('is-invalid');
                fileInput.removeClass('is-valid');
                isValid = false;
            } else {
                fileInput.removeClass('is-invalid').addClass('is-valid');
            }

            const status = $('#status');
            if (status.val() === '') {
                status.addClass('is-invalid');
                status.removeClass('is-valid');
                isValid = false;
            } else {
                status.removeClass('is-invalid').addClass('is-valid');
            }

            const description = $('#description');
            if (description.val().trim() === '') {
                description.addClass('is-invalid');
                description.removeClass('is-valid');
                isValid = false;
            } else {
                description.removeClass('is-invalid').addClass('is-valid');
            }

            if (!isValid) {
                event.preventDefault();
                event.stopPropagation();
            }

            $(this).addClass('was-validated');
        });

        $('#organisationName, #file, #status, #description').on('input change', function () {
            const input = $(this);
            if (input.val().trim() === '') {
                input.addClass('is-invalid').removeClass('is-valid');
            } else {
                input.removeClass('is-invalid').addClass('is-valid');
            }
        });
    });
</script>

@endsection