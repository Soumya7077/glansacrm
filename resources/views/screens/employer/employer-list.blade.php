@extends('layouts/contentNavbarLayout')
@section('title', 'Employer - Employer List')

@section('content')
<h4><span class="text-muted fw-light">Home /</span> Employer List</h4>
<div class="container-fluid mt-3 px-0">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Employer List</h2>
    <button class="btn btn-primary" id="clearForm" type="button" data-bs-toggle="offcanvas"
      data-bs-target="#offcanvasBackdrop" aria-controls="offcanvasBackdrop">+Add Employer</button>
  </div>
  <h4 id="loading-spinner" class="text-primary" style="display:none;">Loading...</h4>
  <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover shadow-sm text-sm" id="table">
      <thead class="table-dark text-center small">
        <tr>
          <th>Sr No</th>
          <th>Organisation Name</th>
          <th>Contact Person Name</th>
          <th>Phone Number</th>
          <th>Email</th>
          <th>Location</th>
          <th>Remarks</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="empList">
        <td>1</td>
        <td>Appolo</td>
        <td>Soumya</td>
        <td>1234567890</td>
        <td>abc@appolo.com</td>
        <td>Delhi</td>
        <td></td>
        <td class="d-flex justify-content-between">
          <button class="btn btn-sm btn-primary edit-btn" type="submit" data-bs-toggle="off
        canvas" data-bs-target="#offcanvasBackdrop" aria-controls="offcanvasBackdrop">Edit</ button>
            <button class="btn btn-sm btn-danger delete-btn" type="submit" data-bs-toggle="off
        canvas" data-bs-target="#offcanvasBackdrop" aria-controls="offcanvasBackdrop">Delete</ button>
        </td>

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
      <h4 id="edit-loading" class="text-primary" style="display: none; padding:0px 25px;">Loading...</h4>
      <div class="offcanvas-body mx-0 flex-grow-0">
        <form id="employerForm" class="needs-validation" novalidate>
          <div class="row">
            <div class="col-md-12">
              <div class="form-floating form-floating-outline mb-4">
                <input type="text" class="form-control" id="organisation-name" placeholder="Organisation Name"
                  required />
                <label for="organisation-name">Organisation Name</label>
                <div class="invalid-feedback">Please provide the organisation name.</div>
              </div>
              <div class="form-floating form-floating-outline mb-4">
                <input type="text" class="form-control" id="contact-person-name" placeholder="Contact Person Name"
                  required />
                <label for="contact-person-name">Contact Person</label>
                <div class="invalid-feedback">Please provide the contact person name.</div>
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
              <div class="form-floating form-floating-outline mb-4">
                <textarea type="text" class="form-control" id="remarks" placeholder="Remarks"></textarea>
                <label for="remarks">Remarks</label>
                <!-- <div class="invalid-feedback">Please provide a location.</div> -->
              </div>
            </div>
          </div>
          <button type="submit" id="formSubmitButton" class="btn btn-primary mb-2 d-grid w-100">Add</button>
          <button type="button" id="clearFormCancel" class="btn btn-outline-secondary d-grid w-100">Cancel</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  // $(document).ready(function () {
  //   var table = $('#table').DataTable();

  //   function fetchEmployers() {
  //     $('#loading-spinner').show(); // Show the loading spinner
  //     $.ajax({
  //       url: '/api/getEmployer', // API endpoint
  //       type: 'GET', // HTTP method
  //       dataType: 'json', // Expected data type
  //       success: function (response) {
  //         $('#loading-spinner').hide(); // Hide the loading spinner
  //         $('#empList').empty();
  //         if (response && response.status === 'success' && response.data?.length > 0) {
  //           console.log(response, 'emppppppppppppp');

  //           const tableBody = $('#empList');
  //           response.data.forEach((employer, index) => {
  //             const row = `
  //               <tr>
  //                 <td class="text-center">${index + 1}</td>
  //                 <td>${employer.Name || 'N/A'}</td>
  //                 <td>${employer.Phone || 'N/A'}</td>
  //                 <td>${employer.Email || 'N/A'}</td>
  //                 <td>${employer.Location || 'N/A'}</td>
  //                 <td class="text-center">
  //                   <div class="d-inline-flex gap-2">
  //                     <button class="btn btn-xs btn-info edit-btn" data-id="${employer.id}">Edit</button>
  //                     <button class="btn btn-xs btn-danger delete-btn" data-id="${employer.id}">Delete</button>
  //                   </div>
  //                 </td>
  //               </tr>`;
  //             tableBody.append(row);
  //           });
  //           table.clear().rows.add(tableBody.find('tr')).draw();
  //         } else {
  //           $('#empList').append(`
  //             <tr>
  //               <td colspan="6" class="text-center">No employers found.</td>
  //             </tr>`);
  //         }
  //       },
  //       error: function () {
  //         $('#loading-spinner').hide(); // Hide the loading spinner
  //         alert('Failed to fetch employer data. Please try again later.');
  //       },
  //     });
  //   }

  //   // Fetch data on page load
  //   fetchEmployers();

  //   // Form Submission Logic
  //   let isEdit = false;
  //   let editEmployerId = null;

  //   $('#employerForm').on('submit', function (event) {
  //     $('#edit-loading').show(); // Show loading spinner for form submission
  //     event.preventDefault();
  //     const form = this;

  //     if (!form.checkValidity()) {
  //       event.stopPropagation();
  //       $(form).addClass('was-validated');
  //       return;
  //     }

  //     const formData = {
  //       name: $('#organisation-name').val().trim(),
  //       phone: $('#phone-number').val().trim(),
  //       email: $('#email').val().trim(),
  //       location: $('#location').val().trim(),
  //     };

  //     const ajaxOptions = isEdit
  //       ? { url: `/api/updateEmployer/${editEmployerId}`, type: 'PUT' }
  //       : { url: '/api/createEmployer', type: 'POST' };

  //     $.ajax({
  //       ...ajaxOptions,
  //       contentType: 'application/json',
  //       data: JSON.stringify(formData),
  //       success: function (response) {
  //         $('#edit-loading').hide(); // Hide the loading spinner
  //         alert(response.message);
  //         form.reset();
  //         $(form).removeClass('was-validated');
  //         $('#offcanvasBackdrop').offcanvas('hide');
  //         fetchEmployers();
  //         resetFormState();
  //       },
  //       error: function (xhr) {
  //         $('#edit-loading').hide(); // Hide the loading spinner
  //         alert(xhr.responseJSON?.message || 'An error occurred. Please try again.');
  //       },
  //     });
  //   });

  //   // Reset form state
  //   function resetFormState() {
  //     isEdit = false;
  //     editEmployerId = null;
  //     $('#offcanvasBackdropLabel').text('Add Employer');
  //     $('#formSubmitButton').text('Add');
  //   }

  //   $('#clearForm').on('click', function () {
  //     $('#employerForm')[0].reset();
  //     $('#employerForm').find('.is-invalid').removeClass('is-invalid');
  //   });

  //   $('#clearFormCancel').on('click', function () {
  //     $('#employerForm')[0].reset();
  //     $('#employerForm').find('.is-invalid').removeClass('is-invalid');
  //   });

  //   // Handle Edit Button
  $(document).on('click', '.edit-btn', function () {
    editEmployerId = $(this).data('id');
    isEdit = true;
    $('#offcanvasBackdrop').offcanvas('show');
    $('#edit-loading').show(); // Show loading spinner while fetching employer details
    // $.ajax({
    //   url: `/api/getEmployer/${editEmployerId}`,
    //   type: 'GET',
    //   success: function (response) {
    //     $('#edit-loading').hide(); // Hide loading spinner
    //     const employer = response.data;
    //     $('#organisation-name').val(employer.Name);
    //     $('#phone-number').val(employer.Phone);
    //     $('#email').val(employer.Email);
    //     $('#location').val(employer.Location);
    //     $('#offcanvasBackdropLabel').text('Edit Employer');
    //     $('#formSubmitButton').text('Update');
    //   },
    //   error: function () {
    //     $('#edit-loading').hide(); // Hide loading spinner
    //     alert('Failed to fetch employer details.');
    //   },
    // });
  });

  //   // Handle Delete Button
  $(document).on('click', '.delete-btn', function () {
    const employerId = $(this).data('id');
    if (confirm('Are you sure you want to delete this employer?')) {
      $.ajax({
        url: `/api/deleteEmployer/${employerId}`,
        type: 'DELETE',
        success: function () {
          alert('Employer deleted successfully.');
          fetchEmployers();
        },
        error: function () {
          alert('Failed to delete employer. Please try again.');
        },
      });
    }
  });
  // });
</script>
@endsection