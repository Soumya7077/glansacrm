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
        <form id="jobApplicationForm" class="needs-validation" novalidate>
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="first-name" placeholder="First Name" required />
                        <label for="first-name">First Name</label>
                        <div class="invalid-feedback">Please enter your First name.</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="last-name" placeholder="Last Name" required />
                        <label for="last-name">Last Name</label>
                        <div class="invalid-feedback">Please enter your Last name.</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="tel" class="form-control" id="phone-number" placeholder="Phone Number"
                            maxlength="10" required />
                        <label for="phone-number">Phone Number</label>
                        <div class="invalid-feedback">Please enter a valid phone number.</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="email" class="form-control" id="email" placeholder="Email" required />
                        <label for="email">Email</label>
                        <div class="invalid-feedback">Please enter a valid email address.</div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="url" class="form-control" id="portfolio"
                            placeholder="Portfolio/LinkedIn Profile" />
                        <label for="portfolio">Portfolio/LinkedIn Profile</label>
                    </div>
                </div>
                <div class="col-md-6">

                    <div class="form-floating form-floating-outline mb-4">
                        <select name="" id="" class="form-select">
                            <option value=""></option>
                            <option value="React">React</option>
                            <option value="Php">Php</option>
                        </select>
                        <label for="Applying-For">Applying For</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="highest-qualification"
                            placeholder="Highest Qualification" required />
                        <label for="highest-qualification">Highest Qualification</label>
                        <div class="invalid-feedback">Please enter your highest qualification.</div>
                    </div>
                </div>
                <div class="col-md-6">

                    <div class="form-floating form-floating-outline mb-4">
                        <select name="" id="" class="form-select">
                            <option value="">Fresher</option>
                            <option value="">Experience</option>
                        </select>
                        <label for="Type">Type</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="current-location" placeholder="Current Location" />
                        <label for="current-location">Current Location</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="preferred-location"
                            placeholder="Preferred Location" />
                        <label for="preferred-location">Preferred Location</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="number" class="form-control" id="height" placeholder="Height" />
                        <label for="height">Height</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="number" class="form-control" id="weight" placeholder="Weight" />
                        <label for="weight">Weight</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="blood-group" placeholder="Blood Group" />
                        <label for="blood-group">Blood Group</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="number" class="form-control" id="hemoglobin" placeholder="Hemoglobin %" />
                        <label for="hemoglobin">Hemoglobin %</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <select name="" id="" class="form-select">
                            <option value=""></option>
                            <option value="">Immediate</option>
                            <option value="">15 days</option>
                            <option value="">1 month</option>
                            <option value="">more than one month</option>
                        </select>
                        <label for="Notice-Period">Notice Period</label>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="current-organisation"
                            placeholder="Current Organisation" />
                        <label for="current-organisation">Current Organisation</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="number" class="form-control" id="current-salary" placeholder="Current Salary"
                            required />
                        <label for="current-salary">Current Salary</label>
                        <div class="invalid-feedback">Please enter your current salary.</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="number" class="form-control" id="expected-salary" placeholder="Expected Salary"
                            required />
                        <label for="expected-salary">Expected Salary</label>
                        <div class="invalid-feedback">Please enter your expected salary.</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="file" class="form-control" id="resume" required />
                        <label for="resume">Resume</label>
                        <div class="invalid-feedback">Please upload your resume.</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="file" class="form-control" id="certificates" />
                        <label for="certificates">Certificates</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">

                    <div class="form-floating form-floating-outline mb-4">
                        <select name="" id="" class="form-select">
                            <option value=""></option>
                            <option value="">0-1</option>
                            <option value="">1</option>
                            <option value="">2</option>
                            <option value="">3</option>
                            <option value="">4</option>
                            <option value="">5</option>
                            <option value="">6</option>
                        </select>
                        <label for="Work-Experience">Work Experience</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <textarea class="form-control" id="remarks" placeholder="Remarks"></textarea>
                        <label for="remarks">Remarks</label>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
    </div>

    </form>
</div>
</div>
@endsection