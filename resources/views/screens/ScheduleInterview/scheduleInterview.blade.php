@extends('layouts/contentNavbarLayout')
@section('title', 'Documents - documents')

@section('content')

<div class="card mb-4">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Candidate Interview</h5>
  </div>
  <div class="card-body">
    <form id="emailForm" class="needs-validation" novalidate>
      <div class="row">
        <div class="col-md-6">
          <input type="text" hidden id="EmployerId">
          <div class="form-floating form-floating-outline mb-4">
            <input type="text" class="form-control" name="" id="toField" value="">
            <label for="to">To</label>
            <div class="invalid-feedback">Please select an email address.</div>
          </div>
          <div class="form-floating form-floating-outline mb-4">
            <input type="text" class="form-control" id="cc" name="interviewDate" placeholder="CC" required />
            <label for="interviewDate">CC</label>
            <div class="invalid-feedback">Please choose CC </div>
          </div>
          <div class="form-floating form-floating-outline mb-4">
            <input type="date" class="form-control" id="interviewDate" name="interviewDate" required />
            <label for="interviewDate">Interview Date</label>
            <div class="invalid-feedback">Please choose a valid interview date.</div>
          </div>
          <div class="form-floating form-floating-outline mb-4">
            <input type="time" class="form-control" id="timeslotone" name="timeslotone" required />
            <label for="timeslotone">Select 1st time slot</label>
            <div class="invalid-feedback">Please choose a valid interview time.</div>
          </div>
          <div class="form-floating form-floating-outline mb-4">
            <input type="time" class="form-control" id="timeslottwo" name="timeslottwo" required />
            <label for="timeslottwo">Select 2nd time slot</label>
            <div class="invalid-feedback">Please choose a valid interview time.</div>
          </div>
          <div class="form-floating form-floating-outline mb-4">
            <select name="" id="option" class="form-select">
              <option value="Online">Virtual</option>
              <option value="Walkin">Walk-in</option>
            </select>
            <label for="interviewDate">Select mode of interview</label>
            <div class="invalid-feedback">Please choose a valid interview time.</div>
          </div>

        </div>

        <div class="col-md-6">
          <div class="form-floating form-floating-outline mb-4">
            <input type="text" class="form-control" id="bcc" name="bcc" placeholder="BCC" required />
            <label for="bcc">BCC</label>
            <div class="invalid-feedback">Please choose BCC </div>
          </div>
          <div class="form-floating form-floating-outline mb-4">
            <textarea id="description" name="description" class="form-control" placeholder="Subject Description"
              style="height: 122px;" required></textarea>
            <label for="description">Interview Description</label>
            <div class="invalid-feedback">Please provide a description.</div>
          </div>
          <div class="form-floating form-floating-outline mb-4">
            <input type="time" class="form-control" id="timeslotthree" name="timeslotthree" required />
            <label for="timeslotthree">Select 3rd time slot</label>
            <div class="invalid-feedback">Please choose a valid interview time.</div>
          </div>
          <div class="form-floating form-floating-outline mb-4">
            <input type="text" class="form-control" id="location" name="location" placeholder="Location / Virtual Link"
              required />
            <label for="location">Location / Virtual Link</label>
            <div class="invalid-feedback">Please choose a valid interview time.</div>
          </div>
        </div>
      </div>

      <button type="submit" id="sendMail" class="btn btn-primary mt-3">Send Mail</button>

      <button type="submit" id="updateApplicant" class="btn btn-primary mt-3 ">Re-schedule
        Interview</button>

    </form>
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
        Mail Sent Successfully
      </div>
      <div class="modal-footer">
        <a href="/formattedapplicantslist" class="btn btn-primary">OK</a>
      </div>
    </div>
  </div>
</div>

<!-- Error Modal -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="errorModalLabel">Error</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="errorMessage">
        <!-- Error message will be inserted here dynamically -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function () {
    let applicants;
    const urlParams = new URLSearchParams(window.location.search);
    applicants = urlParams.get('applicants');



    if (applicants) {
      $('#updateApplicant').addClass('d-none');
      $('#sendMail').addClass('d-block');
      try {
        applicants = JSON.parse(decodeURIComponent(applicants)); // Convert back to array
        console.log("Received Applicants:", applicants);

        $('#emailForm').on('submit', function (e) {
          e.preventDefault();
          for (let i = 0; i < applicants.length; i++) {
            sendMail(applicants[i]);
            // let email = applicants[i].email;
            // console.log("Email:", email);
            // sendMail(email);
          }
        });

        // Extract only emails from the applicants array
        let emails = applicants.map(applicant => applicant.email);
        console.log("Extracted Emails:", emails);

        // Set the 'To' field with the emails
        $("#toField").val(emails.join(", "));
      } catch (error) {
        console.error("Error parsing applicants:", error);
      }
    }
  });

  function sendMail(e) {

    const userData = JSON.parse(localStorage.getItem('userData'));

    const type = $('#option').val();
    const link = $('#location').val();
    const date = $('#interviewDate').val();
    const bcc = $('#bcc').val();
    const cc = $('#cc').val();
    const description = $('#description').val();
    const timeslotone = $('#timeslotone').val();
    const timeslottwo = $('#timeslottwo').val();
    const timeslotthree = $('#timeslotthree').val();
    const status = 1;
    const createdBy = userData?.id;

    $("#sendMail").prop("disabled", true).addClass("btn-primary").html('Sending...<span class="spinner-border spinner-border-sm"></span> ');

    $.ajax({
      url: '/api/send-interview-mail',
      type: 'POST',
      data: {
        "EmployerId": e.empId,
        "ApplicantId": e.id,
        "JobId": e.jobId,
        "Type": type,
        "Link/Location": link,
        "InterviewDate": date,
        "ApplicantEmail": e.email,
        "BCC": bcc,
        "CC": cc,
        "Description": description,
        "FirstTimeSlot": timeslotone,
        "SecondTimeSlot": timeslottwo,
        "ThirdTimeSlot": timeslotthree,
        "Status": 1,
        "CreatedBy": userData?.id
      },
      success: function (response) {
        // console.log(`Email sent to: ${email}`);
        updateApplicantStatus(e.id);
      },
      error: function (xhr, status, error) {
        // On failure
        console.error("Error sending email:", xhr);
        if (xhr.status === 400 && xhr.responseJSON?.message) {
          $("#errorMessage").text(xhr.responseJSON.message);
          $("#errorModal").modal("show");
        } else {
          $("#errorMessage").text("An error occurred while sending the email. Please try again.");
          $("#errorModal").modal("show");
        }
        $("#sendMail").prop("disabled", false).html("Send Mail");
      }
    });
  }

  function updateApplicantStatus(applicantId) {
    $.ajax({
      url: `/api/applicantStatusUpdate/${applicantId}`,
      type: 'PUT',
      contentType: 'application/json',
      data: JSON.stringify({
        status: 6,
      }),
      success: function (response) {
        console.log("Applicant status updated successfully:", response);
        $('#successModal').modal('show');
      },
      error: function (xhr, status, error) {
        console.error("Error updating applicant status:", xhr);
        console.error("Error updating applicant status:", error);
      }
    });
  }








  $(document).ready(function () {
    let data;
    const urlParams = new URLSearchParams(window.location.search);
    const interview = urlParams.get('interview');
    data = JSON.parse(interview);
    console.log(data)



    if (interview) {
      $('#updateApplicant').addClass('d-block');
      $('#sendMail').addClass('d-none');

      $('#toField').val(data.ApplicantEmail);
      $('#cc').val(data.CC);
      $('#interviewDate').val(data.InterviewDate);
      $('#timeslotone').val(data.FirstTimeSlot);
      $('#timeslottwo').val(data.SecondTimeSlot);
      $('#timeslotthree').val(data.ThirdTimeSlot);
      $('#option').val(data.Type);
      $('#bcc').val(data.BCC);
      $('#description').val(data.Description);
      $('#location').val(data['Link/Location']);
    }




    // function updateApplicantData() {
    // const interviewId = urlParams.get('interview_id');
    // console.log("interview Id to update:", interviewId)
    // if (!interviewId) {
    //   console.error("Interview ID is missing");
    //   return;
    // }

    $('#updateApplicant').on('click', function (e) {
      e.preventDefault();
      const userData = JSON.parse(localStorage.getItem('userData'));

      const requestData = {
        Status: 1,
        EmployerId: data.EmployerId,
        ApplicantId: data.ApplicantId,
        JobId: data.JobId,
        ApplicantEmail: $('#toField').val(),
        "BCC": $('#bcc').val(),
        "CC": $('#cc').val(),
        InterviewDate: $('#interviewDate').val(),
        FirstTimeSlot: $('#timeslotone').val(),
        SecondTimeSlot: $('#timeslottwo').val(),
        ThirdTimeSlot: $('#timeslotthree').val(),
        'Link/Location': $('#location').val(),
        Type: $('#option').val(),
        Description: $('#description').val(),
        CreatedBy: userData.id
      };

      console.log("Request Data:", requestData);

      $.ajax({
        url: `/api/interview/update/${data.id}`,
        type: 'PUT',
        contentType: 'application/json',
        data: JSON.stringify(requestData),
        success: function (response) {
          console.log("Interview updated successfully:", response);
          $('#successModal').modal('show');
        },
        error: function (xhr, status, error) {
          console.log(xhr);
          console.error("Error updating interview:", error);
          $("#errorMessage").text("An error occurred while updating the interview details. Please try again.");
          $("#errorModal").modal("show");
        }
      });
    });



    // }
  });

</script>


@endsection