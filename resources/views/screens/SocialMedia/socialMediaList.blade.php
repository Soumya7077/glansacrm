@extends('layouts/contentNavbarLayout')

@section('title', 'Social Media List')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Home /</span> Social Media List</h4>

<div class="d-flex justify-content-between align-items-center py-3">
    <h3 class="mb-0">Social Media List</h3>
    <a href="smform" class="btn btn-primary">Add Social Media</a>
</div>

<div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover shadow-sm text-sm" id="table">
            <thead class="table-dark text-center small">
                <tr>
                    <th>S No.</th>
                    <th>Applicant Name</th>
                    <th>Phone No</th>
                    <th>Email</th>
                    <th>Interested In</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>01</td>
                    <td>John Doe</td>
                    <td>9876543210</td>
                    <td>john.doe@example.com</td>
                    <td>Role 1</td>

                </tr>
                <tr>
                    <td>02</td>
                    <td>Jane Smith</td>
                    <td>9123456789</td>
                    <td>jane.smith@example.com</td>
                    <td>Role 2</td>
                </tr>
                <!-- Add more rows dynamically as needed -->
            </tbody>
        </table>
    </div>
</div>
@endsection