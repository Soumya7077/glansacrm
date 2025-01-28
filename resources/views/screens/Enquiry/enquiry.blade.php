@extends('layouts/contentNavbarLayout')

@section('title', 'Enquiry List')

@section('content')
<div class="d-flex justify-content-between align-items-center py-3">
  <h3 class="mb-0">Enquiry List</h3>
  <a href="/enquiryForm" class="btn btn-primary">Add Enquiry </a>
</div>

<div>
  <div class="table-responsive">
    <!-- Error Message -->
    <div id="error-message" class="alert alert-danger d-none text-center"></div>

    <table class="table table-bordered table-striped table-hover shadow-sm text-sm" id="table">
      <thead class="table-dark text-center small">
        <tr class="text-center align-middle">
          <th>S No.</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Phone No</th>
          <th>Email</th>
          <th>Qualification</th>
          <th>Job Post</th>
          <th>Work Experience</th>
          <th>Current Salary</th>
          <th>Expected Salary</th>
          <th>Remark</th>
          <th>Resume</th>
        </tr>
      </thead>
      <tbody id="tbody">
      </tbody>
    </table>
  </div>
</div>

<script>
  $(document).ready(function () {
    // $("#loading").show();
    $("#error-message").hide();
    var table = $('#table').DataTable();
    var tableBody = $('#tbody');
    tableBody.html(`<tr><td colspan="12" class="text-primary">Loading...</td></tr>`); // Show loading message
    $.ajax({
      url: "/api/getapplicant",
      method: "GET",
      dataType: "json",
      success: function (response) {
        console.log(response,'ressss');
        
        if (response.status === "success") {
          let applicants = response.data.filter(applicant => applicant.Source == "Enquiry");
          console.log(applicants,'wergw');
          
          tableBody.empty();
          if (applicants.length === 0) {
            $("#error-message").removeClass("d-none").text("No Enquiry Data Available");
          } else {
            applicants.forEach((applicant, index) => {
              let resumeLink = applicant.Resume ? `<a href="/${applicant.Resume}" target="_blank">View Resume</a>` : "N/A";
              let row = `<tr class="text-center align-middle">
                <td>${index + 1}</td>
                <td>${applicant.FirstName}</td>
                <td>${applicant.LastName}</td>
                <td>${applicant.PhoneNumber}</td>
                <td>${applicant.Email}</td>
                <td>${applicant.Qualification ?? "N/A"}</td>
                <td>${applicant.jobpost_id}</td>
                <td>${applicant.Experience}</td>
                <td>${applicant.CurrentSalary}</td>
                <td>${applicant.ExpectedSalary}</td>
                <td>${applicant.Remarks && applicant.Remarks.length > 30 ? applicant.Remarks.substring(0, 30) + '...' : applicant.Remarks ?? "N/A"}</td>
                <td>${resumeLink}</td>
              </tr>`;
              tableBody.append(row);
              table.clear();
              table.rows.add(tableBody.find('tr')).draw();
            });

            $("#table").removeClass("d-none");
          }
        } else {
          $("#error-message").removeClass("d-none").text(response.message);
        }
      },
      error: function (xhr, status, error) {
        console.error("AJAX error:", error);
        $("#error-message").removeClass("d-none").text("Failed to load data. Please try again later.");
      },
      complete: function () {
        // $("#loading").hide(); // Hide loading indicator once AJAX completes
      }
    });
  });
</script>
@endsection