@extends('layouts/contentNavbarLayout')

@section('title', 'Job List Report')

@section('content')

<div class="container-fluid mt-3 px-0">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Job List Report</h3>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover shadow-sm text-sm" id="table">
            <thead class="table-dark text-center small">
                <tr class="text-center align-middle">
                    <th>Organisation Name</th>
                    <th>Job Title</th>
                    <th>Count</th>
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
                </tr>
            </thead>
            <tbody id="tbody">

            </tbody>
        </table>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        function fetchJobs() {
            let userData = JSON.parse(localStorage.getItem('userData'));
            var tableBody = $('#tbody');
            var table = $('#table').DataTable();

            tableBody.html('<tr><td colspan="20" class="text-bold text-primary">Loading...</td></tr>');
            $.ajax({
                url: userData?.RoleId == 1 ? '/api/getJob' : `/api/assignedrecruiter/${userData?.id}`,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    tableBody.empty();
                    if (response) {
                        response.data.forEach((job) => {
                            const rows = `
                <tr class="text-center small" data-id="${job.id}">
                  <td>${job.OrganizationName || 'N/A'}</td>
                  <td>${job.Title || 'N/A'}</td>
                  <td>${job.Opening || 'N/A'}</td>
                  <td>${job.Description && job.Description.length > 30 ? job.Description.substring(0, 30) + '...' : job.Description || 'N/A'}</td>
                  <td>${job.Opening || 'N/A'}</td>
                  <td>${job.JobsLocation || 'N/A'}</td>
                  <td>${job.Education && job.Education.length > 30 ? job.Education.substring(0, 30) + '...' : job.Education || 'N/A'}</td>
                  <td>${job.KeySkills && job.KeySkills.length > 30 ? job.KeySkills.substring(0, 30) + '...' : job.KeySkills || 'N/A'}</td>
                  <td>${job.DepartmentName || 'N/A'}</td>
                  <td>${job.MinSalary || 'N/A'}</td>
                  <td>${job.MaxSalary || 'N/A'}</td>
                  <td>${job.MinExperience || 'N/A'}</td>
                  <td>${job.MaxExperience || 'N/A'}</td>
                  <td>${job.EmploymentType || 'N/A'}</td>
                  <td>${job.Timeline || 'N/A'}</td>
                  <td>${job.Location || 'N/A'}</td>
                  <td>${job.Shift || 'N/A'}</td>
                  <td>${job.Benefits || 'N/A'}</td>
                  <td>${job.Gender || 'N/A'}</td>
                  <td>${job.Remarks && job.Remarks.length > 30 ? job.Remarks.substring(0, 30) + '...' : job.Remarks || 'N/A'}</td>                
                </tr>
              `;
                            tableBody.append(rows);

                        });
                        table.clear(); // Clear any previous DataTable data
                        table.rows.add(tableBody.find('tr')).draw();
                    } else {
                        $('#jobList').append(`
              <tr>
                <td colspan="20" class="text-center">No jobs found.</td>
              </tr>
            `);
                    }
                },
                error: function () {
                    tableBody.html('<tr><td colspan="20" class="text-center text-danger">Error fetching job data</td></tr>');
                    showErrorModal('Failed to fetch job data. Please try again later.');
                }
            });
        }

        fetchJobs();
    });
</script>

@endsection