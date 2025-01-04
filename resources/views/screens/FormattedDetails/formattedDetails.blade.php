@extends('layouts/contentNavbarLayout')

@section('title', 'Social Media Form')

@section('content')

<div class="col-xxl">
  <div class="card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">Formatted Details</h5>
    </div>
    <div class="card-body">
      <a id="applicationForm" class="needs-validation" novalidate>
        <div class="row">
          <div class="col-md-6">
            <div class="form-floating form-floating-outline mb-4">
              <input type="text" class="form-control" id="applicantName" placeholder="Name" required />
              <label for="applicantName">Applicant Name</label>
              <div class="invalid-feedback">Please enter the applicant's name.</div>
            </div>
            <div class="form-floating form-floating-outline mb-4">
              <input type="text" class="form-control" id="jobApplied" placeholder="Job Applied" required />
              <label for="jobApplied">Job Applied</label>
              <div class="invalid-feedback">Please enter the job applied for.</div>
            </div>
            <div class="mb-4">
              <div class="input-group input-group-merge">
                <div class="form-floating form-floating-outline">
                  <input type="text" class="form-control" id="keySkills" placeholder="Key Skills" required />
                  <label for="keySkills">Key Skills</label>
                  <div class="invalid-feedback">Please enter the key skills.</div>
                </div>
              </div>
            </div>
            <div class="form-floating form-floating-outline mb-4">
              <input type="number" class="form-control" id="workExperience" placeholder="Work Experience" required />
              <label for="workExperience">Work Experience</label>
              <div class="invalid-feedback">Please enter the work experience.</div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-floating form-floating-outline mb-4">
              <input type="number" class="form-control" id="currentSalary" placeholder="Current Salary" required />
              <label for="currentSalary">Current Salary</label>
              <div class="invalid-feedback">Please enter the current salary.</div>
            </div>
            <div class="form-floating form-floating-outline mb-4">
              <input type="number" class="form-control" id="expectedSalary" placeholder="Expected Salary" required />
              <label for="expectedSalary">Expected Salary</label>
              <div class="invalid-feedback">Please enter the expected salary.</div>
            </div>
            <div class="form-floating form-floating-outline mb-4">
              <input type="text" class="form-control" id="highestQualification" placeholder="Highest Qualification"
                required />
              <label for="highestQualification">Highest Qualification</label>
              <div class="invalid-feedback">Please enter the highest qualification.</div>
            </div>
            <div class="form-floating form-floating-outline mb-4">
              <input type="text" class="form-control" id="highestQualification" placeholder="Notice Period" required />
              <label for="highestQualification">Notice Period</label>
              <div class="invalid-feedback">Please enter the highest qualification.</div>
            </div>
          </div>
        </div>
        <!-- <button type="submit" class="btn btn-primary">Add</button> -->
        <a href="formattedapplicantslist" class="btn btn-primary">Add</a>
        </form>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function () {
    $('#applicationForm').on('submit', function (event) {
      let isValid = true;

      const applicantName = $('#applicantName');
      if (applicantName.val().trim() === '') {
        applicantName.addClass('is-invalid');
        isValid = false;
      } else {
        applicantName.removeClass('is-invalid').addClass('is-valid');
      }

      const jobApplied = $('#jobApplied');
      if (jobApplied.val().trim() === '') {
        jobApplied.addClass('is-invalid');
        isValid = false;
      } else {
        jobApplied.removeClass('is-invalid').addClass('is-valid');
      }

      const keySkills = $('#keySkills');
      if (keySkills.val().trim() === '') {
        keySkills.addClass('is-invalid');
        isValid = false;
      } else {
        keySkills.removeClass('is-invalid').addClass('is-valid');
      }

      const workExperience = $('#workExperience');
      if (workExperience.val().trim() === '' || workExperience.val() < 0) {
        workExperience.addClass('is-invalid');
        isValid = false;
      } else {
        workExperience.removeClass('is-invalid').addClass('is-valid');
      }

      const currentSalary = $('#currentSalary');
      if (currentSalary.val().trim() === '' || currentSalary.val() < 0) {
        currentSalary.addClass('is-invalid');
        isValid = false;
      } else {
        currentSalary.removeClass('is-invalid').addClass('is-valid');
      }

      const expectedSalary = $('#expectedSalary');
      if (expectedSalary.val().trim() === '' || expectedSalary.val() < 0) {
        expectedSalary.addClass('is-invalid');
        isValid = false;
      } else {
        expectedSalary.removeClass('is-invalid').addClass('is-valid');
      }

      const highestQualification = $('#highestQualification');
      if (highestQualification.val().trim() === '') {
        highestQualification.addClass('is-invalid');
        isValid = false;
      } else {
        highestQualification.removeClass('is-invalid').addClass('is-valid');
      }

      if (!isValid) {
        event.preventDefault();
        event.stopPropagation();
      }
    });

    $('#applicationForm input').on('input', function () {
      const input = $(this);
      if (input.val().trim() === '' || (input.attr('type') === 'number' && input.val() < 0)) {
        input.addClass('is-invalid').removeClass('is-valid');
      } else {
        input.removeClass('is-invalid').addClass('is-valid');
      }
    });
  });
</script>

@endsection