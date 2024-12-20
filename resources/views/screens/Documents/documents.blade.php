@extends('layouts/contentNavbarLayout')
@section('title', 'Documents - documents')

@section('content')
<h4><span class="text-muted fw-light">Home /</span> Documents</h4>

<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Documents</h5> <small class="text-muted float-end">Provide the necessary information</small>
    </div>
    <div class="card-body">
        <form id="validationForm" class="needs-validation" novalidate>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="organisation-name" placeholder="Organisation Name"
                            required />
                        <label for="organisation-name">Organisation Name</label>
                        <div class="invalid-feedback">Please enter the organisation name.</div>
                    </div>

                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="applicant-name" placeholder="Applicant's Name"
                            required />
                        <label for="applicant-name">Applicant's Name</label>
                        <div class="invalid-feedback">Please enter the applicant's name.</div>
                    </div>

                    <div class="form-floating form-floating-outline mb-4">
                        <input type="file" class="form-control" id="resume" required />
                        <label for="resume">Resume</label>
                        <div class="invalid-feedback">Please upload a resume file.</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <select class="form-control" id="status" required>
                            <option value="" hidden>Select Status</option>
                            <option value="verified">Verified</option>
                            <option value="uploaded">Uploaded</option>
                        </select>
                        <label for="status">Status</label>
                        <div class="invalid-feedback">Please select a status.</div>
                    </div>

                    <div class="form-floating form-floating-outline mb-4">
                        <textarea id="description" class="form-control" placeholder="Description" style="height: 122px;"
                            required></textarea>
                        <label for="description">Description</label>
                        <div class="invalid-feedback">Please provide a description.</div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#validationForm').on('submit', function (event) {
            let isValid = true;

            const organisationName = $('#organisation-name');
            if (organisationName.val().trim() === '') {
                organisationName.addClass('is-invalid');
                isValid = false;
            } else {
                organisationName.removeClass('is-invalid').addClass('is-valid');
            }

            const applicantName = $('#applicant-name');
            if (applicantName.val().trim() === '') {
                applicantName.addClass('is-invalid');
                isValid = false;
            } else {
                applicantName.removeClass('is-invalid').addClass('is-valid');
            }

            const resume = $('#resume');
            if (resume.val() === '') {
                resume.addClass('is-invalid');
                isValid = false;
            } else {
                resume.removeClass('is-invalid').addClass('is-valid');
            }

            const status = $('#status');
            if (status.val() === '') {
                status.addClass('is-invalid');
                isValid = false;
            } else {
                status.removeClass('is-invalid').addClass('is-valid');
            }

            const description = $('#description');
            if (description.val().trim() === '') {
                description.addClass('is-invalid');
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

        $('#organisation-name, #applicant-name, #resume, #status, #description').on('input change', function () {
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