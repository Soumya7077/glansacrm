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
    <span>
      <h4 class="text-primary">Loading...</h4>
    </span>
  </div>
  <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover shadow-sm text-sm" id="table">
      <thead class="table-dark text-center small">
        <tr>
          <th>Organisation Name</th>
          <th>Job Title</th>
          <th>Description</th>
          <th>Openings</th>
          <th>Job's Location</th>
          <th>Education</th>
          <th>Key Skills</th>
          <th>Department</th>
          <th>Min Salary</th>
          <th>Max Salary</th>
          <th>Min Experience</th>
          <th>Max Experience</th>
          <th>Employment Type</th>
          <th>Time line</th>
          <th>Location</th>
          <th>Shift</th>
          <th>Benefits</th>
          <th>Gender</th>
          <th>Remarks</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="jobList">
       <td>Apollo</td>
       <td>React</td>
       <td>Develop and maintain React applications.</td>
       <td>1</td>
       <td>Chennai</td>
       <td>BE</td>
       <td>React, JavaScript</td>
       <td>IT</td>
       <td>50000</td>
       <td>70000</td>
       <td>1</td>
       <td>5</td>
       <td>Full Time</td>
       <td>With in 2 weeks</td>
       <td>Chennai</td>
       <td>Day Shift</td>
       <td>Health Insurance</td>
       <td>Male</td>
       <td>None</td>
        <td class="text-center">
         <div class="d-inline-flex gap-2">
          <a href="/applicantlist/?job_id=${1}" class="btn btn-sm btn-info">
            <i class="fa fa-edit">View</i>
            </a>
            <a href="/jobpost/1" class="btn btn-sm btn-primary">
          <i class="fa fa-edit">Edit</i>
          </a>
          <a href="/jobpost/1" class="btn btn-sm btn-danger">
            <i class="fa fa-trash">Delete</i>
            </a>
          </div>
            </td>

      </tbody>
    </table>
  </div>
</div>

<script>
  // document.addEventListener("DOMContentLoaded", () => {
  //   var table = $('#table').DataTable();
  //   function fetchJobs() {
  //     $('#loading-spinner').show();

  //     $.ajax({
  //       url: '/api/getJob',
  //       type: 'GET',
  //       dataType: 'json',
  //       success: function (response) {
  //         $('#loading-spinner').hide(); // Hide loading spinner
  //         $('#table tbody').empty(); // Clear existing table rows

  //         if (response && response.status === 'success' && response.data?.length > 0) {
  //           console.log(response, 'jobbbbbbbbbbbbb');
  //           const tableBody = $('#jobList');
  //           response.data.forEach((job, index) => {
  //             const row = `
  //                           <tr class="text-center small">
  //                               <td>${job.Title || 'N/A'}</td>
  //                               <td>${job.organisation_name || 'N/A'}</td>
  //                               <td>${job.Opening || 'N/A'}</td>
  //                               <td>${job.Salary || 'N/A'}</td>
  //                               <td>${job.Location || 'N/A'}</td>
  //                               <td>${job.Education || 'N/A'}</td>
  //                               <td>${job.Description || 'N/A'}</td>
  //                               <td>${job.KeySkills || 'N/A'}</td>
  //                               <td>${job.Department || 'N/A'}</td>
  //                               <td>${job.Experience || 'N/A'}</td>
  //                               <td>${job.Shift || 'N/A'}</td>
  //                               <td class="text-center">
  //                                 <div class="d-inline-flex gap-2">
  //                                   <a href="/applicantlist?job_id=${job.id}" class="btn btn-primary btn-xs">View</a>
  //                                   <a href="/jobpost/${job.id}" class="btn btn-info btn-xs">Edit</a>
  //                                   <buttton class="btn btn-danger btn-xs" data-id="${job.id}">Delete</button>
  //                                 </div>
  //                               </td>
  //                           </tr>
  //                       `;
  //             $('#table tbody').append(row);
  //           });
  //           table.clear().rows.add(tableBody.find('tr')).draw();
  //         } else {
  //           $('#table tbody').append(`
  //                       <tr>
  //                           <td colspan="12" class="text-center">No jobs found.</td>
  //                       </tr>
  //                   `);
  //         }
  //       },
  //       error: function () {
  //         $('#loading-spinner').hide(); // Hide loading spinner
  //         alert('Failed to fetch job data. Please try again later.');
  //       },
  //     });
  //   }

  //   fetchJobs();

    $(document).on('click', '.btn-danger', function () {
      const jobId = $(this).data('id'); // Get the job ID from the button

      // Confirm with the user before deletion
      if (confirm('Are you sure you want to delete this job?')) {
        $.ajax({
          url: `/api/deleteJob/${jobId}`, // API endpoint for deletion
          type: 'DELETE',
          success: function (response) {
            // console.log(response,'ererge');
            
            if (response.Status === 'success') {
              alert('Job deleted successfully');
              fetchJobs(); // Re-fetch the job list after deletion
            }else{
              alert('Failed to delete');
            } 
          },
          error: function () {
            alert('Failed to delete the job. Please try again later.');
          },
        });
      }
    });

  // });
</script>

@endsection