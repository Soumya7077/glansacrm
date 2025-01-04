@extends('layouts/contentNavbarLayout')
@section('title', 'Documents - documents')

@section('content')

<div class="card mb-4">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Schedule Interview</h5>
  </div>
  <div class="card-body">
    <form id="emailForm" class="needs-validation" novalidate>
      <div class="row">
        <div class="col-md-6">
          <div class="form-floating form-floating-outline mb-4">
            <input type="text" class="form-control" name="" id=""
              value="naveen@glansa.in, soumya@glansa.in, anita@glansa.in">
            <label for="to">To</label>
            <div class="invalid-feedback">Please select an email address.</div>
          </div>
          <div class="form-floating form-floating-outline mb-4">
            <input type="date" class="form-control" id="interviewDate" name="interviewDate" placeholder="Interview Date"
              required />
            <label for="interviewDate">Interview Date</label>
            <div class="invalid-feedback">Please choose a valid interview date.</div>
          </div>
          <div class="form-floating form-floating-outline mb-4">
            <input type="time" class="form-control" id="interviewDate" name="interviewDate" placeholder="Interview Date"
              required />
            <label for="interviewDate">Select 1st time slot</label>
            <div class="invalid-feedback">Please choose a valid interview time.</div>
          </div>
          <div class="form-floating form-floating-outline mb-4">
            <input type="time" class="form-control" id="interviewDate" name="interviewDate" placeholder="Interview Date"
              required />
            <label for="interviewDate">Select 3rd time slot</label>
            <div class="invalid-feedback">Please choose a valid interview time.</div>
          </div>
          <div class="form-floating form-floating-outline mb-4">
            <select name="" id="" class="form-select">
              <option value="">Virtual</option>
              <option value="">Walk-in</option>
            </select>
            <label for="interviewDate">Select mode of interview</label>
            <div class="invalid-feedback">Please choose a valid interview time.</div>
          </div>

        </div>

        <div class="col-md-6">
          <div class="form-floating form-floating-outline mb-4">
            <input type="text" name="" id="" class="form-control">
            <label for="description">CC</label>
            <div class="invalid-feedback">Please provide a description.</div>
          </div>
          <div class="form-floating form-floating-outline mb-4">
            <textarea id="description" name="description" class="form-control" placeholder="Subject Description"
              style="height: 122px;" required></textarea>
            <label for="description">Interview Description</label>
            <div class="invalid-feedback">Please provide a description.</div>
          </div>
          <div class="form-floating form-floating-outline mb-4">
            <input type="time" class="form-control" id="interviewDate" name="interviewDate" placeholder="Interview Date"
              required />
            <label for="interviewDate">Select 2nd time slot</label>
            <div class="invalid-feedback">Please choose a valid interview time.</div>
          </div>
          <div class="form-floating form-floating-outline mb-4">
            <input type="text" class="form-control" id="interviewDate" name="interviewDate"
              placeholder="Location / Virtual Link" required />
            <label for="interviewDate">Location / Virtual Link</label>
            <div class="invalid-feedback">Please choose a valid interview time.</div>
          </div>
        </div>
      </div>

      <!-- Table with Applicant Details inside the Form -->
      <!-- <div class="table-responsive mt-2">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Applicant Name</th>
              <th>Key Skills</th>
              <th>Job Description</th>
              <th>Experience</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Naveen Nagam</td>
              <td>JavaScript, React, Node.js</td>
              <td>Frontend Developer</td>
              <td>3 Years</td>
            </tr>
            <tr>
              <td>Anita Seth</td>
              <td>Python, Django, REST APIs</td>
              <td>Backend Developer</td>
              <td>4 Years</td>
            </tr>


          </tbody>
        </table>
      </div> -->

      <a href="applicantlist" class="btn btn-primary mt-3">Send Mail</a>
    </form>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function () {
    $('#emailForm').on('submit', function (event) {
      if (this.checkValidity() === false) {
        event.preventDefault(); // Prevent form submission
        event.stopPropagation(); // Stop event propagation
      }
      $(this).addClass('was-validated');
    });
  });
</script>

@endsection
