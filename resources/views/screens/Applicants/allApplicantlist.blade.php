@extends('layouts/contentNavbarLayout')
@section('title', 'Applicant - Applicant List')

@section('content')


<div class="d-flex justify-content-between align-items-center">
  <div>
    <h4><span class="text-muted fw-light">Home /</span>All Applicant List</h4>
  </div>
  <div class="d-flex justify-content-end">
    <button id="filterBtn" class="btn btn-primary mb-3">
      <i class="mdi mdi-filter-variant me-2"></i> Filter
    </button>
  </div>
</div>

<div id="applicantFormContainer" class="form-container">
  <div class="card">
    <div class="card-header">
      <h5 class="card-title">Applicant Details</h5>
    </div>
    <div class="card-body">
      <form id="applicantForm" novalidate>
        @csrf
        <div class="row">
          <div class="col-md-6">
            <div class="form-floating form-floating-outline mb-4">
              <input type="text" class="form-control" id="experience" placeholder="Experience" required />
              <label for="experience">Experience</label>
              <div class="invalid-feedback">Please provide experience details.</div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-floating form-floating-outline mb-4">
              <input type="text" class="form-control" id="qualifications" placeholder="Qualifications" required />
              <label for="qualifications">Qualifications</label>
              <div class="invalid-feedback">Please provide your qualifications.</div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-floating form-floating-outline mb-4">
              <input type="text" class="form-control" id="preferredLocation" placeholder="Preferred Location"
                required />
              <label for="preferredLocation">Preferred Location</label>
              <div class="invalid-feedback">Please provide your preferred location.</div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-floating form-floating-outline mb-4">
              <select type="text" class="form-control" id="noticePeriod" placeholder="Notice Period" required>
                <option value="">Select Notice Period</option>
                <option value="Immediate">Immediate</option>
                <option value="15 days">15 days</option>
                <option value="1 month">1 month</option>
                <option value="more than 1 month">more than 1 month</option>
              </select>
              <label for="noticePeriod">Notice Period</label>
              <div class="invalid-feedback">Please provide your notice period.</div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-floating form-floating-outline mb-4">
              <input type="text" class="form-control" id="expectedSalary" placeholder="Expected Salary" required />
              <label for="expectedSalary">Expected Salary</label>
              <div class="invalid-feedback">Please provide your expected salary.</div>
            </div>
          </div>
          <div class="col-md-6">
          </div>
          <div class="col-md-6">
            <button type="submit" class="btn btn-primary w-25 mb-3">Filter</button>
          </div>
          <div id="error-message" class="text-danger"></div>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="container-fluid mt-3 px-0">
  <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover shadow-sm text-sm" id="table">
      <thead class="table-dark text-center small">
        <tr class="text-center align-middle">
          <th>Select</th>
          <th>Applicant Name</th>
          <th>Experience</th>
          <th>Contact</th>
          <th>Highest Qualification</th>
          <th>Current Location</th>
          <th>Preferred Location</th>
          <th>Notice Period</th>
          <th>Current Organisation</th>
          <th>Current Salary</th>
          <th>Expected Salary</th>
          <th>Resume</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
  </div>

  <div class="d-flex justify-content-end mt-3">
    <button id="clearForm" class="btn btn-primary" type="button"> Format details </button>
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
        Details formatted successfully

      </div>
      <div class="modal-footer">
        <a href="/formattedapplicantslist" class="btn btnSuc btn-primary">OK</a>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="applicantDetailsModal" tabindex="-1" aria-labelledby="applicantDetailsModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="applicantDetailsModalLabel">Applicant Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-xl">
            <div class="card-body">
              <div class="row">

              </div>
            </div>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<style>
  .form-container {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.5s ease-in-out, opacity 0.3s ease-in-out;
    opacity: 0;
  }

  .form-container.show {
    max-height: 1000px;
    opacity: 1;
  }
</style>
<script>

  // filter open and close start=============
  document.getElementById("filterBtn").addEventListener("click", function () {
    var formContainer = document.getElementById("applicantFormContainer");
    formContainer.classList.toggle("show");
  });
  // filter open and close end============== 



  let selectedApplicants = [];
  var applicantsData;
  var filterApplicantsData;
  $(document).ready(function () {
    fetchApplicants();
  });

  function fetchApplicants() {

    var table = $('#table').DataTable();
    let tableBody = $("#table tbody");
    tableBody.html(`<tr><td colspan="14" class="text-primary">Loading...</td></tr>`); // Show loading message

    $.ajax({
      url: "/api/getapplicant",
      type: "GET",
      dataType: "json",
      success: function (response) {
        console.log(response.data);
        if (response.status === "success") {
          let applicants = response.data.filter((e) => e.Source !== 'sm');
          applicantsData = response.data.filter((e) => e.Source !== 'sm');
          filterApplicantsData = response.data.filter((e) => e.Source !== 'sm');
          tableBody.empty(); // Clear the loading message

          if (applicants.length === 0) {
            tableBody.html(`<tr><td colspan="14" class=" text-danger">No applicants found</td></tr>`);
            return;
          }

          filterApplicantsData.forEach(applicant => {
            let rows = `
                            <tr class="text-center small align-middle">
                                <td><input type="checkbox" class="applicant-checkbox" data-id="${applicant.id}" /></td>
                                <td>${applicant.FirstName} ${applicant.LastName}</td>
                                <td>${applicant.Experience || 'N/A'}</td>
                                <td>${applicant.PhoneNumber || 'N/A'}</td>
                                <td>${applicant.Qualification || 'N/A'}</td>
                                <td>${applicant.CurrentLocation || 'N/A'}</td>
                                <td>${applicant.PreferredLocation || 'N/A'}</td>
                                <td>${applicant.NoticePeriod || 'N/A'}</td>
                                <td>${applicant.CurrentOrganization || 'N/A'}</td>
                                <td>${applicant.CurrentSalary ? applicant.CurrentSalary : 'N/A'}</td>
                                <td>${applicant.ExpectedSalary ? applicant.ExpectedSalary : 'N/A'}</td>
                                <td>
                                    ${applicant.Resume ? `<a href="${applicant.Resume}" target="_blank">View Resume</a>` : 'N/A'}
                                </td>
                                <td class="${applicant.StatusId === "1" ? 'text-warning' : 'text-success'}">
                                    ${applicant.sname}
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary viewApplicantBtn" data-bs-toggle="modal"
                                        data-bs-target="#applicantDetailsModal" data-name="${applicant.FirstName} ${applicant.LastName}"
                                        data-phone="${applicant.PhoneNumber || 'N/A'}"
                                        data-email="${applicant.Email || 'N/A'}"
                                        data-linkedin="${applicant.LinkedIn || '#'}"
                                        data-applying="${applicant.Title || 'N/A'}"
                                        data-qualification="${applicant.Qualification || 'N/A'}"
                                        data-current-location="${applicant.CurrentLocation || 'N/A'}"
                                        data-preferred-location="${applicant.PreferredLocation || 'N/A'}"
                                        data-height="${applicant.Height || 'N/A'}"
                                        data-weight="${applicant.Weight || 'N/A'}"
                                        data-blood="${applicant.BloodGroup || 'N/A'}"
                                        data-hemoglobin="${applicant.Hemoglobin || 'N/A'}"
                                        data-notice="${applicant.NoticePeriod || 'N/A'}"
                                        data-experience="${applicant.Experience || 'N/A'}"
                                        data-current-salary="${applicant.CurrentSalary || 'N/A'}"
                                        data-expected-salary="${applicant.ExpectedSalary || 'N/A'}"
                                        data-organization="${applicant.CurrentOrganization || 'N/A'}"
                                        data-resume="${applicant.Resume || '#'}"
                                        data-certificates="${applicant.Certificates || '#'}"
                                        data-remarks="${applicant.Remarks || 'N/A'}">View</button>
                                  </td>
                            </tr>
                        `;
            tableBody.append(rows);
            table.clear(); // Clear any previous DataTable data
            table.rows.add(tableBody.find('tr')).draw();
          });
        } else {
          tableBody.html(`<tr><td colspan="14" class="text-center text-danger">Failed to fetch applicants</td></tr>`);
        }
      },
      error: function () {
        tableBody.html(`<tr><td colspan="14" class="text-center text-danger">Error fetching data. Try again later.</td></tr>`);
      }
    });
  }

  $(document).on("click", ".viewApplicantBtn", function () {
    let modal = $("#applicantDetailsModal");

    // Fetch data attributes from the clicked button
    let name = $(this).data("name");
    let phone = $(this).data("phone");
    let email = $(this).data("email");
    let linkedin = $(this).data("linkedin");
    let applying = $(this).data("applying");
    let qualification = $(this).data("qualification");
    let currentLocation = $(this).data("current-location");
    let preferredLocation = $(this).data("preferred-location");
    let height = $(this).data("height");
    let weight = $(this).data("weight");
    let blood = $(this).data("blood");
    let hemoglobin = $(this).data("hemoglobin");
    let notice = $(this).data("notice");
    let experience = $(this).data("experience");
    let currentSalary = $(this).data("current-salary");
    let expectedSalary = $(this).data("expected-salary");
    let organization = $(this).data("organization");
    let resume = $(this).data("resume");
    let certificates = $(this).data("certificates");
    let remarks = $(this).data("remarks");

    // Populate modal fields
    modal.find(".modal-body").html(`
            <div class="row">
                <div class="col-md-6"><p><strong>Name:</strong> ${name}</p></div>
                <div class="col-md-6"><p><strong>Phone Number:</strong> ${phone}</p></div>
                <div class="col-md-6"><p><strong>Email:</strong> ${email}</p></div>
                <div class="col-md-6"><p><strong>Portfolio/LinkedIn Profile:</strong> <a href="${linkedin}" target="_blank">${linkedin}</a></p></div>
                <div class="col-md-6"><p><strong>Applying For:</strong> ${applying}</p></div>
                <div class="col-md-6"><p><strong>Highest Qualification:</strong> ${qualification}</p></div>
                <div class="col-md-6"><p><strong>Current Location:</strong> ${currentLocation}</p></div>
                <div class="col-md-6"><p><strong>Preferred Location:</strong> ${preferredLocation}</p></div>
                <div class="col-md-6"><p><strong>Height:</strong> ${height}</p></div>
                <div class="col-md-6"><p><strong>Weight:</strong> ${weight}</p></div>
                <div class="col-md-6"><p><strong>Blood Group:</strong> ${blood}</p></div>
                <div class="col-md-6"><p><strong>Hemoglobin:</strong> ${hemoglobin}</p></div>
                <div class="col-md-6"><p><strong>Notice Period:</strong> ${notice}</p></div>
                <div class="col-md-6"><p><strong>Work Experience:</strong> ${experience}</p></div>
                <div class="col-md-6"><p><strong>Current Salary:</strong> ${currentSalary} </p></div>
                <div class="col-md-6"><p><strong>Expected Salary:</strong> ${expectedSalary} </p></div>
                <div class="col-md-6"><p><strong>Current Organisation:</strong> ${organization}</p></div>
                <div class="col-md-6"><p><strong>Resume:</strong> <a href="${resume}" target="_blank">Download Resume</a></p></div>
                <div class="col-md-6"><p><strong>Certificates:</strong> <a href="${certificates}" target="_blank">Download Certificates</a></p></div>
                <div class="col-md-12"><p><strong>Remarks:</strong> ${remarks}</p></div>
            </div>
        `);
  });

  // $('#clearForm').on('click', function () {
  //   var successModal = new bootstrap.Modal(document.getElementById('successModal'));
  //   successModal.show();
  // });

  $("#clearForm").click(function () {
    const selectedApplicants = $(".applicant-checkbox:checked").map(function () {
      return $(this).data("id");
    }).get();

    if (selectedApplicants.length === 0) {
      $("#successModal .modal-title").text("ERROR");
      $("#successModal .modal-body").text("Please select at least one applicant.");
      $("#successModal .btnSuc").addClass("d-none");
      $("#successModal").modal("show");
      return;
    }

    $("#clearForm").prop('disabled', true).text('Formatting...');

    // Send AJAX request to update status for selected applicants
    let requests = selectedApplicants.map(applicantId => {
      return $.ajax({
        url: `/api/applicantStatusUpdate/${applicantId}`,
        type: 'PUT',
        contentType: 'application/json',
        data: JSON.stringify({ status: 2 }),
      });
    });

    $.when.apply($, requests).done(function () {
      $("#successModal .modal-title").text("Success");
      $("#successModal .modal-body").text("Applicant Formatted Successfully!");
      $("#successModal .btnSuc").addClass('d-block');
      $("#successModal").modal("show"); // Show success modal after completion
      getJob();
      $("#clearForm").prop('disabled', false).text('Format details');
    }).fail(function () {
      $("#successModal .modal-title").text("ERROR");  // Change modal title to ERROR
      $("#successModal .modal-body").text("Error updating applicants. Please try again.");
      $("#successModal .btnSuc").addClass('d-none');  // Hide the "OK" button if there's an error
      $("#successModal").modal("show");
      $("#clearForm").prop('disabled', false).text('Format details');
    });
  });

  $('#emailForm').on('submit', function (e) {
    e.preventDefault();

    var successModal = new bootstrap.Modal(document.getElementById('successModal'));
    successModal.show();
    $('#emailForm')[0].reset();
  });



  $('#applicantForm').on('submit', function (e) {
    e.preventDefault();

    $('#error-message').hide().text("");

    // Retrieve form values
    let experience = $('#experience').val();
    let qualification = $('#qualifications').val();
    let preferredLocation = $('#preferredLocation').val();
    let noticePeriod = $('#noticePeriod').val();
    let expectedSalary = $('#expectedSalary').val();

    if (!experience && !qualification && !preferredLocation && !noticePeriod && !expectedSalary) {
      $('#error-message').text("Fill at least one field to filter.").show();
      return;
    }

    let filteredApplicant = filterApplicantsData.filter(applicant => {
      return (!experience || applicant.Experience == experience) &&
        (!qualification || (applicant.Qualification && applicant.Qualification.toLowerCase() == qualification.toLowerCase())) &&
        (!preferredLocation || (applicant.PreferredLocation && applicant.PreferredLocation.toLowerCase() == preferredLocation.toLowerCase())) &&
        (!noticePeriod || applicant.NoticePeriod == noticePeriod) &&
        (!expectedSalary || parseFloat(applicant.ExpectedSalary) <= parseFloat(expectedSalary));
    });

    console.log(filteredApplicant, 'filterrrrrrr');


    let table = $('#table').DataTable(); // Access DataTable instance
    let tableBody = $("#table tbody");

    if (filteredApplicant.length === 0) {
      // Show no results message
      tableBody.html(`<tr><td colspan="14" class="text-center text-danger">No applicants found</td></tr>`);
      table.clear().draw(); // Clear DataTable if no results
      return;
    }

    // Clear table body and DataTable
    tableBody.empty();
    table.clear();

    // Append filtered rows to the table
    filteredApplicant.forEach(applicant => {
      let row = `
            <tr class="text-center small align-middle">
                <td><input type="checkbox" /></td>
                <td>${applicant.FirstName} ${applicant.LastName}</td>
                <td>${applicant.Experience || 'N/A'}</td>
                <td>${applicant.PhoneNumber || 'N/A'}</td>
                <td>${applicant.Qualification || 'N/A'}</td>
                <td>${applicant.CurrentLocation || 'N/A'}</td>
                <td>${applicant.PreferredLocation || 'N/A'}</td>
                <td>${applicant.NoticePeriod || 'N/A'}</td>
                <td>${applicant.CurrentOrganization || 'N/A'}</td>
                <td>${applicant.CurrentSalary ? applicant.CurrentSalary : 'N/A'}</td>
                <td>${applicant.ExpectedSalary ? applicant.ExpectedSalary : 'N/A'}</td>
                <td>
                    ${applicant.Resume ? `<a href="${applicant.Resume}" target="_blank">View Resume</a>` : 'N/A'}
                </td>
                <td class="${applicant.StatusId === "1" ? 'text-success' : 'text-warning'}">
                    ${applicant.StatusId === "1" ? 'Shortlisted' : 'Pending'}
                </td>
                <td>
                    <button type="button" class="btn btn-primary viewApplicantBtn" data-bs-toggle="modal"
                        data-bs-target="#applicantDetailsModal" data-name="${applicant.FirstName} ${applicant.LastName}"
                        data-phone="${applicant.PhoneNumber || 'N/A'}"
                        data-email="${applicant.Email || 'N/A'}"
                        data-linkedin="${applicant.LinkedIn || '#'}"
                        data-applying="${applicant.ApplyingFor || 'N/A'}"
                        data-qualification="${applicant.Qualification || 'N/A'}"
                        data-current-location="${applicant.CurrentLocation || 'N/A'}"
                        data-preferred-location="${applicant.PreferredLocation || 'N/A'}"
                        data-height="${applicant.Height || 'N/A'}"
                        data-weight="${applicant.Weight || 'N/A'}"
                        data-blood="${applicant.BloodGroup || 'N/A'}"
                        data-hemoglobin="${applicant.Hemoglobin || 'N/A'}"
                        data-notice="${applicant.NoticePeriod || 'N/A'}"
                        data-experience="${applicant.Experience || 'N/A'}"
                        data-current-salary="${applicant.CurrentSalary || 'N/A'}"
                        data-expected-salary="${applicant.ExpectedSalary || 'N/A'}"
                        data-organization="${applicant.CurrentOrganization || 'N/A'}"
                        data-resume="${applicant.Resume || '#'}"
                        data-certificates="${applicant.Certificates || '#'}"
                        data-remarks="${applicant.Remarks || 'N/A'}">View</button>
                  </td>
            </tr>
        `;
      tableBody.append(row);
    });

    // Redraw the DataTable with the new data
    table.rows.add(tableBody.find('tr')).draw();

  });


</script>

@endsection