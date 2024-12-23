@extends('layouts/contentNavbarLayout')
@section('title', 'Jobs - Job Post')

@section('content')
<h4><span class="text-muted fw-light">Home /</span> Job Post</h4>

<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Job Post</h5>
        <small class="text-muted float-end">Fill in the details for the job post</small>
    </div>
    <div class="card-body">
        <form id="jobPostForm" novalidate>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="job-title" name="jobTitle" placeholder="Job Title"
                            required minlength="3" />
                        <label for="job-title">Title</label>
                        <div class="invalid-feedback">Please enter a valid job title (at least 3 characters).</div>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="organisation-name" name="organisationName"
                            placeholder="Organisation Name" required minlength="3" />
                        <label for="organisation-name">Organisation Name</label>
                        <div class="invalid-feedback">Please enter the organisation name (at least 3 characters).</div>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="number" class="form-control" id="openings" name="openings"
                            placeholder="Number of Openings" required min="1" />
                        <label for="openings">Openings</label>
                        <div class="invalid-feedback">Please enter the number of openings (minimum 1).</div>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="salary" name="salary" placeholder="Salary" required
                            pattern="^[0-9]+(\.[0-9]{1,2})?$" />
                        <label for="salary">Salary</label>
                        <div class="invalid-feedback">Please enter a valid salary (e.g., 50000 or 50000.50).</div>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="job-location" name="jobLocation"
                            placeholder="Job Location" required minlength="3" />
                        <label for="job-location">Location</label>
                        <div class="invalid-feedback">Please enter the job location (at least 3 characters).</div>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="education" name="education"
                            placeholder="Education Requirement" required minlength="3" />
                        <label for="education">Education</label>
                        <div class="invalid-feedback">Please enter the education requirement (at least 3 characters).
                        </div>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="key-skills" name="keySkills"
                            placeholder="Key Skills" required minlength="3" />
                        <label for="key-skills">Key Skills</label>
                        <div class="invalid-feedback">Please enter the key skills (at least 3 characters).</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="department" name="department"
                            placeholder="Department" required minlength="3" />
                        <label for="department">Department</label>
                        <div class="invalid-feedback">Please enter the department (at least 3 characters).</div>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="experience" name="experience"
                            placeholder="Experience" required pattern="^[0-9]+(?:\.[0-9]{1,2})?$" />
                        <label for="experience">Experience</label>
                        <div class="invalid-feedback">Please enter valid experience in years (e.g., 2 or 2.5).</div>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <select class="form-control" id="shift" name="shift" required>
                            <option value="" hidden>Select Shift</option>
                            <option value="Day">Day</option>
                            <option value="Night">Night</option>
                        </select>
                        <label for="shift">Shift</label>
                        <div class="invalid-feedback">Please select a shift.</div>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <select class="form-control" id="job-type" name="jobType" required>
                            <option value="" hidden>Select Job Type</option>
                            <option value="full-time">Full-time</option>
                            <option value="part-time">Part-time</option>
                            <option value="contract">Contractual</option>
                        </select>
                        <label for="job-type">Job Type</label>
                        <div class="invalid-feedback">Please select a job type.</div>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <textarea id="job-description" class="form-control" name="jobDescription"
                            placeholder="Job Description" style="height: 122px;" required minlength="10"></textarea>
                        <label for="job-description">Description</label>
                        <div class="invalid-feedback">Please enter a job description (at least 10 characters).</div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Post Job</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const form = document.getElementById('jobPostForm');

        form.addEventListener('submit', (event) => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }

            form.classList.add('was-validated');
        });
    });
</script>

@endsection