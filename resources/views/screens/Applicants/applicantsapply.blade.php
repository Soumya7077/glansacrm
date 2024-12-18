@extends('layouts/contentNavbarLayout')
@section('title', 'Applicants - Applicants Apply')

@section('content')
<h4><span class="text-muted fw-light">Home /</span> Applicants Apply</h4>

<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Applicants Apply</h5> <small class="text-muted float-end">Please provide your details
            below</small>
    </div>
    <div class="card-body">
        <form>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="name" placeholder="Full Name" required />
                        <label for="name">Name</label>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="tel" class="form-control" id="phone-number" placeholder="Phone Number" required />
                        <label for="phone-number">Phone Number</label>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="email" class="form-control" id="email" placeholder="Email" required />
                        <label for="email">Email</label>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="number" class="form-control" id="Work-Experience" placeholder="Work Experience"
                            required />
                        <label for="work-experience">Work Experience</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="number" class="form-control" id="current-salary" placeholder="Current Salary"
                            required />
                        <label for="current-salary">Current Salary</label>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="number" class="form-control" id="expected-salary" placeholder="Expected Salary"
                            required />
                        <label for="expected-salary">Expected Salary</label>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="highest-qualification"
                            placeholder="Highest Qualification" required />
                        <label for="highest-qualification">Highest Qualification</label>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="file" class="form-control" id="resume" required />
                        <label for="resume">Resume</label>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

@endsection