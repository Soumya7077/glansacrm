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
          <th>1st Contact Person Name</th>
          <th>Phone Number</th>
          <th>Email</th>
          <th>Location</th>
          <th>Degisnation</th>
          <th>2nd Contact Person Name</th>
          <th>Phone Number</th>
          <th>Email</th>
          <th>Location</th>
          <th>Degisnation</th>
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
        <form class="needs-validation" novalidate>
          {{-- Organization Details --}}
          <div class="card mb-4">
            <div class="card-header">
              <h6 class="text-primary mb-0">Organization Details</h6>
            </div>
            <div class="card-body">
              <div class="form-floating mb-4">
                <input type="text" class="form-control" id="organization-name" placeholder="Organization Name" required />
                <label for="organization-name">Organization Name</label>
                <div class="invalid-feedback">Please provide the organization name.</div>
              </div>
            </div>
          </div>

          {{-- Contact Person 1 Section --}}
          <div class="card mb-4">
            <div class="card-header">
              <h6 class="text-primary mb-0">Contact Person 1 Details</h6>
            </div>
            <div class="card-body">
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
              <div class="form-floating mb-4">
                <input type="text" class="form-control" id="contact-person-1-Designation" placeholder="Designation" required />
                <label for="contact-person-1-location">Designation</label>
                <div class="invalid-feedback">Please provide a Designation.</div>
              </div>
            </div>
          </div>

          {{-- Contact Person 2 Section --}}
          <div class="card mb-4">
            <div class="card-header">
              <h6 class="text-primary mb-0">Contact Person 2 Details</h6>
            </div>
            <div class="card-body">
              <div class="form-floating mb-4">
                <input type="text" class="form-control" id="contact-person-2-name" placeholder="Contact Person Name" />
                <label for="contact-person-2-name">Contact Person Name</label>
              </div>
              <div class="form-floating mb-4">
                <input type="tel" class="form-control" id="contact-person-2-phone" placeholder="Phone Number" pattern="^\d{10}$" maxlength="10" />
                <label for="contact-person-2-phone">Phone Number</label>
              </div>
              <div class="form-floating mb-4">
                <input type="email" class="form-control" id="contact-person-2-email" placeholder="Email" />
                <label for="contact-person-2-email">Email</label>
              </div>
              <div class="form-floating mb-4">
                <input type="text" class="form-control" id="contact-person-2-location" placeholder="Location" />
                <label for="contact-person-2-location">Location</label>
              </div>
              <div class="form-floating mb-4">
                <input type="text" class="form-control" id="contact-person-1-Designation" placeholder="Designation" required />
                <label for="contact-person-1-location">Designation</label>
                <div class="invalid-feedback">Please provide a Designation.</div>
              </div>
            </div>
          </div>

          <button type="submit" class="btn btn-primary">Submit</button>
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
