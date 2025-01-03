@extends('layouts/contentNavbarLayout')

@section('title', 'Enquiry List')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Home /</span> Enquiry List</h4>

<div class="d-flex justify-content-between align-items-center py-3">
  <h3 class="mb-0">Enquiry List</h3>
  <a href="enquiryForm" class="btn btn-primary">Add Enquiry </a>
</div>

<div>
  <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover shadow-sm text-sm" id="table">
      <thead class="table-dark text-center small">
        <tr>
          <th>S No.</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Phone No</th>
          <th>Email</th>
          <th>Qualification</th>
          <th>Job Post</th>
          <th>Work Experience</th>
          <th>Current Salary</th>
          <th>Expected Salary</th>
          <th>Remark</th>
          <th>Resume</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>01</td>
          <td>John</td>
          <td>Doe</td>
          <td>9876543210</td>
          <td>john@example.com</td>
          <td>BE</td>
          <td>Clinical Positions</td>
          <td>3 Years</td>
          <td>50000</td>
          <td>70000</td>
          <td></td>
          <td><a target="_blank" class="btn btn-info btn-sm">View</a></td>

        </tr>
        <tr>
          <td>02</td>
          <td>Jane</td>
          <td>Doe</td>
          <td>9123456789</td>
          <td>jane@example.com</td>
          <td>BE</td>
          <td>Clinical Positions</td>
          <td>5 Years</td>
          <td>60000</td>
          <td>80000</td>
          <td></td>
          <td><a href="resume/jane_smith.pdf" target="_blank" class="btn btn-info btn-sm">View</a></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

@endsection