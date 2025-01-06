@extends('layouts/contentNavbarLayout')
@section('title', 'Applicant - Applicant List')

@section('content')
<h4><span class="text-muted fw-light">Home /</span> Applicant List</h4>
<div class="container-fluid mt-3 px-0">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover shadow-sm text-sm" id="table">
            <thead class="table-dark text-center small">
                <tr>
                    <th>SNo.</th>
                    <th>Applicant Name</th>
                    <th>Job Title</th>
                    <th>Job Description</th>
                    <th>Experience</th>
                    <th>Contact</th>
                    <th>Portfolio/LinkedIn</th>
                    <th>Applying For</th>
                    <th>Highest Qualification</th>
                    <th>Current Location</th>
                    <th>Preferred Location</th>
                    <th>Height</th>
                    <th>Weight</th>
                    <th>Blood Group</th>
                    <th>Hemoglobin %</th>
                    <th>Notice Period</th>
                    <th>Current Organisation</th>
                    <th>Current Salary</th>
                    <th>Expected Salary</th>
                    <th>Resume</th>
                    <th>Certificates</th>
                    <th>Work Experience</th>
                    <th>Remarks</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-center small">
                    <td>1</td>
                    <td>Naveen Nagam</td>
                    <td>Neurologist</td>
                    <td>Medical Assistant</td>
                    <td>5 years</td>
                    <td>9133913522</td>
                    <td><a href="https://linkedin.com/in/naveen">LinkedIn</a></td>
                    <td>Neurologist</td>
                    <td>M.Tech</td>
                    <td>Hyderabad</td>
                    <td>Bangalore</td>
                    <td>5'9"</td>
                    <td>70kg</td>
                    <td>O+</td>
                    <td>14%</td>
                    <td>30 days</td>
                    <td>Glansa</td>
                    <td>12 LPA</td>
                    <td>15 LPA</td>
                    <td><a href="#">View Resume</a></td>
                    <td><a href="#">View Certificates</a></td>
                    <td>3</td>
                    <td>Neurologist</td>
                    <td class="text-success">Shortlisted</td>
                </tr>

            </tbody>
        </table>
    </div>
    <!-- <div class="d-flex justify-content-end">
        <a href="{{url('formattedapplicantstoemployer')}}" class="btn btn-primary me-2">Send</a>
        <a href="{{ url('schedule') }}" class="btn btn-primary">Schedule an interview</a>
    </div> -->
</div>
@endsection