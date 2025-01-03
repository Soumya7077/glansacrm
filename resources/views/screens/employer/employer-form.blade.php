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
    <form class="needs-validation" novalidate>
      <div class="row">
        <div class="col-md-6">

          <div class="form-floating form-floating-outline mb-4">
            <input type="text" class="form-control" id="job-title" placeholder="Organisation Name" required />
            <label for="job-title">Organisation Name</label>
            <div class="invalid-feedback">Please provide the organisation name.</div>
          </div>
          <div class="form-floating form-floating-outline mb-4">
            <input type="tel" class="form-control" id="contact-person-name" placeholder="Contact Person Name" required
               />
            <label for="organisation-name">Contact Person</label>
            <div class="invalid-feedback">Please provide contact person</div>
          </div>
          <div class="form-floating form-floating-outline mb-4">
            <input type="tel" class="form-control" id="organisation-name" placeholder="Phone Number" required
              pattern="^\d{10}$" maxlength="10" />
            <label for="organisation-name">Phone Number</label>
            <div class="invalid-feedback">Please provide a valid 10-digit phone number.</div>
          </div>

        </div>
        <div class="col-md-6">
          <div class="form-floating form-floating-outline mb-4">
            <input type="email" class="form-control" id="openings" placeholder="Email" required />
            <label for="openings">Email</label>
            <div class="invalid-feedback">Please provide a valid email address.</div>
          </div>
          <div class="form-floating form-floating-outline mb-4">
            <input type="text" class="form-control" id="salary" placeholder="Location" required />
            <label for="salary">Location</label>
            <div class="invalid-feedback">Please provide a location.</div>
          </div>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function () {
    'use strict';
    $('.needs-validation').on('submit', function (event) {
      if (!this.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      }
      $(this).addClass('was-validated');
    });
  });
</script>

@endsection
