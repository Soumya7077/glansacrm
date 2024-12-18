@extends('layouts/contentNavbarLayout')
@section('title', 'Applicants - Social Media applicants list')

@section('content')
<h4><span class="text-muted fw-light">Home /</span> SM applicants list</h4>
<div class="container-fluid mt-3 px-0">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Social Media applicants' list</h3>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover shadow-sm text-sm">
            <thead class="table-dark text-center small">
                <tr>
                    <th>Applicant's Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Interested For</th>
                    <th>Upload</th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-center small">
                    <td>Naveen Nagam</td>
                    <td>naveen@gmail.com</td>
                    <td>9133913522</td>
                    <td>React</td>
                    <td>
                        <a href="#" class="btn btn-primary btn-sm">Upload</a>
                    </td>
                </tr>
                <tr class="text-center small">
                    <td>Naveen Nagam</td>
                    <td>naveen@gmail.com</td>
                    <td>9133913522</td>
                    <td>React</td>
                    <td>
                        <a href="#" class="btn btn-primary btn-sm">Upload</a>
                    </td>
                </tr>
                <tr class="text-center small">
                    <td>Naveen Nagam</td>
                    <td>naveen@gmail.com</td>
                    <td>9133913522</td>
                    <td>React</td>
                    <td>
                        <a href="#" class="btn btn-primary btn-sm">Upload</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection