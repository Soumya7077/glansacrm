@extends('layouts/contentNavbarLayout')
@section('title', 'Jobs - Job Post')

@section('content')
<h4><span class="text-muted fw-light">Jobs /</span> Job Post</h4>

<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Job Post</h5> <small class="text-muted float-end">Fill in the details for the job
            post</small>
    </div>
    <div class="card-body">
        <form>
            <div class="row">
                <div class="col-md-6">

                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="job-title" placeholder="Job Title" required />
                        <label for="job-title">Title</label>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="organisation-name" placeholder="Organisation Name"
                            required />
                        <label for="organisation-name">Organisation Name</label>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="number" class="form-control" id="openings" placeholder="Number of Openings"
                            required />
                        <label for="openings">Openings</label>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="salary" placeholder="Salary" />
                        <label for="salary">Salary</label>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="job-location" placeholder="Job Location" required />
                        <label for="job-location">Location</label>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="education" placeholder="Education Requirement" />
                        <label for="education">Education</label>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="key-skills" placeholder="Key Skills" />
                        <label for="key-skills">Key Skills</label>
                    </div>

                </div>
                <div class="col-md-6">


                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="department" placeholder="Department" />
                        <label for="department">Department</label>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="experience" placeholder="Experience" required />
                        <label for="experience">Experience</label>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <select class="form-control" id="shift">
                            <option value="Day">Day</option>
                            <option value="Night">Night</option>
                        </select>
                        <label for="shift">Shift</label>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <select class="form-control" id="job-type">
                            <option value="full-time">Full-time</option>
                            <option value="part-time">Part-time</option>
                            <option value="contract">Contract</option>
                        </select>
                        <label for="job-type">Job Type</label>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <textarea id="job-description" class="form-control" placeholder="Job Description"
                            style="height: 100px;" required></textarea>
                        <label for="job-description">Description</label>
                    </div>

                </div>
            </div>

            <button type="submit" class="btn btn-primary">Post Job</button>
        </form>
    </div>
</div>

@endsection