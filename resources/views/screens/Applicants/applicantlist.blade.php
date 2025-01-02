@extends('layouts/contentNavbarLayout')
@section('title', 'Applicant - Applicant List')

@section('content')
<h4><span class="text-muted fw-light">Home /</span> Applicant List</h4>
<div class="container-fluid mt-3 px-0">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover shadow-sm text-sm" id="table">
            <thead class="table-dark text-center small">
                <tr>
                    <th>Select Applicant</th>
                    <th>Applicant Name</th>
                    <th>Job Title</th>
                    <th>Job Description</th>
                    <th>Experience</th>
                    <th>Contact</th>
                    <th>Source</th>
                    <th>Mail</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-center small">
                    <th><input type="checkbox"></th>
                    <td>Naveen Nagam</td>
                    <td>React</td>
                    <td>Software Developer</td>
                    <td>5 years</td>
                    <td>9133913522</td>
                    <td>Web</td>
                    <td>naveen@gmail.com</td>
                    <td class="text-success">Shortlisted</td>
                </tr>
                <tr class="text-center small">
                    <th><input type="checkbox"></th>
                    <td>Naveen Nagam</td>
                    <td>React</td>
                    <td>Software Developer</td>
                    <td>5 years</td>
                    <td>9133913522</td>
                    <td>Web</td>
                    <td>naveen@gmail.com</td>
                    <td class="text-warning">Pending Review</td>
                </tr>
                <tr class="text-center small">
                    <th><input type="checkbox"></th>
                    <td>Naveen Nagam</td>
                    <td>React</td>
                    <td>Software Developer</td>
                    <td>5 years</td>
                    <td>9133913522</td>
                    <td>Web</td>
                    <td>naveen@gmail.com</td>
                    <td class="text-danger">Rejected</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-end">
        <a href="formattedapplicantstoemployer" class="btn btn-primary me-2">Send</a>
        <a href="schedule" class="btn btn-primary">Schedule an interview</a>
    </div>
</div>
@endsection