@extends('layouts/contentNavbarLayout')
@section('title', 'AssigningUser - Assigning User')

@section('content')
<h4><span class="text-muted fw-light">Home /</span> Assigning User </h4>

<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Assigning User</h5> <small class="text-muted float-end">Fill in the required information to
            assign a user</small>
    </div>
    <div class="card-body">
        <form id="assignUserForm" novalidate>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <select class="form-control" id="recruiter" required>
                            <option value="" hidden>Select Recruiter</option>
                        </select>

                        <label for="recruiter">Recruiter</label>
                        <div class="invalid-feedback">
                            Please select a recruiter.
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <select class="form-control" id="Job-Title" required>
                            <option value="" hidden>Select Job Title</option>
                        </select>
                        <label for="Job-Title">Job Title</label>
                        <div class="invalid-feedback">
                            Please select a job title.
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $.ajax({
                url: "/api/getrecruiter",
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    console.log("API Response:", data);

                    if (data.status === "success" && data.data.length > 0) {
                        var recruiterSelect = $('#recruiter');
                        console.log(recruiterSelect.length ? "Element Found" : "Element Missing");

                        recruiterSelect.empty();
                        recruiterSelect.append('<option hidden value="">Select Recruiter</option>');

                        $.each(data.data, function (index, recruiter) {
                            recruiterSelect.append('<option value="' + recruiter.id + '">' + recruiter.Name + '</option>');
                        });
                    } else {
                        alert('No recruiters found');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching recruiters:', error);
                    alert('Error fetching recruiters: ' + error);
                }
            });



            $('#recruiter').on('change', function () {
                const recruiterId = $(this).val();
                console.log("Selected Recruiter ID:", recruiterId);

                if (recruiterId) {
                    console.log("Recruiter ID selected: " + recruiterId);
                } else {
                    console.log("No recruiter selected.");
                }
            });


            $.ajax({
                url: "/api/getJob",
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    console.log("API Response:", data);

                    if (data.status === "success" && data.data.length > 0) {
                        var jobTitleSelect = $('#Job-Title');
                        jobTitleSelect.empty();
                        jobTitleSelect.append('<option hidden value="">Select Job Title</option>');

                        $.each(data.data, function (index, job) {
                            jobTitleSelect.append('<option value="' + job.id + '">' + job.Title + '</option>');
                        });
                    } else {
                        alert('No job titles found');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching job titles:', error);
                    alert('Error fetching job titles: ' + error);
                }
            });


            $('#Job-Title').on('change', function () {
                const selectedJobId = $(this).val();
                console.log("Selected Job ID:", selectedJobId);

                if (selectedJobId) {
                    console.log("You selected Job ID: " + selectedJobId);
                } else {
                    alert("No Job Title selected.");
                }
            });


            $('#assignUserForm').on('submit', function (e) {
                e.preventDefault();
                if (!this.checkValidity()) {
                    e.stopPropagation();
                }

                $(this).addClass('was-validated');
            });
        });
    </script>
@endpush