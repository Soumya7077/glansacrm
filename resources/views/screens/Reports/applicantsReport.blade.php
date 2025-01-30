@extends('layouts/contentNavbarLayout')

@section('title', 'Applicants Report')

@section('content')

<div class="container-fluid mt-3 px-0">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Applicants Report</h3>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover shadow-sm text-sm" id="table">
            <thead class="table-dark text-center small">
                <tr class="text-center align-middle">
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
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
<script>

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
                                
                                <td class="${applicant.StatusId === "1" ? 'text-warning' : 'text-success'}">
                                    ${applicant.sname}
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

</script>


@endsection