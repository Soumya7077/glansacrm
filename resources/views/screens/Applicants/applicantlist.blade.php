@extends('layouts/contentNavbarLayout')
@section('title', 'Applicant - Applicant List')

@section('content')
<h4><span class="text-muted fw-light">Home /</span> Applicant List</h4>
<div class="container-fluid mt-3 px-0">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover shadow-sm text-sm" id="table">
            <thead class="table-dark text-center small">
                <tr>
                    <th>Applicant Name</th>
                    <th>Job Title</th>
                    <th>Job Description</th>
                    <th>Experience</th>
                    <th>Contact</th>
                    <th>Source</th>
                    <th>Mail</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-center small">
                    <td>Naveen Nagam</td>
                    <td>React</td>
                    <td>Software Developer</td>
                    <td>5 years</td>
                    <td>9133913522</td>
                    <td>Web</td>
                    <td>naveen@gmail.com</td>
                    <td class="text-success">Shortlisted</td>
                    <td>
                        <a href="" class="btn btn-primary btn-sm">Send</a>
                    </td>
                </tr>
                <tr class="text-center small">
                    <td>Naveen Nagam</td>
                    <td>React</td>
                    <td>Software Developer</td>
                    <td>5 years</td>
                    <td>9133913522</td>
                    <td>Web</td>
                    <td>naveen@gmail.com</td>
                    <td class="text-warning">Pending Review</td>
                    <td>Sent</td>
                </tr>
                <tr class="text-center small">
                    <td>Naveen Nagam</td>
                    <td>React</td>
                    <td>Software Developer</td>
                    <td>5 years</td>
                    <td>9133913522</td>
                    <td>Web</td>
                    <td>naveen@gmail.com</td>
                    <td class="text-danger">Rejected</td>
                    <td>Sent</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection