@extends('layouts/contentNavbarLayout')
@section('title', 'Jobs - Job Post')

@section('content')
<h4><span class="text-muted fw-light">Home /</span> Job Post</h4>

<div class="card mb-4">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Job Post</h5>
    <small class="text-muted float-end">Fill in the details for the job post</small>
  </div>
  <div class="card-body">
    <form id="jobPostForm" novalidate method="POST" action="{{ url('/joblist') }}">
      <div class="row">
        <div class="col-md-6">
          <div class="form-floating form-floating-outline mb-4">
            <!-- <select class="form-control" id="organisation-name" name="EmployerId" required>
              <option value="" hidden>Select Organisation</option>
              <option value="">Select 1</option>
              <option value="">Select 2</option>
            </select> -->

            <select class="form-control" id="organisation-name" name="EmployerId" required>
              <option value="" hidden>Select Organisation</option>
            </select>

            <label for="organisation-name">Organisation Name</label>
            <div class="invalid-feedback">Please select an organisation.</div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-floating form-floating-outline mb-4">
            <input type="text" class="form-control" id="job-title" name="Title" placeholder="Job Title" required
              minlength="3" />
            <label for="job-title">Job Title</label>
            <div class="invalid-feedback">Please enter a valid job title (at least 3 characters).</div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-floating form-floating-outline mb-4">
            <textarea id="job-description" class="form-control" name="Description" placeholder="Job Description"
              required minlength="10"></textarea>
            <label for="job-description">Description</label>
            <div class="invalid-feedback">Please enter a job description (at least 10 characters).</div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-floating form-floating-outline mb-4">
            <input type="number" class="form-control" id="openings" name="Opening" placeholder="Number of Openings"
              required min="1" />
            <label for="openings">Number of Openings</label>
            <div class="invalid-feedback">Please enter the number of openings (minimum 1).</div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-floating form-floating-outline mb-4">
            <select class="form-control" id="shift" name="Shift" required>
              <option value="" hidden>Job's Location</option>
              <option value="Day">Remote</option>
              <option value="Night">On-site</option>
            </select>
            <label for="shift">Job's Location</label>
            <div class="invalid-feedback">Please select a Job's Location.</div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-floating form-floating-outline mb-4">
            <input type="text" class="form-control" id="education" name="Education" placeholder="Education Requirement"
              required minlength="3" />
            <label for="education">Education</label>
            <div class="invalid-feedback">Please enter the education requirement (at least 3
              characters).
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-floating form-floating-outline mb-4">
            <input type="text" class="form-control" id="key-skills" name="KeySkills" placeholder="Key Skills" required
              minlength="3" />
            <label for="key-skills">Key Skills</label>
            <div class="invalid-feedback">Please enter the key skills (at least 3 characters).</div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-floating form-floating-outline mb-4">
            <select class="form-control" id="department" name="department" required>
              <option value="" hidden>Department</option>
              <option value="department">Department</option>
            </select>
            <label for="department">Department</label>
            <div class="invalid-feedback">Please select a Department.</div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-floating form-floating-outline mb-4">
            <input type="text" class="form-control" id="salary" name="Salary" placeholder="Salary" required
              pattern="^[0-9]+(\.[0-9]{1,2})?$" />
            <label for="salary">Minimum Salary</label>
            <div class="invalid-feedback">Please enter a valid salary (e.g., 50000 or 50000.50).</div>
          </div>
        </div>
        <div class="col-md-6 d-flex">
          <div class="form-floating form-floating-outline mb-4 w-75">
            <input type="text" class="form-control" id="salary" name="Salary" placeholder="Salary" required
              pattern="^[0-9]+(\.[0-9]{1,2})?$" />
            <label for="salary">Maximum Salary</label>
            <div class="invalid-feedback">Please enter a valid salary (e.g., 50000 or 50000.50).</div>
          </div>
          <div class="form-floating form-floating-outline mb-4 w-25">
            <select class="form-control" id="month" name="month" required>
              <option value="month">Per Month</option>
              <option value="year">Per Year</option>
            </select>
            <div class="invalid-feedback">Please select this field.</div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-floating form-floating-outline mb-4">
            <select class="form-control" id="employmenttype" name="employmenttype" required>
              <option value="" hidden>Employment Type</option>
              <option value="Full-Time">Full-Time</option>
              <option value="Part-Time">Part-Time</option>
              <option value="Contract">Contract</option>
            </select>
            <label for="employmenttype">Employment Type</label>
            <div class="invalid-feedback">Please select the Employment Type.</div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-floating form-floating-outline mb-4">
            <input type="text" class="form-control" id="Timeline" name="Timeline" placeholder="Timeline" required
              minlength="3" />
            <label for="Timeline">Timeline</label>
            <div class="invalid-feedback">Please enter the Timeline.</div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-floating form-floating-outline mb-4">
            <input type="text" class="form-control" id="job-location" name="Location" placeholder="Job Location"
              required minlength="3" />
            <label for="job-location">Location</label>
            <div class="invalid-feedback">Please enter the job location (at least 3 characters).</div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-floating form-floating-outline mb-4">
            <select class="form-control" id="shift" name="Shift" required>
              <option value="" hidden>Select Shift</option>
              <option value="Day">General Shift</option>
              <option value="Night">12 hours</option>
              <option value="">24 hours</option>
            </select>
            <label for="shift">Shift</label>
            <div class="invalid-feedback">Please select the shift.</div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-floating form-floating-outline mb-4">
            <select class="form-control" id="Benefits" name="Benefits" required>
              <option value="" hidden>Benefits</option>
              <option value="Health-Insurance">Health Insurance</option>
              <option value="Parental-Leave">Parental Leave</option>
            </select>
            <label for="Benefits">Benefits</label>
            <div class="invalid-feedback">Please select the Benefits.</div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-floating form-floating-outline mb-4">
            <select class="form-control" id="Gender" name="Gender">
              <option value="" hidden>Gender</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
            <label for="Gender">Gender</label>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-floating form-floating-outline mb-4">
            <input type="text" class="form-control" id="Remarks" name="Remarks" placeholder="Remarks" required />
            <label for="Remarks">Remarks</label>
            <div class="invalid-feedback">Please enter the Remarks</div>
          </div>
        </div>
        <div class="col-md-6">

        </div>
      </div>

      <button type="submit" class="btn btn-primary">Post Job</button>
    </form>
  </div>
</div>


<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="successModalLabel">Success</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        The Job Post has been successfully created!
      </div>
      <div class="modal-footer">
        <a href="/joblist" class="btn btn-primary">OK</a>
      </div>
    </div>
  </div>
</div>

<!-- Delete Success Modal -->
<div class="modal fade" id="deleteSuccessModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteSuccessModalLabel">Delete Successful</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        The item has been successfully deleted!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

<!-- Delete Error Modal -->
<div class="modal fade" id="deleteErrorModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteErrorModalLabel">Error</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Something went wrong. The item could not be deleted.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<script>
  function fetchEmployers() {
    $.ajax({
      url: '/api/getEmployer',
      type: 'GET',
      dataType: 'json',
      success: function (response) {
        const selectElement = $('#organisation-name');
        selectElement.empty();
        selectElement.append('<option value="" hidden>Select Organisation</option>');

        if (response && response.status === 'success' && response.data?.length > 0) {
          response.data.forEach((employer) => {
            selectElement.append(`<option value="${employer.id}">${employer.OrganizationName}</option>`);
          });
        } else {
          selectElement.append('<option value="">No employers found</option>');
        }
      },
      error: function () {
        $('#deleteErrorModal').modal('show');
      }
    });
  }
  fetchEmployers();


  $(document).ready(function () {
    $('#jobPostForm').on('submit', function (e) {
      e.preventDefault();

      var isValid = true;

      $('#jobPostForm .form-control').each(function () {
        if (!this.checkValidity()) {
          $(this).addClass('is-invalid');
          isValid = false;
        } else {
          $(this).removeClass('is-invalid');
        }
      });

      if (isValid) {
        $.ajax({
          url: '/api/createJob',
          type: 'POST',
          data: $('#jobPostForm').serialize(),
          success: function (response) {
            $('#successModal').modal('show');
            console.log('Job posted successfully:', response);
          },
          error: function (xhr, status, error) {
            $('#deleteErrorModal').modal('show');
            console.error('Error:', error);
          }
        });
      }
    });

    $('#jobPostForm .form-control').on('input change', function () {
      if (this.checkValidity()) {
        $(this).removeClass('is-invalid');
      }
    });
  });
</script>




@endsection