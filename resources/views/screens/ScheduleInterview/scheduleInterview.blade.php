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
              <option value="virtual">Virtual</option>
              <option value="walkin">Walk-in</option>
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

      <button type="submit" class="btn btn-primary mt-3">Send Mail</button>

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

<script>
  $(document).ready(function () {
    const urlParams = new URLSearchParams(window.location.search);
    let applicants = urlParams.get('applicants');

    if (applicants) {
      try {
        applicants = JSON.parse(decodeURIComponent(applicants)); // Convert back to array
        console.log("Received Applicants:", applicants);

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

  // Form submission via AJAX
  $('#emailForm').on('submit', function (e) {
    e.preventDefault(); // Prevent the default form submission

    // Collect the form data
    const formData = {
      candidate: {
        email: $("#toField").val(),
        name: "Candidate", // Adjust with the name you want to use for the candidate
      },
      interviewDate: $("#interviewDate").val(),
      timeSlots: [
        $("#timeslotone").val(),
        $("#timeslottwo").val(),
        $("#timeslotthree").val()
      ],
      mode: $("select").val(),
      bcc: $("#bcc").val(),
      cc: $("#cc").val(),
      description: $("#description").val(),
      location: $("#location").val()
    };

    let emailArray = $("#toField").val().split(",").map(email => email.trim());

    emailArray.forEach((email) => {
      formData.candidate.email = email;

      $.ajax({
        url: '/api/send-interview-mail',
        type: 'POST',
        data: formData,
        success: function (response) {
          console.log(`Email sent to: ${email}`);
        },
        error: function (xhr, status, error) {
          // On failure
          console.error("Error sending email:", error);
          alert("Error sending email. Please try again.");
        }
      });
    })

    setTimeout(()=>{
      $('#successModal').modal('show');

    // Optionally reset the form
    $('#emailForm')[0].reset();
    },2000)
   
  });
</script>


@endsection