@extends('layouts/contentNavbarLayout')
@section('title', 'Employer - Employer List')

@section('content')
<h4><span class="text-muted fw-light">Home /</span> Employer List</h4>
<div class="container-fluid mt-3 px-0">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Employer List</h2>
    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBackdrop"
      aria-controls="offcanvasBackdrop"> Add Employer</button>
  </div>
  <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover shadow-sm text-sm" id="table">
      <thead class="table-dark text-center small">
        <tr>
          <th>Sr No</th>
          <th>Organisation Name</th>
          <th>Phone Number</th>
          <th>Email</th>
          <th>Location</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="empList">

      </tbody>
    </table>
  </div>
</div>

<div class="col-lg-4 col-md-6">
  <div class="mt-3">
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasBackdrop" aria-labelledby="offcanvasBackdropLabel">
      <div class="offcanvas-header">
        <h5 id="offcanvasBackdropLabel" class="offcanvas-title">Add Employer</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <hr>
      <div class="offcanvas-body mx-0 flex-grow-0">
        <form id="employerForm" class="needs-validation" novalidate>
          <div class="row">
            <div class="col-md-12">
              <div class="form-floating form-floating-outline mb-4">
                <input type="text" class="form-control" id="organisation-name" placeholder="Organisation Name" required />
                <label for="organisation-name">Organisation Name</label>
                <div class="invalid-feedback">Please provide the organisation name.</div>
              </div>
              <div class="form-floating form-floating-outline mb-4">
                <input type="tel" class="form-control" id="phone-number" placeholder="Phone Number" required
                  pattern="^\d{10}$" maxlength="10" />
                <label for="phone-number">Phone Number</label>
                <div class="invalid-feedback">Please provide a valid 10-digit phone number.</div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-floating form-floating-outline mb-4">
                <input type="email" class="form-control" id="email" placeholder="Email" required />
                <label for="email">Email</label>
                <div class="invalid-feedback">Please provide a valid email address.</div>
              </div>
              <div class="form-floating form-floating-outline mb-4">
                <input type="text" class="form-control" id="location" placeholder="Location" required />
                <label for="location">Location</label>
                <div class="invalid-feedback">Please provide a location.</div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary mb-2 d-grid w-100">Add</button>
          <button type="button" class="btn btn-outline-secondary d-grid w-100" data-bs-dismiss="offcanvas">Cancel</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function () {
    'use strict';

    $('#employerForm').on('submit', function (event) {
      event.preventDefault(); // Prevent default submission
      const form = this;

      if (!form.checkValidity()) {
        event.stopPropagation();
        $(form).addClass('was-validated');
        return; // Stop further execution if invalid
      }

      alert('Employer added successfully!');
      form.reset(); // Reset the form
      $(form).removeClass('was-validated'); // Remove validation classes
      $('#offcanvasBackdrop').offcanvas('hide'); // Close the offcanvas
    });

    $('#organisation-name').on('input', function () {
      const input = $(this);
      validateField(input, input.val().trim() !== '');
    });

    $('#phone-number').on('input', function () {
      const input = $(this);
      const phoneRegex = /^\d{10}$/;
      validateField(input, phoneRegex.test(input.val().trim()));
    });

    $('#email').on('input', function () {
      const input = $(this);
      const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
      validateField(input, emailRegex.test(input.val().trim()));
    });

    $('#location').on('input', function () {
      const input = $(this);
      validateField(input, input.val().trim() !== '');
    });

    function validateField(input, isValid) {
      if (isValid) {
        input.addClass('is-valid').removeClass('is-invalid');
      } else {
        input.addClass('is-invalid').removeClass('is-valid');
      }
    }
  });
</script>

@endsection
