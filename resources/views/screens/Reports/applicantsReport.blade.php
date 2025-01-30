@extends('layouts/contentNavbarLayout')

@section('title', 'Applicants Report')

@section('content')

<div class="container-fluid mt-3 px-0">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Applicants Report</h3>
    </div>
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
                                <input type="text" class="form-control" id="qualifications" placeholder="Qualifications"
                                    required />
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
                                <input type="text" class="form-control" id="noticePeriod" placeholder="Notice Period"
                                    required />
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


    <div class="table-responsive mt-4">
        <h4>Applicant Table</h4>
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