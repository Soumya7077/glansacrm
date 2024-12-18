@extends('layouts/contentNavbarLayout')

@section('title', 'Social Media Form')

@section('content')

<div class="col-xxl">
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Formatted Details</h5>
        </div>
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" id="basic-default-fullname" placeholder="Name" />
                            <label for="basic-default-fullname">Applicant Name</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" id="basic-default-fullname"
                                placeholder="Job Applied" />
                            <label for="basic-default-fullname">Job Applied</label>
                        </div>
                        <div class="mb-4">
                            <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control" id="basic-default-fullname"
                                        placeholder="Key Skills" />
                                    <label for="basic-default-fullname">Key Skills</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="number" class="form-control" id="basic-default-fullname"
                                placeholder="Work Experience" />
                            <label for="basic-default-fullname">Work Experience</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="number" class="form-control" id="basic-default-fullname"
                                placeholder="Current Salary" />
                            <label for="basic-default-fullname">Current Salary</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="number" class="form-control" id="basic-default-fullname"
                                placeholder="Expected Salary" />
                            <label for="basic-default-fullname">Expected Salary</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" id="basic-default-fullname"
                                placeholder="Highest Qualification" />
                            <label for="basic-default-fullname">Highest Qualification</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>
    </div>
</div>

@endsection