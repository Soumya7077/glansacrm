@extends('layouts/contentNavbarLayout')
@section('title', 'FormattedDetails - Formatted Applicants List')

@section('content')
<h4><span class="text-muted fw-light">Home /</span> Formatted Applicants List </h4>
<div class="container-fluid mt-3 px-0">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Formatted Applicants List</h3>
  </div>
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
            <th>Key Skills</th>
            <th>Current Salary</th>
            <th>Expected Salary</th>
            <th>Notice Period</th>
            <th>Highest Qualification</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr class="text-center small">
            <th><input type="checkbox"></th>
            <td>Naveen Nagam</td>
            <td>Physician Assistant</td>
            <td>Physician Assistant</td>
            <td>5 years</td>
            <td>Communication Skills, Teamwork, Flexibility, Ethics</td>
            <td>200000</td>
            <td>400000</td>
            <td>15 days</td>
            <td>BSc Nursing</td>
            <td class="text-success">Shortlisted</td>
          </tr>
          <tr class="text-center small">
            <th><input type="checkbox"></th>
            <td>Soumya Ranjan</td>
            <td>Physician Assistant</td>
            <td>Physician Assistant</td>
            <td>5 years</td>
            <td>Communication Skills, Teamwork, Flexibility, Ethics</td>
            <td>200000</td>
            <td>400000</td>
            <td>15 days</td>
            <td>BSc Nursing</td>
            <td class="text-warning">Pending Review</td>
          </tr>
          <tr class="text-center small">
            <th><input type="checkbox"></th>
            <td>Anita seth</td>
            <td>Physician Assistant</td>
            <td>Physician Assistant</td>
            <td>5 years</td>
            <td>Communication Skills, Teamwork, Flexibility, Ethics</td>
            <td>200000</td>
            <td>400000</td>
            <td>15 days</td>
            <td>BSc Nursing</td>
            <td class="text-danger">Rejected</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="d-flex justify-content-end">
      <a href="{{url('formattedapplicantstoemployer')}}" class="btn btn-primary me-2">Send</a>
      <a href="{{ url('schedule') }}" class="btn btn-primary">Schedule an interview</a>
    </div>
  </div>
</div>
@endsection