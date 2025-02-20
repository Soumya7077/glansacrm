@extends('layouts/contentNavbarLayout')

@section('title', 'Social Media Form')

@section('content')
<div class="col-xxl">
  <div class="card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">Social Media Form</h5>
    </div>
    <div class="card-body">
      <form id="socialMediaForm" novalidate>
        <div class="row">
          <div class="col-md-6">
            <div class="form-floating form-floating-outline mb-4">
              <input type="text" class="form-control capitalized" id="applicantFirstName" name="FirstName"
                placeholder="First Name" required />
              <label for="applicantFirstName">Applicant First Name <span style="color: red;">*</span></label>
              <div class="invalid-feedback">Please enter the applicant's first name.</div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-floating form-floating-outline mb-4">
              <input type="text" class="form-control capitalized" id="applicantLastName" name="LastName"
                placeholder="Last Name" required />
              <label for="applicantLastName">Applicant Last Name <span style="color: red;">*</span></label>
              <div class="invalid-feedback">Please enter the applicant's last name.</div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-floating form-floating-outline mb-4">
              <input type="tel" maxlength="10" class="form-control" id="phoneNumber" name="phone"
                placeholder="Phone Number" pattern="^[6-9]\d{9}$" required />
              <label for="phoneNumber">Phone Number <span style="color: red;">*</span></label>
              <div class="invalid-feedback">Please enter a valid 10-digit phone number starting with 6, 7, 8, or 9.
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-floating form-floating-outline mb-4">
              <input type="email" id="email" name="email" class="form-control" placeholder="Email" required />
              <label for="email">Email <span style="color: red;">*</span></label>
              <div class="invalid-feedback">Please enter a valid email address.</div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-floating form-floating-outline mb-4">
              <select id="applying" name="Source" class="form-select" required>
                <option value="sm">Facebook</option>
                <option value="sm">Instagram</option>
                <option value="sm">Linkedin</option>
                <option value="sm">X</option>
                <option value="sm">Others</option>
              </select>
              <label for="applying">Source <span style="color: gray;">(optional)</span></label>
              <div class="invalid-feedback">Please select a valid source.</div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-floating form-floating-outline mb-4">
              <input type="text" id="remark" name="Remarks" class="form-control capitalized" placeholder="Remark" />
              <label for="remark">Remark <span style="color: gray;">(optional)</span></label>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="text-start">
              <button type="submit" id="submitBtn" class="btn btn-primary">Submit</button>
            </div>
          </div>
          <div class="col-md-6">
          </div>
        </div>
      </form>
    </div>
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
        The social media form has been successfully submitted!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

<!-- Error Modal -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="errorModalLabel">Error</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p id="errorMessage"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function () {


    let inputs = document.getElementsByClassName("capitalized");

    for (let input of inputs) {
      input.addEventListener("input", function () {
        this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1);
      });
    }

    $('#socialMediaForm').on('submit', function (e) {
      e.preventDefault();
      let submitBtn = $('#submitBtn');
      const form = this;
      if (!form.checkValidity()) {
        $(form).addClass('was-validated');
        return;
      }
      submitBtn.prop('disabled', true).text('Submitting...');

      $.ajax({
        url: '/api/applicant',
        method: 'POST',
        data: $(this).serialize(),
        success: function () {
          $('#successModal').modal('show');
          form.reset(); // Reset the form
          $(form).removeClass('was-validated');
        },
        error: function (xhr) {
          $('#errorMessage').text(xhr.responseJSON.message);
          $('#errorModal').modal('show');
        },
        complete: function () {
          // Re-enable button and restore text
          submitBtn.prop('disabled', false).text('Submit');
        }
      });
    });

    $('#phoneNumber').on('input', function () {
      const phoneRegex = /^[6-9]\d{9}$/;
      if (phoneRegex.test($(this).val())) {
        $(this).removeClass('is-invalid').addClass('is-valid');
      } else {
        $(this).removeClass('is-valid').addClass('is-invalid');
      }
    });
    function validateNameInput(input) {
      const nameRegex = /^[A-Za-z]+$/;
      if (nameRegex.test($(input).val())) {
        $(input).removeClass('is-invalid').addClass('is-valid');
        $(input).siblings('.invalid-feedback').text('');
      } else {
        $(input).removeClass('is-valid').addClass('is-invalid');
        $(input).siblings('.invalid-feedback').text('This field only accepts letters. Numbers and special characters are not allowed.');
      }
    }

    $('#applicantFirstName, #applicantLastName').on('input', function () {
      validateNameInput(this);
    });

  });

</script>

@endsection