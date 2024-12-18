@extends('layouts/contentNavbarLayout')
@section('title', 'Jobs - Job Post')

@section('content')
<h4><span class="text-muted fw-light">Employer /</span> Employer Form</h4>

<div class="card mb-4">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Employer Form</h5> <small class="text-muted float-end">Fill in the details for the employer
      post</small>
  </div>
  <div class="card-body">
    <form>
      <div class="row">
        <div class="col-md-6">

          <div class="form-floating form-floating-outline mb-4">
            <input type="text" class="form-control" id="job-title" placeholder="Organisation Name" required />
            <label for="job-title">Organisation Name</label>
          </div>
          <div class="form-floating form-floating-outline mb-4">
            <input type="text" class="form-control" id="organisation-name" placeholder="Phone Number" required />
            <label for="organisation-name">Phone Number</label>
          </div>


        </div>
        <div class="col-md-6">


          <div class="form-floating form-floating-outline mb-4">
            <input type="email" class="form-control" id="openings" placeholder="Email" required />
            <label for="openings">Email</label>
          </div>
          <div class="form-floating form-floating-outline mb-4">
            <input type="text" class="form-control" id="salary" placeholder="Location" />
            <label for="salary">Location</label>
          </div>
        </div>

      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>

@endsection
