@extends('layouts/contentNavbarLayout')
@section('title', 'Employer - Employer List')

@section('content')
<h4><span class="text-muted fw-light">Home /</span> Employer List</h4>
<div class="container-fluid mt-3 px-0">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Employer List</h2>
    <a class="btn btn-primary btn-sm" href="/employer">Add New Employer</a>
  </div>
  <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover shadow-sm text-sm" id="table">
      <thead class="table-dark text-center small">
        <tr>
          <th>Sr No</th>
          <th>Organisation Name</th>
          <th>Phone Number</th>
          <th>Email</th>
          <th>Location</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr class="text-center small">
          <td>1</td>
          <td>Apollo</td>
          <td>9876543180</td>
          <td>appollo@gmail.com</td>
          <td>Hyderabad</td>
          <td>
            <a href="#" class="btn btn-warning btn-sm">Edit</a>
            <a href="#" class="btn btn-danger btn-sm">Delete</a>
          </td>
        </tr>
        <tr class="text-center small">
          <td>2</td>
          <td>Dr Reddy</td>
          <td>9876543180</td>
          <td>reddy@gmail.com</td>
          <td>Mumbai</td>
          <td>
            <a href="#" class="btn btn-warning btn-sm">Edit</a>
            <a href="#" class="btn btn-danger btn-sm">Delete</a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
@endsection
