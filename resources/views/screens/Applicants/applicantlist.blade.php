@extends('layouts/contentNavbarLayout')
@section('title', 'Applicant - Applicant List')

@section('content')
<h4><span class="text-muted fw-light">Home /</span> Applicant List</h4>

<div class="offcanvas-body mx-0 flex-grow-0">
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
              <input type="text" class="form-control" id="noticePeriod" placeholder="Notice Period" required />
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
            <button type="submit" class="btn btn-primary w-25 mb-3">Filter</button>
          </div>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- Loader -->
<div class="text-center mt-3" id="loading" style="display: none;">
  <div class="spinner-border text-primary" role="status">
    <span class="visually-hidden">Loading...</span>
  </div>
  <p>Fetching Applicants...</p>
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
      <tbody id="tbody">
      </tbody>
    </table>
  </div>
  <div class="d-flex justify-content-end mt-3">
    <button id="clearForm" class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
      data-bs-target="#offcanvasBackdrop" aria-controls="offcanvasBackdrop"> Format details </button>
  </div>
</div>
</div>

<!-- Modal for Applicant Details -->
<div class="modal fade" id="applicantDetailsModal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">Applicant Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modalBody">
        <p>Loading...</p>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function () {

    // Get the job_id from the query parameter
    var applicantsData;
    var filterApplicantsData;
    const urlParams = new URLSearchParams(window.location.search);
    const jobId = urlParams.get('job_id');

    if (jobId) {
      $("#loading").show();
      // Fetch the applicants for this job
      $.ajax({
        url: `/api/getapplicantbyjob/${jobId}`,
        type: 'GET',
        dataType: 'json',
        success: function (response) {
          console.log(response, 'erge');
          $("#loading").hide();
          if (response.status === 'success') {
            applicantsData = response.data;
            filterApplicantsData = response.data;
            populateApplicantTable(response.data);
          } else {
            alert('Error fetching applicants: ' + response.message);
          }
        },
        error: function (xhr, status, error) {
          $("#loading").hide();
          console.error('AJAX Error:', error);
        }
      });
    }

    function populateApplicantTable(applicants) {
      var table = $('#table').DataTable();
      var tableBody = $('#tbody');
      tableBody.empty();

      $.each(applicants, function (index, applicant) {
        var rows = `
          <tr class="text-center small align-middle">
            <td><input type="checkbox" /></td>
            <td>${applicant.FirstName} ${applicant.LastName}</td>
            <td>${applicant.Experience}</td>
            <td>${applicant.PhoneNumber}</td>
            <td>${applicant.Qualification || "N/A"}</td>
            <td>${applicant.CurrentLocation}</td>
            <td>${applicant.PreferredLocation}</td>
            <td>${applicant.NoticePeriod}</td>
            <td>${applicant.CurrentOrganization || "N/A"}</td>
            <td>${applicant.CurrentSalary}</td>
            <td>${applicant.ExpectedSalary}</td>
            <td>${applicant.Resume ? `<a href="${applicant.Resume}" target="_blank">View Resume</a>` : "N/A"}</td>
            <td class="text-success">${applicant.StatusId === "1" ? "Pending" : "Shortlisted"}</td>
            <td>
              <button type="button" class="btn btn-primary view-details" data-id="${applicant.id}">View</button>
            </td>
          </tr>
        `;
        tableBody.append(rows);
        table.clear(); // Clear any previous DataTable data
        table.rows.add(tableBody.find('tr')).draw();
      });
    }

    $(document).on("click", ".view-details", function () {
      var applicantId = $(this).data("id");
      $("#modalBody").html("<p>Loading...</p>");
      $.ajax({
        url: `/api/getapplicant/${applicantId}`,
        type: "GET",
        dataType: "json",
        success: function (response) {
          if (response.status === "success") {
            var applicant = response.data;
            $("#modalBody").html(`
              <p><strong>Name:</strong> ${applicant.FirstName} ${applicant.LastName}</p>
              <p><strong>Email:</strong> ${applicant.Email}</p>
              <p><strong>Phone:</strong> ${applicant.PhoneNumber}</p>
              <p><strong>Experience:</strong> ${applicant.Experience}</p>
              <p><strong>Current Location:</strong> ${applicant.CurrentLocation}</p>
              <p><strong>Preferred Location:</strong> ${applicant.PreferredLocation}</p>
              <p><strong>Current Salary:</strong> ${applicant.CurrentSalary}</p>
              <p><strong>Expected Salary:</strong> ${applicant.ExpectedSalary}</p>
              <p><strong>Notice Period:</strong> ${applicant.NoticePeriod}</p>
              <p><strong>Skills:</strong> ${applicant.KeySkills}</p>
            `);
            $("#applicantDetailsModal").modal("show");
          } else {
            $("#modalBody").html("Error fetching applicant details.");
          }
        },
        error: function (xhr, status, error) {
          console.error("AJAX Error:", error);
        }
      });
    });



    // Filter applicants

    $('#applicantForm').on('submit', function (e) {
      e.preventDefault();

      // Retrieve form values
      let experience = $('#experience').val();
      let qualification = $('#qualifications').val();
      let preferredLocation = $('#preferredLocation').val();
      let noticePeriod = $('#noticePeriod').val();
      let expectedSalary = $('#expectedSalary').val();

      // console.log(filterApplicantsData);

      let filteredApplicant;

      switch (filterApplicantsData.length > 0) {
        case experience !== '':
          filteredApplicant = filterApplicantsData.filter((e) => e.Experience == experience);
          console.log(filteredApplicant);
          break;
        case qualification !== '':
          filteredApplicant = filterApplicantsData.filter((e) => e.Qualification && e.Qualification.toLowerCase() == qualification.toLowerCase());
          console.log(filteredApplicant);
          break;
        case preferredLocation !== '':
          filteredApplicant = filterApplicantsData.filter((e) => e.PreferredLocation && e.PreferredLocation.toLowerCase() == preferredLocation.toLowerCase());
          console.log(filteredApplicant);
          break;
        case noticePeriod !== '':
          filteredApplicant = filterApplicantsData.filter((e) => e.NoticePeriod <= noticePeriod);
          console.log(filteredApplicant);
          break;
        case expectedSalary !== '':
          filteredApplicant = filterApplicantsData.filter((e) => parseFloat(e.ExpectedSalary) <= parseFloat(expectedSalary));
          console.log(filteredApplicant);
          break;
      }

    });

  });



</script>

@endsection