@extends('layouts/contentNavbarLayout')
@section('title', 'Jobs - Job Post')

@section('content')
<h4><span class="text-muted fw-light">Employer /</span> Employer Form</h4>

<div class="card mb-4">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Employer Form</h5> 
    <small class="text-muted float-end">Fill in the details for the employer post</small>
  </div>
  <div class="card-body">
    <form class="needs-validation" novalidate>
      {{-- Contact Person 1 Section --}}
      <div class="card mb-4">
        <div class="card-header">
          <h6 class="text-primary mb-0">Contact Person 1 Details</h6>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-floating mb-4">
                <input type="text" class="form-control" id="contact-person-1-name" placeholder="Contact Person Name" required />
                <label for="contact-person-1-name">Contact Person Name</label>
                <div class="invalid-feedback">Please provide contact person 1's name.</div>
              </div>
              <div class="form-floating mb-4">
                <input type="tel" class="form-control" id="contact-person-1-phone" placeholder="Phone Number" required pattern="^\d{10}$" maxlength="10" />
                <label for="contact-person-1-phone">Phone Number</label>
                <div class="invalid-feedback">Please provide a valid 10-digit phone number.</div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating mb-4">
                <input type="email" class="form-control" id="contact-person-1-email" placeholder="Email" required />
                <label for="contact-person-1-email">Email</label>
                <div class="invalid-feedback">Please provide a valid email address.</div>
              </div>
              <div class="form-floating mb-4">
                <input type="text" class="form-control" id="contact-person-1-location" placeholder="Location" required />
                <label for="contact-person-1-location">Location</label>
                <div class="invalid-feedback">Please provide a location.</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      {{-- Contact Person 2 Section --}}
      <div class="card mb-4">
        <div class="card-header">
          <h6 class="text-primary mb-0">Contact Person 2 Details</h6>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-floating mb-4">
                <input type="text" class="form-control" id="contact-person-2-name" placeholder="Contact Person Name" />
                <label for="contact-person-2-name">Contact Person Name</label>
              </div>
              <div class="form-floating mb-4">
                <input type="tel" class="form-control" id="contact-person-2-phone" placeholder="Phone Number" pattern="^\d{10}$" maxlength="10" />
                <label for="contact-person-2-phone">Phone Number</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating mb-4">
                <input type="email" class="form-control" id="contact-person-2-email" placeholder="Email" />
                <label for="contact-person-2-email">Email</label>
              </div>
              <div class="form-floating mb-4">
                <input type="text" class="form-control" id="contact-person-2-location" placeholder="Location" />
                <label for="contact-person-2-location">Location</label>
              </div>
            </div>
          </div>
        </div>
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  // Uncomment to enable client-side validation
  // $(document).ready(function () {
  //   'use strict';
  //   $('.needs-validation').on('submit', function (event) {
  //     if (!this.checkValidity()) {
  //       event.preventDefault();
  //       event.stopPropagation();
  //     }
  //     $(this).addClass('was-validated');
  //   });
  // });
</script>

@endsection
