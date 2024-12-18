@extends('layouts/contentNavbarLayout')
@section('title', 'FormattedDetails - Formatted Applicants List')

@section('content')
<h4><span class="text-muted fw-light">Home /</span> Formatted Applicants List </h4>
<div class="container-fluid mt-3 px-0">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Formatted Applicants List</h3>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover shadow-sm text-sm">
            <thead class="table-dark text-center small">
                <tr>
                    <th>Applicant's Name</th>
                    <th>Key Skills</th>
                    <th>Job Description</th>
                    <th>Experience</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-center small">
                    <td>Naveen Nagam</td>
                    <td>React, JS, Node, PHP</td>
                    <td>Software Developer</td>
                    <td>5 years</td>
                    <td class="text-success">Shortlisted</td>
                </tr>
                <tr class="text-center small">
                    <td>Naveen Nagam</td>
                    <td>React, JS, Node, PHP</td>
                    <td>Software Developer</td>
                    <td>5 years</td>
                    <td class="text-warning">Pending Review</td>
                </tr>
                <tr class="text-center small">
                    <td>Naveen Nagam</td>
                    <td>React, JS, Node, PHP</td>
                    <td>Software Developer</td>
                    <td>5 years</td>
                    <td class="text-danger">Rejected</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection