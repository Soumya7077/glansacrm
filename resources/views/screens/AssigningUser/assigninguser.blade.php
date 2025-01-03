@extends('layouts/contentNavbarLayout')
@section('title', 'AssigningUser - Assigning User')

@section('content')
<h4><span class="text-muted fw-light">Home /</span> Assigning User </h4>

<div class="d-flex justify-content-between align-items-center py-3">
    <h3 class="mb-0">Users</h3>
    <button id="clearForm" class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
        data-bs-target="#offcanvasBackdrop" aria-controls="offcanvasBackdrop"> Assigning User </button>
</div>

<div>
    <h5 class="card-header">User Master List</h5>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover shadow-sm text-sm" id="table">
            <thead class="table-dark text-center small">
                <tr>
                    <th>S No.</th>
                    <th>Name</th>
                    <th>Job Title</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr>
                    <td>01</td>
                    <td>Naveen</td>
                    <td>React</td>
                    <td class="text-center">
                        <!-- <a href="" class="btn btn-primary btn-sm">Edit</a> -->
                        <a id="clearForm" class="btn btn-primary btn-sm text-white">Edit</a>
                        <a href="" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
                <tr>
                    <td>02</td>
                    <td>Anita</td>
                    <td>PHP</td>
                    <td class="text-center">
                        <!-- <a href="" class="btn btn-primary btn-sm">Edit</a> -->
                        <a id="clearForm" class="btn btn-primary btn-sm text-white">Edit</a>
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
                <h5 id="offcanvasBackdropLabel" class="offcanvas-title">Assigning User</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <hr>
            <div class="offcanvas-body mx-0 flex-grow-0">
                <form id="assignUserForm" novalidate>
                    @csrf
                    <input type="hidden" id="userId">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-floating form-floating-outline mb-4">
                                <select class="form-control" id="recruiter" required>
                                    <option value="" hidden>Select Recruiter</option>
                                </select>
                                <label for="recruiter">Recruiter</label>
                                <div class="invalid-feedback">Please select a recruiter.</div>
                            </div>
                            <div class="form-floating form-floating-outline mb-4">
                                <select class="form-control" id="Job-Title" required>
                                    <option value="" hidden>Select Job Title</option>
                                </select>
                                <label for="Job-Title">Job Title</label>
                                <div class="invalid-feedback">Please select a job title.</div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mb-2">Submit</button>
                </form>
                <button type="button" class="btn btn-outline-secondary d-grid w-100" id="cancelButton">Cancel</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            // fetch("/api/getrecruiter")
            //     .then(response => response.json())
            //     .then(data => {
            //         if (data.status === "success" && Array.isArray(data.data) && data.data.length > 0) {
            //             const recruiterSelect = $('#recruiter');
            //             recruiterSelect.empty();
            //             recruiterSelect.append('<option hidden value="">Select Recruiter</option>');
            //             data.data.forEach(recruiter => {
            //                 recruiterSelect.append('<option value="' + recruiter.id + '">' + recruiter.Name + '</option>');
            //             });
            //         } else {
            //             $('#recruiter').append('<option value="" hidden>No recruiters available</option>');
            //             console.warn('No recruiters found.');
            //         }
            //     })
            //     .catch(error => {
            //         console.error('Error fetching recruiters:', error);
            //         alert('Error fetching recruiters: ' + error);
            //     });

            // fetch("/api/getJob")
            //     .then(response => response.json())
            //     .then(data => {
            //         if (data.status === "success" && Array.isArray(data.data) && data.data.length > 0) {
            //             const jobTitleSelect = $('#Job-Title');
            //             jobTitleSelect.empty();
            //             jobTitleSelect.append('<option hidden value="">Select Job Title</option>');
            //             data.data.forEach(job => {
            //                 jobTitleSelect.append('<option value="' + job.id + '">' + job.Title + '</option>');
            //             });
            //         } else {
            //             $('#Job-Title').append('<option value="" hidden>No job titles available</option>');
            //             console.warn('No job titles found.');
            //         }
            //     })
            //     .catch(error => {
            //         console.error('Error fetching job titles:', error);
            //         alert('Error fetching job titles: ' + error);
            //     });

            // $('#assignUserForm').on('submit', function (e) {
            //     e.preventDefault();
            //     let isValid = true;

            //     const recruiter = $('#recruiter').val();
            //     if (!recruiter) {
            //         $('#recruiter').addClass('is-invalid');
            //         isValid = false;
            //     } else {
            //         $('#recruiter').removeClass('is-invalid').addClass('is-valid');
            //     }

            //     const jobTitle = $('#Job-Title').val();
            //     if (!jobTitle) {
            //         $('#Job-Title').addClass('is-invalid');
            //         isValid = false;
            //     } else {
            //         $('#Job-Title').removeClass('is-invalid').addClass('is-valid');
            //     }

            //     if (isValid) {
            //         const formData = {
            //             recruiter_id: recruiter,
            //             job_title_id: jobTitle
            //         };

            //         fetch('/api/assignrecruitertojob', {
            //             method: 'POST',
            //             headers: {
            //                 'Content-Type': 'application/json',
            //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //             },
            //             body: JSON.stringify(formData)
            //         })
            //             .then(response => response.json())
            //             .then(data => {
            //                 if (data.status === "success") {
            //                     console.log('Success:', data);
            //                 } else {
            //                     console.error('Error:', data.message);
            //                 }
            //             })
            //             .catch(error => {
            //                 console.error('Error:', error);
            //             });
            //     }
            // });

            $(document).on('click', '#clearForm', function () {

                $('#offcanvasBackdrop').offcanvas('show');
                $('.offcanvas-title').text('Add Name');
                $('#SubBtn').text('Add');
            })

            $('#cancelButton').on('click', function () {
                $('#assignUserForm')[0].reset();
                $('#recruiter, #Job-Title').removeClass('is-valid is-invalid');
            });
        });
    </script>
@endpush