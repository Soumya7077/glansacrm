@extends('layouts/contentNavbarLayout')

@section('title', 'Schedule Interview Candidate')

@section('content')
<div class="container-fluid mt-3 px-0">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Schedule Interview Candidate</h3>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover shadow-sm text-sm" id="interviewsTable">
            <thead class="table-dark text-center small">
                <tr>
                    <th>Applicant First Name</th>
                    <th>Applicant Last Name</th>
                    <th>Organization Name</th>
                    <th>Job Title</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Location</th>
                    <th>Interview Date</th>
                    <th>First Time Slot</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="interviewTableBody">

            </tbody>
        </table>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function () {
            function fetchInterviews() {
                const loadingRow = '<tr><td colspan="9" class="text-center text-muted py-3">Loading data, please wait...</td></tr>';
                const noDataRow = '<tr><td colspan="9" class="text-center text-muted py-3">No interview schedules found.</td></tr>';
                const errorRow = '<tr><td colspan="9" class="text-center text-danger py-3">Error loading data! Please try again.</td></tr>';

                $("#interviewTableBody").html(loadingRow);

                $.ajax({
                    url: '/api/interviews',
                    method: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        if (response.success && response.data.length > 0) {
                            populateTable(response.data);
                        } else {
                            $("#interviewTableBody").html(noDataRow);
                        }
                    },
                    error: function () {
                        $("#interviewTableBody").html(errorRow);
                    }
                });
            }

            function populateTable(interviews) {
                console.log(interviews);
                var table = $('#table').DataTable();
                const tbody = $("#interviewTableBody");
                tbody.empty();

                interviews.forEach(interview => {
                    const data = encodeURIComponent(JSON.stringify(interview));
                    const row = `
                                        <tr class="text-center small align-middle">
                                            <td>${interview.applicantFirstName || 'N/A'}</td>
                                            <td>${interview.applicantLastName || 'N/A'}</td>
                                            <td>${interview.OrganizationName || 'N/A'}</td>
                                            <td>${interview.Title && interview.Title.length > 30 ? interview.Title.substring(0, 30) + '...' : interview.Title || 'N/A'}</td>
                                            <td>${interview.Description && interview.Description.length > 30 ? interview.Description.substring(0, 30) + '...' : interview.Description || 'N/A'}</td>
                                            <td>${interview.Type || 'N/A'}</td>
                                            <td>${interview['Link/Location'] || 'N/A'}</td>
                                            <td>${interview.InterviewDate || 'N/A'}</td>
                                            <td>${interview.FirstTimeSlot || 'N/A'}</td>
                                            <td>
                                                <div class="">
                                                    <a href=/schedule?interview=${data} class="btn btn-primary btn-sm p-2" data-id="${interview.id}" data-status="${interview.sid}" style="width: 120px;">Re Schedule</a>
                                                    <a href=/offerletter?interview=${data} class="btn btn-primary btn-sm p-2" data-id="${interview.id}" data-status="${interview.sid}" style="width: 120px;">Send-offerletter</a>
                                                </div>
                                                </td>
                                            </tr>`;
                    tbody.append(row);
                    table.clear();
                    table.rows.add(tbody.find('tr')).draw();
                });
            }

            fetchInterviews();


        });
    </script>
@endpush
@endsection