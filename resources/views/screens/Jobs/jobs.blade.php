@extends('layouts/contentNavbarLayout')
@section('title', 'Jobs - Jobs')

@section('content')
<h4><span class="text-muted fw-light">Home /</span> Jobs </h4>

<div class="card mb-4">
  <div class="card-body">
    <div class="row">
      <!-- Left Column: List of Jobs -->
      <div class="col-md-6">
        <h5>Jobs for You</h5>
        @if ($jobs->isEmpty())
      <p class="text-center text-danger">No jobs available at the moment.</p>
    @else
    @foreach ($jobs as $job)
    <div class="card mb-3 job-card" data-job-id="{{ $job->id }}" style="cursor: pointer;">
      <div class="card-body">
      <h5 class="card-title">{{ $job->Title }}</h5>
      <p class="card-text">{{ $job->OrganizationName }} | {{ $job->Location }}</p>
      <p>{{ $job->MinSalary }} - {{ $job->MaxSalary }} a {{ $job->MonthYear }}</p>
      <span class="badge bg-secondary">{{ $job->EmploymentType }}</span>
      @if ($job->Shift)
      <span class="badge bg-info">{{ $job->Shift }}</span>
    @endif
      </div>
    </div>
  @endforeach
  @endif
      </div>

      <!-- Right Column: Job Details -->
      <div class="col-md-6">
        <div class="bg-white" style="border: 1px solid #ddd; border-radius: 5px; position: sticky; top: 0;">
          <div class="job-card">
            <div class="card-body">
              <h5 class="card-title" id="job-title">{{ $jobs->first()->Title ?? 'No Job Selected' }}</h5>
              <a href="/applicantsapply" class="badge bg-primary text-white fs-6 p-2">Apply Now</a>
            </div>
          </div>
          <hr class="m-0" />

          <div id="job-details" class="job-details" style="max-height: 500px; overflow-y: auto;">
            <div class="px-3 mt-4">
              <h5>Job Details</h5>
              @if ($jobs->isNotEmpty())
          <div class="mb-4">
          <div class="card-body">
            <p class="card-text" id="job-organization">{{ $jobs->first()->OrganizationName }}</p>
            <p class="card-text" id="job-location">{{ $jobs->first()->Location }}</p>
            <p class="card-text" id="job-salary">{{ $jobs->first()->MinSalary }} - {{ $jobs->first()->MaxSalary }}
            a {{ $jobs->first()->MonthYear }}</p>
            <p class="card-text" id="job-employment">{{ $jobs->first()->EmploymentType }}</p>
            <p class="card-text" id="job-shift">{{ $jobs->first()->Shift }}</p>
          </div>
          </div>
        @else
        <p>No job details available.</p>
      @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- JavaScript Section -->
<script>
  document.addEventListener('DOMContentLoaded', () => {
    // Get job cards and detail elements
    const jobCards = document.querySelectorAll('.job-card[data-job-id]');
    const jobTitle = document.getElementById('job-title');
    const jobOrganization = document.getElementById('job-organization');
    const jobLocation = document.getElementById('job-location');
    const jobSalary = document.getElementById('job-salary');
    const jobEmployment = document.getElementById('job-employment');
    const jobShift = document.getElementById('job-shift');

    // Attach click events to each job card
    jobCards.forEach((card) => {
      card.addEventListener('click', () => {
        const jobId = card.getAttribute('data-job-id');

        // Fetch job details via AJAX
        fetch(`/api/getJob/${jobId}`)
          .then((response) => response.json())
          .then((data) => {
            const job = data.data;
            // Update the right side with fetched job details
            jobTitle.textContent = job.Title;
            jobOrganization.textContent = job.OrganizationName;
            jobLocation.textContent = job.Location;
            jobSalary.textContent = `${job.MinSalary} - ${job.MaxSalary} a ${job.MonthYear}`;
            jobEmployment.textContent = job.EmploymentType;
            jobShift.textContent = job.Shift || 'N/A';
          })
          .catch((error) => console.error('Error fetching job details:', error));
      });
    });
  });
</script>
@endsection
