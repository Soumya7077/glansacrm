@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')
<div class="row gy-4">

  <div class="row">
    <div class="col-md-4 my-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title ">Users</h5>
          <h5 class="card-text">20</h5>
          <a href="/user" class="btn btn-primary">Learn More</a>
        </div>
      </div>
    </div>
    <div class="col-md-4 my-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title ">Jobs</h5>
          <h5 class="card-text">52</h5>
          <a href="/joblist" class="btn btn-primary">Learn More</a>
        </div>
      </div>
    </div>
    <div class="col-md-4 my-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title ">Employer </h5>
          <h5 class="card-text">62</h5>
          <a href="/employerlist" class="btn btn-primary">Learn More</a>
        </div>
      </div>
    </div>
    <div class="col-md-4 my-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title ">Social Media applicants</h5>
          <h5 class="card-text">20</h5>
          <a href="/smapplicantslist" class="btn btn-primary">Learn More</a>
        </div>
      </div>
    </div>
    <div class="col-md-4 my-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title ">Enquiry List
          </h5>
          <h5 class="card-text">50</h5>
          <a href="/enquiry" class="btn btn-primary">Learn More</a>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection