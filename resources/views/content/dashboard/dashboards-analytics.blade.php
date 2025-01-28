@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
<style>
  .card {
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
  }

  .card:hover {
    transform: translateY(-8px);
    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
  }

  .card-body {
    transition: background-color 0.3s ease-in-out;
  }
</style>
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/countup.js/dist/countUp.min.js"></script> -->
@endsection

@section('page-script')
<script>
  AOS.init();

  // window.onload = function () {
  //   new CountUp('users-count', 0, 20, 0, 3).start();
  //   new CountUp('jobs-count', 0, 52, 0, 3).start();
  //   new CountUp('employer-count', 0, 62, 0, 3).start();
  //   new CountUp('smapplicants-count', 0, 20, 0, 3).start();
  //   new CountUp('enquiry-count', 0, 50, 0, 3).start();
  // };
</script>
@endsection

@section('content')
<div class="row gy-4">

  <div class="row">
    <div class="col-md-4 my-3" data-aos="fade-up" data-aos-duration="1000">
      <div class="card border-primary shadow-sm">
        <div class="card-body justify-content-between align-items-center">
          <h5 class="card-title text-primary fw-bold mb-3">Users</h5>
          <div class="d-flex justify-content-between">
            <h5 id="users-count" class="card-text fs-1 text-dark mb-0"></h5>
            <a href="/user" class="btn btn-primary">View</a>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4 my-3" data-aos="fade-up" data-aos-duration="1200">
      <div class="card border-primary shadow-sm">
        <div class="card-body justify-content-between align-items-center">
          <h5 class="card-title text-primary fw-bold mb-3">Jobs</h5>
          <div class="d-flex justify-content-between">
            <h5 id="jobs-count" class="card-text fs-1 text-dark mb-0">20</h5>
            <a href="/joblist" class="btn btn-primary">View</a>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4 my-3" data-aos="fade-up" data-aos-duration="1400">
      <div class="card border-primary shadow-sm">
        <div class="card-body justify-content-between align-items-center">
          <h5 class="card-title text-primary fw-bold mb-3">Employer</h5>
          <div class="d-flex justify-content-between">
            <h5 id="employer-count" class="card-text fs-1 text-dark mb-0">30</h5>
            <a href="/employerlist" class="btn btn-primary">View</a>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4 my-3" data-aos="fade-up" data-aos-duration="1600">
      <div class="card border-primary shadow-sm">
        <div class="card-body justify-content-between align-items-center">
          <h5 class="card-title text-primary fw-bold mb-3">SM Applicants</h5>
          <div class="d-flex justify-content-between">
            <h5 id="smapplicants-count" class="card-text fs-1 text-dark mb-0">40</h5>
            <a href="/smapplicantslist" class="btn btn-primary">View</a>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4 my-3" data-aos="fade-up" data-aos-duration="1800">
      <div class="card border-primary shadow-sm">
        <div class="card-body justify-content-between align-items-center">
          <h5 class="card-title text-primary fw-bold mb-3">Enquiry List</h5>
          <div class="d-flex justify-content-between">
            <h5 id="enquiry-count" class="card-text fs-1 text-dark mb-0">50</h5>
            <a href="/enquiry" class="btn btn-primary">View</a>
          </div>
        </div>
      </div>
    </div>

    <!-- <div class="col-md-4 my-3" data-aos="fade-up" data-aos-duration="1800">
      <div class="card border-primary shadow-sm">
        <div class="card-body justify-content-between align-items-center">
          <h5 class="card-title text-primary fw-bold mb-3">Priority Follow-Up</h5>
          <div class="d-flex justify-content-between">
            <h5 id="enquiry-count" class="card-text fs-1 text-dark mb-0">03</h5>
            <a href="/enquiry" class="btn btn-primary">View</a>
          </div>
        </div>
      </div>
    </div> -->

    <div class="col-md-4 my-3" data-aos="fade-up" data-aos-duration="1800">
      <div class="card border-primary shadow-sm">
        <div class="card-body justify-content-between align-items-center">
          <h5 class="card-title text-primary fw-bold mb-3">Selected Candidates</h5>
          <div class="d-flex justify-content-between">
            <h5 id="selected-applicant-count" class="card-text fs-1 text-dark mb-0">100</h5>
            <a href="/enquiry" class="btn btn-primary">View</a>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4 my-3" data-aos="fade-up" data-aos-duration="1800">
      <div class="card border-primary shadow-sm">
        <div class="card-body justify-content-between align-items-center">
          <h5 class="card-title text-primary fw-bold mb-3">Pending Candidates</h5>
          <div class="d-flex justify-content-between">
            <h5 id="pending-applicant-count" class="card-text fs-1 text-dark mb-0">60</h5>
            <a href="/enquiry" class="btn btn-primary">View</a>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4 my-3" data-aos="fade-up" data-aos-duration="1800">
      <div class="card border-primary shadow-sm">
        <div class="card-body justify-content-between align-items-center">
          <h5 class="card-title text-primary fw-bold mb-3">Rejected Candidates</h5>
          <div class="d-flex justify-content-between">
            <h5 id="rejected-applicant-count" class="card-text fs-1 text-dark mb-0">08</h5>
            <a href="/enquiry" class="btn btn-primary">View</a>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4 my-3" data-aos="fade-up" data-aos-duration="1800">
      <div class="card border-primary shadow-sm">
        <div class="card-body justify-content-between align-items-center">
          <h5 class="card-title text-primary fw-bold mb-3">Today's Interviews</h5>
          <div class="d-flex justify-content-between">
            <h5 id="todays-interviews" class="card-text fs-1 text-dark mb-0">10</h5>
            <a href="/enquiry" class="btn btn-primary">View</a>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4 my-3" data-aos="fade-up" data-aos-duration="1800">
      <div class="card border-primary shadow-sm">
        <div class="card-body justify-content-between align-items-center">
          <h5 class="card-title text-primary fw-bold mb-3">This Week's Interviews</h5>
          <div class="d-flex justify-content-between">
            <h5 id="week-interviews" class="card-text fs-1 text-dark mb-0">80</h5>
            <a href="/enquiry" class="btn btn-primary">View</a>
          </div>
        </div>
      </div>
    </div>


  </div>
</div>

<script>
  $(document).ready(function () {
    const usersCountElement = $("#users-count");
    const jobCount = $("#jobs-count");
    const employerCount = $("#employer-count");
    const smApplicantsCount = $("#smapplicants-count");
    const enquiryCount = $("#enquiry-count");
    const selectedApplicantCount = $("#selected-applicant-count");
    const pendingApplicantCount = $("#pending-applicant-count");
    const rejectedApplicantCount = $("#rejected-applicant-count");
    const todaysInterviews = $("#todays-interviews");
    const weekInterviews = $("#week-interviews");

    // Show loader initially
    usersCountElement.html('<span class="spinner-border text-primary" role="status"></span>');
    jobCount.html('<span class="spinner-border text-primary" role="status"></span>');
    employerCount.html('<span class="spinner-border text-primary" role="status"></span>');
    smApplicantsCount.html('<span class="spinner-border text-primary" role="status"></span>');
    enquiryCount.html('<span class="spinner-border text-primary" role="status"></span>');
    selectedApplicantCount.html('<span class="spinner-border text-primary" role="status"></span>');
    pendingApplicantCount.html('<span class="spinner-border text-primary" role="status"></span>');
    rejectedApplicantCount.html('<span class="spinner-border text-primary" role="status"></span>');
    todaysInterviews.html('<span class="spinner-border text-primary" role="status"></span>');
    weekInterviews.html('<span class="spinner-border text-primary" role="status"></span>');


    $.ajax({
      url: "/api/getuser",
      method: "GET",
      dataType: "json",
      success: function (data) {
        if (data.status == 200 && Array.isArray(data.data)) {
          usersCountElement.text(data.data.length);
        } else {
          usersCountElement.text("0");
        }
      },
      error: function (xhr, status, error) {
        console.error(xhr);
        usersCountElement.text("0");
      }
    });


    $.ajax({
      url: "/api/getJob",
      method: "GET",
      dataType: "json",
      success: function (data) {
        if (data.status == "success" && Array.isArray(data.data)) {
          jobCount.text(data.data.length);
        } else {
          jobCount.text("0");
        }
      },
      error: function (xhr, status, error) {
        console.error(xhr);
        jobCount.text("0");
      }
    });

    $.ajax({
      url: "/api/getEmployer",
      method: "GET",
      dataType: "json",
      success: function (data) {
        if (data.status == "success" && Array.isArray(data.data)) {
          employerCount.text(data.data.length);
        } else {
          employerCount.text("0");
        }
      },
      error: function (xhr, status, error) {
        console.error(xhr);
        employerCount.text("0");
      }
    });

    $.ajax({
      url: "/api/getsmapplicant",
      method: "GET",
      dataType: "json",
      success: function (data) {
        if (data.status == "success" && Array.isArray(data.data)) {
          smApplicantsCount.text(data.data.length);
        } else {
          smApplicantsCount.text("0");
        }
      },
      error: function (xhr, status, error) {
        console.error(xhr);
        smApplicantsCount.text("0");
      }
    });

    $.ajax({
      url: "/api/getapplicant",
      method: "GET",
      dataType: "json",
      success: function (data) {
        if (data.status == "success" && Array.isArray(data.data)) {
          const enquiryList = data.data.filter(applicant => applicant.Source == "Enquiry");
          const selectedList = data.data.filter(applicant => applicant.sid == 7);
          const pendingList = data.data.filter(applicant => applicant.sid == 1);
          const rejectedList = data.data.filter(applicant => applicant.sid == 8);
          enquiryCount.text(enquiryList.length);
          selectedApplicantCount.text(selectedList.length);
          pendingApplicantCount.text(pendingList.length);
          rejectedApplicantCount.text(rejectedList.length);
        } else {
          enquiryCount.text("0");
          selectedApplicantCount.text("0");
          pendingApplicantCount.text("0");
          rejectedApplicantCount.text("0");
        }
      },
      error: function (xhr, status, error) {
        console.error(xhr);
        enquiryCount.text("0");
      }
    });

    $.ajax({
      url: "/api/interviews",
      method: "GET",
      dataType: "json",
      success: function (data) {
        if (data && Array.isArray(data.data)) {
          const todaysInterviewList = data.data.filter(interview => interview.InterviewDate == new Date().toISOString().split('T')[0]);

          const today = new Date();
          today.setHours(0, 0, 0, 0); // Reset time to start of the day

          const nextWeek = new Date();
          nextWeek.setDate(nextWeek.getDate() + 7); // Add 7 days
          nextWeek.setHours(23, 59, 59, 999); // Set to end of the day

          const weekInterviewList = data.data.filter(interview => {
            const interviewDate = new Date(interview.InterviewDate);
            return interviewDate >= today && interviewDate <= nextWeek;
          });

          todaysInterviews.text(todaysInterviewList.length);
          weekInterviews.text(weekInterviewList.length);
        } else {
          todaysInterviews.text("0");
          weekInterviews.text("0");
        }
      },
      error: function (xhr, status, error) {
        console.error(xhr);
        todaysInterviews.text("0");
      }
    });

  });

</script>

@endsection