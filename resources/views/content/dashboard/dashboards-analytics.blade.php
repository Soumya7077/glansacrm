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
<script src="https://cdn.jsdelivr.net/npm/countup.js/dist/countUp.min.js"></script>
@endsection

@section('page-script')
<script>
  AOS.init();

  window.onload = function () {
    new CountUp('users-count', 0, 20, 0, 3).start();
    new CountUp('jobs-count', 0, 52, 0, 3).start();
    new CountUp('employer-count', 0, 62, 0, 3).start();
    new CountUp('smapplicants-count', 0, 20, 0, 3).start();
    new CountUp('enquiry-count', 0, 50, 0, 3).start();
  };
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
            <h5 id="users-count" class="card-text fs-1 text-dark mb-0">10</h5>
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

    <div class="col-md-4 my-3" data-aos="fade-up" data-aos-duration="1800">
      <div class="card border-primary shadow-sm">
        <div class="card-body justify-content-between align-items-center">
          <h5 class="card-title text-primary fw-bold mb-3">Priority Follow-Up</h5>
          <div class="d-flex justify-content-between">
            <h5 id="enquiry-count" class="card-text fs-1 text-dark mb-0">03</h5>
            <a href="/enquiry" class="btn btn-primary">View</a>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4 my-3" data-aos="fade-up" data-aos-duration="1800">
      <div class="card border-primary shadow-sm">
        <div class="card-body justify-content-between align-items-center">
          <h5 class="card-title text-primary fw-bold mb-3">Selected Candidates</h5>
          <div class="d-flex justify-content-between">
            <h5 id="enquiry-count" class="card-text fs-1 text-dark mb-0">100</h5>
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
            <h5 id="enquiry-count" class="card-text fs-1 text-dark mb-0">20</h5>
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
            <h5 id="enquiry-count" class="card-text fs-1 text-dark mb-0">08</h5>
            <a href="/enquiry" class="btn btn-primary">View</a>
          </div>
        </div>
      </div>
    </div>


  </div>
</div>
@endsection