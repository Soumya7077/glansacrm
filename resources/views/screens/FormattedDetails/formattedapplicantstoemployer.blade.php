@extends('layouts/contentNavbarLayout')
@section('title', 'Formatted Details - Formatted Applicants to Employer')

@section('content')
<h4><span class="text-muted fw-light">Home /</span> Formatted Applicants to Employer </h4>

<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Formatted Applicants to Employer</h5> <small class="text-muted float-end">Provide the required
            details to process the application</small>
    </div>
    <div class="card-body">
        <form>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <select class="form-control" id="to">
                            <option value="1">naveen@gmail.com</option>
                            <option value="1">soumya@gmail.com</option>
                            <option value="1">sourav@gmail.com</option>
                        </select>
                        <label for="shift">To</label>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <select class="form-control" id="Applicants">
                            <option value="1">Naveen</option>
                            <option value="1">Sourav</option>
                            <option value="1">Soumya</option>
                        </select>
                        <label for="shift">Applicants</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <textarea id="Subject-description" class="form-control" placeholder="Subject Description"
                            style="height: 100px;" required></textarea>
                        <label for="Subject-description">Subject Description</label>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Send Mail</button>
        </form>
    </div>
</div>

@endsection