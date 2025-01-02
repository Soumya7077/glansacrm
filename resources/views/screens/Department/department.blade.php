@extends('layouts/contentNavbarLayout')
@section('title', 'Jobs - Job Post')

@section('content')
<h4><span class="text-muted fw-light">Home /</span> Job Post</h4>

<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Job Post</h5>
        <small class="text-muted float-end">Fill in the details for the job post</small>
    </div>
    <div class="card-body">
        <form id="jobPostForm" novalidate>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" required />
                        <label for="name">Name</label>
                        <div class="invalid-feedback">Please enter a valid Name.</div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<script>

</script>


@endsection