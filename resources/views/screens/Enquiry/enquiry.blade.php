@extends('layouts/contentNavbarLayout')

@section('title', 'Vertical Layouts - Forms')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Home/</span>Enquiry Form</h4>

<div class="row">
  <div class="col-xl">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Enquiry Form</h5>
        <small class="text-muted float-end"></small>
      </div>
      <div class="card-body">
        <form>
          <!-- First Row -->
          <div class="row mb-3">
            <div class="col-md-6 mb-3">
              <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" id="name" placeholder="Name" />
                <label for="name">Name</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating form-floating-outline">
                <input type="text" class="form-control phone-mask" id="phone" placeholder="1234567890" />
                <label for="phone">Phone No</label>
              </div>
            </div>
          </div>

          <!-- Second Row -->
          <div class="row mb-3">
            <div class="col-md-6 mb-3">
              <div class="input-group input-group-merge">
                <div class="form-floating form-floating-outline">
                  <input type="text" class="form-control" id="email" placeholder="Email" />
                  <label for="email">Email</label>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" id="qualification" placeholder="Qualification" />
                <label for="qualification">Qualification</label>
              </div>
            </div>
          </div>

          <!-- Third Row -->
          <div class="row mb-3">
            <div class="col-md-6 mb-3">
              <div class="form-floating form-floating-outline">
                <select class="form-control" id="job-post">
                  <option value="php">PHP</option>
                  <option value="react">React</option>
                  <option value="java">Java</option>
                </select>
                <label for="job-type">Job Post</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" id="experience" placeholder="Work Experience" />
                <label for="experience">Work Experience</label>
              </div>
            </div>
          </div>

          <!-- Fourth Row -->
          <div class="row mb-3">
            <div class="col-md-6 mb-3">
              <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" id="current-salary" placeholder="Current Salary" />
                <label for="current-salary">Current Salary</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" id="expected-salary" placeholder="Expected Salary" />
                <label for="expected-salary">Expected Salary</label>
              </div>
            </div>
          </div>

          <!-- Fourth Row -->
          <div class="row mb-3">
            <div class="col-md-6 mb-3">
              <div class="form-floating form-floating-outline">
                <input type="file" class="form-control" id="uploadResume" placeholder="Upload Resume" />
                <label for="current-salary">Upload Resume</label>
              </div>
            </div>

          </div>
          <div class="col-md-6">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
          <!-- Submit Button -->

        </form>
      </div>
    </div>
  </div>
</div>
@endsection