@extends('layouts/contentNavbarLayout')
@section('title', 'Jobs - Job List')

@section('content')
<h4><span class="text-muted fw-light">Home /</span> Job List</h4>
<div class="container-fluid mt-3 px-0">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Job List</h3>
        <a class="btn btn-primary btn-sm" href="/jobpost">Add New Job</a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover shadow-sm text-sm">
            <thead class="table-dark text-center small">
                <tr>
                    <th>Job Title</th>
                    <th>Organisation Name</th>
                    <th>Openings</th>
                    <th>Salary</th>
                    <th>Location</th>
                    <th>Education</th>
                    <th>Description</th>
                    <th>Key Skills</th>
                    <th>Department</th>
                    <th>Experience</th>
                    <th>Shift</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-center small">
                    <td>React Developer</td>
                    <td>Apollo</td>
                    <td>2</td>
                    <td>₹20,000</td>
                    <td>Hyderabad</td>
                    <td>Graduation</td>
                    <td>Develop and maintain React applications.</td>
                    <td>React, JavaScript, Redux, Git</td>
                    <td>IT</td>
                    <td>1-2 years</td>
                    <td>Day</td>
                    <td>
                        <a href="#" class="btn btn-primary btn-sm">View</a>
                    </td>
                </tr>
                <tr class="text-center small">
                    <td>Full Stack Developer</td>
                    <td>Glansa</td>
                    <td>1</td>
                    <td>₹50,000</td>
                    <td>Bangalore</td>
                    <td>B.Tech</td>
                    <td>Develop backend and frontend applications.</td>
                    <td>React, Node.js, MySQL</td>
                    <td>IT</td>
                    <td>3-5 years</td>
                    <td>Night</td>
                    <td>
                        <a href="#" class="btn btn-primary btn-sm">View</a>
                    </td>
                </tr>
                <tr class="text-center small">
                    <td>React Developer</td>
                    <td>Apollo</td>
                    <td>2</td>
                    <td>₹20,000</td>
                    <td>Hyderabad</td>
                    <td>Graduation</td>
                    <td>Develop and maintain React applications.</td>
                    <td>React, JavaScript, Redux, Git</td>
                    <td>IT</td>
                    <td>1-2 years</td>
                    <td>Day</td>
                    <td>
                        <a href="#" class="btn btn-primary btn-sm">View</a>
                    </td>
                </tr>
                <tr class="text-center small">
                    <td>Full Stack Developer</td>
                    <td>Glansa</td>
                    <td>1</td>
                    <td>₹50,000</td>
                    <td>Bangalore</td>
                    <td>B.Tech</td>
                    <td>Develop backend and frontend applications.</td>
                    <td>React, Node.js, MySQL</td>
                    <td>IT</td>
                    <td>3-5 years</td>
                    <td>Night</td>
                    <td>
                        <a href="#" class="btn btn-primary btn-sm">View</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection