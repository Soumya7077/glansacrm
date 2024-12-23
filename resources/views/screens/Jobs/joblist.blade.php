@extends('layouts/contentNavbarLayout')
@section('title', 'Jobs - Job List')

@section('content')
<h4><span class="text-muted fw-light">Home /</span> Job List</h4>
<div class="container-fluid mt-3 px-0">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Job List</h3>
    <a class="btn btn-primary btn-sm" href="/jobpost">Add New Job</a>
  </div>
  <div id="loading-spinner" style="display: none;">
    <span><h4 class="text-primary">Loading...</h4></span>
  </div>
  <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover shadow-sm text-sm" id="table">
      <thead class="table-dark text-center small">
        <tr>
          <th>Job Title</th>
          <th>Organisation Name</th>
          <th>Openings</th>
          <th>Salary</th>
          <th>Location</th>
          <th>Education</th>
          <th>Description</th>
          <th>Key Skills</th>
          <th>Department</th>
          <th>Experience</th>
          <th>Shift</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="jobList">

      </tbody>
    </table>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    var table = $('#table').DataTable();
    function fetchJobs() {
      $('#loading-spinner').show(); 

      $.ajax({
        url: '/api/getJob', 
        type: 'GET', 
        dataType: 'json', 
        success: function (response) {
          $('#loading-spinner').hide(); // Hide loading spinner
          $('#table tbody').empty(); // Clear existing table rows

          if (response && response.status === 'success' && response.data?.length > 0) {
            console.log(response, 'jobbbbbbbbbbbbb');
            const tableBody = $('#jobList');
            response.data.forEach((job, index) => {
              const row = `
                            <tr class="text-center small">
                                <td>${job.Title || 'N/A'}</td>
                                <td>${job.organisation_name || 'N/A'}</td>
                                <td>${job.Opening || 'N/A'}</td>
                                <td>${job.Salary || 'N/A'}</td>
                                <td>${job.Location || 'N/A'}</td>
                                <td>${job.Education || 'N/A'}</td>
                                <td>${job.Description || 'N/A'}</td>
                                <td>${job.KeySkills || 'N/A'}</td>
                                <td>${job.Department || 'N/A'}</td>
                                <td>${job.Experience || 'N/A'}</td>
                                <td>${job.Shift || 'N/A'}</td>
                                <td>
                                    <a href="/applicantlist?job_id=${job.id}" class="btn btn-primary btn-sm">View</a>
                                </td>
                            </tr>
                        `;
              $('#table tbody').append(row);
            });
            table.clear().rows.add(tableBody.find('tr')).draw();
          } else {
            $('#table tbody').append(`
                        <tr>
                            <td colspan="12" class="text-center">No jobs found.</td>
                        </tr>
                    `);
          }
        },
        error: function () {
          $('#loading-spinner').hide(); // Hide loading spinner
          alert('Failed to fetch job data. Please try again later.');
        },
      });
    }

    fetchJobs();
  });
</script>

@endsection