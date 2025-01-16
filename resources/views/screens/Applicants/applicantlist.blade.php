@extends('layouts/contentNavbarLayout')
@section('title', 'Applicant - Applicant List')

@section('content')
<h4><span class="text-muted fw-light">Home /</span> Applicant List</h4>


<div class="offcanvas-body mx-0 flex-grow-0">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Applicant Details</h5>
        </div>
        <div class="card-body">
            <form id="addUserForm" novalidate>
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" id="experience" placeholder="Experience" required />
                            <label for="experience">Experience</label>
                            <div class="invalid-feedback">Please provide experience details.</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" id="qualifications" placeholder="Qualifications"
                                required />
                            <label for="qualifications">Qualifications</label>
                            <div class="invalid-feedback">Please provide your qualifications.</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" id="preferredLocation"
                                placeholder="Preferred Location" required />
                            <label for="preferredLocation">Preferred Location</label>
                            <div class="invalid-feedback">Please provide your preferred location.</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" id="noticePeriod" placeholder="Notice Period"
                                required />
                            <label for="noticePeriod">Notice Period</label>
                            <div class="invalid-feedback">Please provide your notice period.</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" id="expectedSalary" placeholder="Expected Salary"
                                required />
                            <label for="expectedSalary">Expected Salary</label>
                            <div class="invalid-feedback">Please provide your expected salary.</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary w-25 mb-3">Filter</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="container-fluid mt-3 px-0">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover shadow-sm text-sm" id="table">
            <thead class="table-dark text-center small">
                <tr class="text-center align-middle">
                    <th>Select</th>
                    <th>Applicant Name</th>
                    <th>Experience</th>
                    <th>Contact</th>
                    <th>Highest Qualification</th>
                    <th>Current Location</th>
                    <th>Preferred Location</th>
                    <th>Notice Period</th>
                    <th>Current Organisation</th>
                    <th>Current Salary</th>
                    <th>Expected Salary</th>
                    <th>Resume</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-center small align-middle">
                    <td><input type="checkbox" /></td>
                    <td>Naveen Nagam</td>
                    <td>5 years</td>
                    <td>9133913522</td>
                    <td>M.Tech</td>
                    <td>Hyderabad</td>
                    <td>Bangalore</td>
                    <td>30 days</td>
                    <td>Glansa</td>
                    <td>12 LPA</td>
                    <td>15 LPA</td>
                    <td><a href="#">View Resume</a></td>
                    <td class="text-success">Shortlisted</td>
                    <td><button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#applicantDetailsModal">View</button></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-end mt-3">
        <button id="clearForm" class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasBackdrop" aria-controls="offcanvasBackdrop"> Format details </button>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Success</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Details formatted successfully

            </div>
            <div class="modal-footer">
                <a href="/formattedapplicantslist" class="btn btn-primary">OK</a>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="applicantDetailsModal" tabindex="-1" aria-labelledby="applicantDetailsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="applicantDetailsModalLabel">Applicant Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Name:</strong> Anita Seth </p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Phone Number:</strong> 9658741235 </p>
                                </div>

                                <div class="col-md-6">
                                    <p><strong>Email:</strong> anita@gmail.com </p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Portfolio/LinkedIn Profile:</strong> <a href="#"> linkedin.com/anita </a>
                                    </p>
                                </div>

                                <div class="col-md-6">
                                    <p><strong>Applying For:</strong> Medical </p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Highest Qualification:</strong> MBBS </p>
                                </div>

                                <div class="col-md-6">
                                    <p><strong>Current Location:</strong> Hyderabad </p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Preferred Location:</strong> Hyderabad </p>
                                </div>

                                <div class="col-md-6">
                                    <p><strong>Height:</strong> 5.4 ft </p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Weight:</strong> 58 kg </p>
                                </div>

                                <div class="col-md-6">
                                    <p><strong>Blood Group:</strong> O+ </p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Hemoglobin:</strong> 14.5% </p>
                                </div>

                                <div class="col-md-6">
                                    <p><strong>Notice Period:</strong> 1 month </p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Work Experience:</strong> 5 years </p>
                                </div>

                                <div class="col-md-6">
                                    <p><strong>Current Salary:</strong> 3,00,000 </p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Expected Salary:</strong> 6,20,000 </p>
                                </div>

                                <div class="col-md-6">
                                    <p><strong>Current Organisation:</strong> Glansa </p>
                                </div>

                                <div class="col-md-6">
                                    <p><strong>Resume:</strong> <a href="#"> Download Resume </a></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Certificates:</strong> <a href="#"> Download Certificates </a></p>
                                </div>

                                <div class="col-md-12">
                                    <p><strong>Remarks:</strong> Demonstrates exceptional dedication and compassion
                                        towards patients, providing holistic care and support.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#clearForm').on('click', function () {
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        });

        $('#emailForm').on('submit', function (e) {
            e.preventDefault();

            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
            $('#emailForm')[0].reset();
        });
    });
</script>

@endsection