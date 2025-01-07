@extends('layouts/contentNavbarLayout')
@section('title', 'Jobs - Jobs')

@section('content')
<h4><span class="text-muted fw-light">Home /</span> Jobs </h4>

<div class="card mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h5>Jobs for You</h5>
                @foreach ($jobs as $job)
                    <div class="card mb-3 job-card" onclick="fetchJobDetails({{ $job['id'] }})">
                        <div class="card-body">
                            <h5 class="card-title">{{ $job['title'] }}</h5>
                            <p class="card-text">{{ $job['company'] }} | {{ $job['location'] }}</p>
                            <p>{{ $job['salary'] }}</p>
                            <span class="badge bg-secondary">{{ $job['type'] }}</span>
                            @if ($job['schedule'])
                                <span class="badge bg-info">{{ $job['schedule'] }}</span>
                            @endif
                        </div>
                        <div class="card-body py-0 pb-3">
                            <a href="/applicantsapply" class="badge bg-primary text-white fs-6 p-2">Apply Now</a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="col-md-6">

                <div class="bg-white" style=" border: 1px solid #ddd; border-radius: 5px; position: sticky; top: 0; ">
                    <div class=" job-card">
                        <div class="card-body">
                            <h5 class="card-title">Medical Assistant</h5>
                            <a href="/applicantsapply" class="badge bg-primary text-white fs-6 p-2">Apply Now</a>
                        </div>
                    </div>
                    <hr class="m-0" />

                    <div id="job-details" class="job-details" style="max-height: 500px; overflow-y: auto;">

                        <div class="px-3 mt-4">
                            <h5>Job Details</h5>
                            <p>Select a job to view details.</p>
                            <div class="mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $job['title'] }}</h5>
                                    <p class="card-text">{{ $job['company'] }}</p>
                                    <p class="card-text">{{ $job['location'] }}</p>
                                    <p class="card-text">{{ $job['salary'] }}</p>
                                    <p class="card-text">{{ $job['type'] }}</p>
                                    <p class="card-text">{{ $job['schedule'] }}</p>
                                    <h5 class="card-title">{{ $job['title'] }}</h5>
                                    <p class="card-text">{{ $job['company'] }}</p>
                                    <p class="card-text">{{ $job['location'] }}</p>
                                    <p class="card-text">{{ $job['salary'] }}</p>
                                    <p class="card-text">{{ $job['type'] }}</p>
                                    <p class="card-text">{{ $job['schedule'] }}</p>
                                    <h5 class="card-title">{{ $job['title'] }}</h5>
                                    <p class="card-text">{{ $job['company'] }}</p>
                                    <p class="card-text">{{ $job['location'] }}</p>
                                    <p class="card-text">{{ $job['salary'] }}</p>
                                    <p class="card-text">{{ $job['type'] }}</p>
                                    <p class="card-text">{{ $job['schedule'] }}</p>
                                    <h5 class="card-title">{{ $job['title'] }}</h5>
                                    <p class="card-text">{{ $job['company'] }}</p>
                                    <p class="card-text">{{ $job['location'] }}</p>
                                    <p class="card-text">{{ $job['salary'] }}</p>
                                    <p class="card-text">{{ $job['type'] }}</p>
                                    <p class="card-text">{{ $job['schedule'] }}</p>
                                    <h5 class="card-title">{{ $job['title'] }}</h5>
                                    <p class="card-text">{{ $job['company'] }}</p>
                                    <p class="card-text">{{ $job['location'] }}</p>
                                    <p class="card-text">{{ $job['salary'] }}</p>
                                    <p class="card-text">{{ $job['type'] }}</p>
                                    <p class="card-text">{{ $job['schedule'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

@endsection