@extends('layouts/contentNavbarLayout')
@section('title', 'Formatted Details - Formatted Applicants to Employer')

@section('content')
<h4><span class="text-muted fw-light">Home /</span> Formatted Applicants to Employer </h4>

<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Formatted Applicants to Employer</h5> <small class="text-muted float-end">Provide the required
            details to process the application</small>
    </div>
    <div class="card-body">
    <form id="emailForm" class="needs-validation" novalidate>
    <div class="row">
        <div class="col-md-6">
            <div class="form-floating form-floating-outline mb-4">
                <select class="form-control" id="to" required>
                    <option value="" hidden>Select Recipient</option>
                    <option value="1">naveen@gmail.com</option>
                    <option value="2">soumya@gmail.com</option>
                    <option value="3">sourav@gmail.com</option>
                </select>
                <label for="to">To</label>
                <div class="invalid-feedback">Please select a recipient.</div>
            </div>

            <div class="form-floating form-floating-outline mb-4">
                <select class="form-control" id="Applicants" required>
                    <option value="" hidden>Select Applicant</option>
                    <option value="1">Naveen</option>
                    <option value="2">Sourav</option>
                    <option value="3">Soumya</option>
                </select>
                <label for="Applicants">Applicants</label>
                <div class="invalid-feedback">Please select an applicant.</div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-floating form-floating-outline mb-4">
                <textarea id="Subject-description" class="form-control" placeholder="Subject Description" style="height: 122px;" required></textarea>
                <label for="Subject-description">Subject Description</label>
                <div class="invalid-feedback">Please provide a subject description.</div>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Send Mail</button>
</form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#emailForm').on('submit', function (event) {
            let isValid = true;

            const toField = $('#to');
            if (toField.val() === '') {
                toField.addClass('is-invalid');
                isValid = false;
            } else {
                toField.removeClass('is-invalid').addClass('is-valid');
            }

            const applicantsField = $('#Applicants');
            if (applicantsField.val() === '') {
                applicantsField.addClass('is-invalid');
                isValid = false;
            } else {
                applicantsField.removeClass('is-invalid').addClass('is-valid');
            }

            const subjectDescription = $('#Subject-description');
            if (subjectDescription.val().trim() === '') {
                subjectDescription.addClass('is-invalid');
                isValid = false;
            } else {
                subjectDescription.removeClass('is-invalid').addClass('is-valid');
            }

            if (!isValid) {
                event.preventDefault();
                event.stopPropagation();
            }

            $(this).addClass('was-validated');
        });

        $('#to, #Applicants, #Subject-description').on('input change', function () {
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