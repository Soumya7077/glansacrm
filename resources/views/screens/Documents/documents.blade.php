@extends('layouts/contentNavbarLayout')
@section('title', 'Documents - documents')

@section('content')
<h4><span class="text-muted fw-light">Home /</span> Documents</h4>

<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Documents</h5> <small class="text-muted float-end">Provide the necessary information</small>
    </div>
    <div class="card-body">
        <form>
            <div class="row">
                <div class="col-md-6">

                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="organisation-name" placeholder="Organisation Name"
                            required />
                        <label for="organisation-name">Organisation Name</label>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="number" class="form-control" id="applicantname:*" placeholder="Applicants Name"
                            required />
                        <label for="openings">Applicants Name</label>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="file" class="form-control" id="resume" required />
                        <label for="File-Path">File Path</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <select class="form-control" id="status">
                            <option value="full-time">Verified</option>
                            <option value="contract">Uploaded</option>
                        </select>
                        <label for="status ">status </label>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <textarea id="description" class="form-control" placeholder="Description" style="height: 122px;"
                            required></textarea>
                        <label for="description">Description</label>
                    </div>

                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

@endsection