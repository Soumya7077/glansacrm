@extends('layouts/contentNavbarLayout')

@section('title', 'Social Media Form')

@section('content')

<div class="col-xxl">
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Offer Letter</h5>
        </div>
        <div class="card-body">
            <form id="myForm" class="needs-validation" novalidate>
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" hidden name="ApplicantId" id="ApplicantId">
                        <input type="text" hidden name="JobId" id="JobId">
                        <input type="text" hidden name="EmployerId" id="EmployerId">
                        <input type="text" hidden name="InterviewId" id="InterviewId">
                        <input type="text" hidden name="CreatedBy" id="CreatedBy">
                        <input type="text" hidden name="Status" id="Status">

                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" id="toField" name="email" placeholder="To"
                                required />
                            <label for="toField">To</label>
                            <div class="invalid-feedback">Please enter a recipient email address.</div>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" id="salaryoffered" name="SalaryOffer"
                                placeholder="Salary offered" required />
                            <label for="salaryoffered">Salary Offered</label>
                            <div class="invalid-feedback">Please provide the salary offered.</div>
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" id="applicantfirstname" name="applicantfirstname"
                                placeholder="Name" required />
                            <label for="applicantfirstname">Name</label>
                            <div class="invalid-feedback">Please provide the applicant's name.</div>
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" id="organizationname" name="OrganisationName"
                                placeholder="Organization Name" required />
                            <label for="organizationname">Organization Name</label>
                            <div class="invalid-feedback">Please provide the organization name.</div>
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" id="description" name="description"
                                placeholder="Designation" required />
                            <label for="description">Designation</label>
                            <div class="invalid-feedback">Please provide the designation.</div>
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <input type="file" class="form-control" id="file" name="offer_letters" required />
                            <label for="file">File</label>
                            <div class="invalid-feedback">Please upload a file.</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" id="subject" name="Subject" placeholder="Subject"
                                required />
                            <label for="subject">Subject</label>
                            <div class="invalid-feedback">Please provide the subject.</div>
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <input type="date" class="form-control" id="joiningdate" name="JoiningDate"
                                placeholder="Joining Date" required />
                            <label for="joiningdate">Joining Date</label>
                            <div class="invalid-feedback">Please provide the joining date.</div>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <select id="shift" class="form-select" name="Shift" required>
                                <option value="" hidden>Shift</option>
                                <option value="General Shift">General Shift</option>
                                <option value="12 Hrs">12 Hrs</option>
                                <option value="24 Hrs">24 Hrs</option>
                            </select>
                            <label for="shift">Shift</label>
                            <div class="invalid-feedback">Please select a shift.</div>
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" id="benefits" name="Benefits" placeholder="Benefits"
                                required />
                            <label for="benefits">Benefits</label>
                            <div class="invalid-feedback">Please provide the benefits.</div>
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <textarea id="remarks" name="Remarks" class="form-control" placeholder="Remark"
                                style="height: 122px;"></textarea>
                            <label for="remarks">Remarks</label>
                            <div class="invalid-feedback">Please provide remarks.</div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Send</button>
            </form>
        </div>
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
                Offer Letter Sent Successfully
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        let data;
        const urlParams = new URLSearchParams(window.location.search);
        const interview = urlParams.get('interview');
        data = JSON.parse(interview);
        console.log(data);

        if (interview) {
            const data = JSON.parse(interview);
            $('#toField').val(data.ApplicantEmail);
            $('#applicantfirstname').val(data.applicantFirstName + ' ' + data.applicantLastName);
            // $('#salaryoffered').val(data.salaryOffered);
            $('#organizationname').val(data.OrganizationName);
            $('#description').val(data.Description);
            $('#joiningdate').val(data.JoiningDate);
            $('#ApplicantId').val(data.ApplicantId);
            $('#subject').val(data.Subject);
            $('#shift').val(data.Shift);
            $('#salaryoffered').val(data.SalaryOffer);
            $('#benefits').val(data.Benefits);
            $('#remarks').val(data.Remark);

            $('#JobId').val(data.JobId);
            $('#InterviewId').val(data.id);
            $('#EmployerId').val(data.EmployerId);
            $('#CreatedBy').val(data.CreatedBy);
            $('#Status').val(data.Status);
        }

        $('#myForm').on('submit', function (e) {
            e.preventDefault();

            if (!this.checkValidity()) {
                e.stopPropagation();
                $(this).addClass('was-validated');
            } else {
                const formData = new FormData(this);

                $.ajax({
                    url: '/api/send-offer-letter',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                        successModal.show();

                        $('#myForm').removeClass('was-validated');
                        document.getElementById('myForm').reset();
                        console.log('Response:', response);
                    },
                    error: function (xhr, status, error) {
                        alert('Failed to send the offer letter. Please try again.');
                        console.error('Error:', error);
                        console.error('XHR:', xhr.responseText);
                    }
                });
            }
        });
    });
</script>


@endsection