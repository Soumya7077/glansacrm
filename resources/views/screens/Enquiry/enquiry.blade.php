@extends('layouts/contentNavbarLayout')

@section('title', 'Vertical Layouts - Forms')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Forms/</span>Enquiry Form</h4>

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
            <div class="col-md-6">
              <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" id="name" placeholder="John Doe" />
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
            <div class="col-md-6">
              <div class="input-group input-group-merge">
                <div class="form-floating form-floating-outline">
                  <input type="text" class="form-control" id="email" placeholder="Email" />
                  <label for="email">Email</label>
                </div>
                <span class="input-group-text">@example.com</span>
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
            <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                  <input type="text" class="form-control" id="job-post" placeholder="Job Post" />
                  <label for="job-post">Job Post</label>
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
            <div class="col-md-6">
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

          <!-- Submit Button -->
          <div class="text-end">
            <button type="submit" class="btn btn-primary">Send</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
