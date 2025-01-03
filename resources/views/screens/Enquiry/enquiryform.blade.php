@extends('layouts/contentNavbarLayout')

@section('title', 'Enquiry Form')

@section('content')
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Home /</span> Enquiry Form</h4>

    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Enquiry Form</h5>
                    <small class="text-muted float-end"></small>
                </div>
                <div class="card-body">
                    <form id="enquiryForm" novalidate>
                        <!-- First Row -->
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control" id="name" placeholder="First Name"
                                        required />
                                    <label for="name">First Name</label>
                                    <div class="invalid-feedback">Please enter your First Name.</div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control" id="name" placeholder="Last Name"
                                        required />
                                    <label for="name">Last Name</label>
                                    <div class="invalid-feedback">Please enter your Last Name.</div>
                                </div>
                            </div>

                        </div>

                        <!-- Second Row -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="tel" maxlength="10" class="form-control phone-mask" id="phone"
                                        placeholder="1234567890" pattern="^\d{10}$" required />
                                    <label for="phone">Phone No</label>
                                    <div class="invalid-feedback">Please enter a valid 10-digit phone number.</div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="input-group input-group-merge">
                                    <div class="form-floating form-floating-outline">
                                        <input type="email" class="form-control" id="email" placeholder="Email"
                                            required />
                                        <label for="email">Email</label>
                                        <div class="invalid-feedback">Please enter a valid email address.</div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Third Row -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control" id="qualification"
                                        placeholder="Qualification" required />
                                    <label for="qualification">Qualification</label>
                                    <div class="invalid-feedback">Please enter your qualification.</div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control" id="experience" placeholder="Work Experience"
                                        required />
                                    <label for="experience">Work Experience</label>
                                    <div class="invalid-feedback">Please enter your work experience.</div>
                                </div>
                            </div>
                        </div>

                        <!-- Fourth Row -->
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <div class="form-floating form-floating-outline">
                                    <input type="number" class="form-control" id="current-salary"
                                        placeholder="Current Salary" required />
                                    <label for="current-salary">Current Salary</label>
                                    <div class="invalid-feedback">Please enter your current salary.</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="number" class="form-control" id="expected-salary"
                                        placeholder="Expected Salary" required />
                                    <label for="expected-salary">Expected Salary</label>
                                    <div class="invalid-feedback">Please enter your expected salary.</div>
                                </div>
                            </div>
                        </div>

                        <!-- Resume Upload -->
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <div class="form-floating form-floating-outline">
                                    <select class="form-control" id="job-post" required>
                                        <option value="" hidden>Select Job Post</option>
                                        <option hidden value="">Applying For</option>
                                        <option value="1">Clinical Positions</option>
                                        <option value="2">Administrative and Support Roles</option>
                                        <option value="3">Research and Academic Roles</option>
                                    </select>
                                    <label for="job-post">Job Post</label>
                                    <div class="invalid-feedback">Please select a job post.</div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-floating form-floating-outline">
                                    <input type="file" class="form-control" id="uploadResume" required />
                                    <label for="uploadResume">Upload Resume</label>
                                    <div class="invalid-feedback">Please upload your resume.</div>
                                </div>
                            </div>
                        </div>

                        <!-- six Row -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <select name="" id="" class="form-select">
                                        <option value="">Immediate Joiner</option>
                                        <option value="">0-30 days</option>
                                        <option value="">30-45 days</option>
                                        <option value="">45-60 days</option>
                                        <option value="">More than 60 days</option>
                                    </select>
                                    <label for="qualification">Notice Period</label>
                                    <div class="invalid-feedback">Please enter your Remark.</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control" id="remark" placeholder="Remark"
                                        required />
                                    <label for="qualification">Remark</label>
                                    <div class="invalid-feedback">Please enter your Remark.</div>
                                </div>
                            </div>
                          </div>


                <!-- Submit Button -->
                <div class="col-md-6">
                    <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                    <a href="enquiry?" type="submit" class="btn btn-primary">Submit</a>
                </div>
                </form>
            </div>
        </div>
        <script>
            $(function() {
                $('#enquiryForm').submit(function(e) {
                    if (!this.checkValidity()) {
                        e.preventDefault();
                        e.stopPropagation();
                    }
                    $(this).addClass('was-validated');
                });
            });
        </script>
    @endsection
