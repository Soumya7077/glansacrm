@extends('layouts/contentNavbarLayout')

@section('title', 'Applicants Report')

@section('content')



<div class="d-flex justify-content-between align-items-center">
    <div>
        <h4><span class="text-muted fw-light">Home /</span>Applicants Report</h4>
    </div>
    <div class="d-flex justify-content-end">
        <button id="filterBtn" class="btn btn-primary mb-3">
            <i class="mdi mdi-filter-variant me-2"></i> Filter
        </button>
    </div>
</div>

<div class="container-fluid mt-3 px-0">

    <div id="applicantFormContainer" class="form-container">
        <div class="card">
            <div class="card-header">
                <h4>Applicants Filter</h4>
                <div class="card-body">
                    <form id="applicantForm" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" class="form-control" id="experience" placeholder="Experience"
                                        required />
                                    <label for="experience">Experience</label>
                                    <div class="invalid-feedback">Please provide experience details.</div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" class="form-control" id="qualifications"
                                        placeholder="Qualifications" required />
                                    <label for="qualifications">Qualifications</label>
                                    <div class="invalid-feedback">Please provide your qualifications.</div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" class="form-control" id="preferredLocation"
                                        placeholder="Preferred Location" required />
                                    <label for="preferredLocation">Preferred Location</label>
                                    <div class="invalid-feedback">Please provide your preferred location.</div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" class="form-control" id="noticePeriod"
                                        placeholder="Notice Period" required />
                                    <label for="noticePeriod">Notice Period</label>
                                    <div class="invalid-feedback">Please provide your notice period.</div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" class="form-control" id="expectedSalary"
                                        placeholder="Expected Salary" required />
                                    <label for="expectedSalary">Expected Salary</label>
                                    <div class="invalid-feedback">Please provide your expected salary.</div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline mb-4">
                                    <select class="form-control" id="status" placeholder="Status" required>
                                        <option value="0" hidden>Select Status</option>
                                        <option value="1">Pending</option>
                                        <option value="2">Formatted</option>
                                        <option value="3">Mail Sent to Employer</option>
                                        <option value="4">Shortlisted</option>
                                        <option value="5">Not Shortlisted</option>
                                        <option value="6">Mail Sent to Candidate for Interview</option>
                                        <option value="7">Selected</option>
                                        <option value="8">Not Selected</option>
                                    </select>
                                    <label for="status">Status</label>
                                    <div class="invalid-feedback">Please provide valid status</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary w-25">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
        tableBody.html(`<tr><td colspan="14" class="text-primary">Loading...</td></tr>`);

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
                                
                                <td class="${applicant.sid == "1" ? 'text-warning' : 'text-success'}">
                                    ${applicant.sname}
                                </td>
                                
                            </tr>
                        `;
                        tableBody.append(rows);
                        table.clear(); 
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

    $('#applicantForm').on('submit', function (e) {
        e.preventDefault();

        let experience = $('#experience').val().trim();
        let qualification = $('#qualifications').val().trim().toLowerCase();
        let preferredLocation = $('#preferredLocation').val().trim().toLowerCase();
        let noticePeriod = $('#noticePeriod').val().trim();
        let expectedSalary = $('#expectedSalary').val().trim();
        let status = $('#status').val();

        let filteredApplicant = filterApplicantsData.filter((applicant) => {
            return (
                (experience === '' || applicant.Experience == experience) &&
                (qualification === '' || (applicant.Qualification && applicant.Qualification.toLowerCase() === qualification)) &&
                (preferredLocation === '' || (applicant.PreferredLocation && applicant.PreferredLocation.toLowerCase() === preferredLocation)) &&
                (noticePeriod === '' || (applicant.NoticePeriod && applicant.NoticePeriod.toLowerCase() == noticePeriod)) &&
                (expectedSalary === '' || (Number(applicant.ExpectedSalary) <= Number(expectedSalary))) &&
                (status === '0' || applicant.StatusId == status)
            );
        });
        let table = $('#table').DataTable(); // Access DataTable instance
        let tableBody = $("#table tbody");

        if (filteredApplicant.length === 0) {
            tableBody.html(`<tr><td colspan="12" class="     text-danger">No applicants found</td></tr>`);
            table.clear().draw(); 
            return;
        }

        // Clear table body and DataTable
        tableBody.empty();
        table.clear();

        // Append filtered rows to the table
        filteredApplicant.forEach(applicant => {
            let row = `
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
            
                <td class="${applicant.sid == "1" ? 'text-warning' : 'text-success'}">
                    ${applicant.sname}
                </td>
                
            </tr>
        `;
            tableBody.append(row);
        });

        // Redraw the DataTable with the new data
        table.rows.add(tableBody.find('tr')).draw();

        console.log(filteredApplicant,'filteredApplicant');
    });




</script>


@endsection