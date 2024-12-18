@extends('layouts/contentNavbarLayout')
@section('title', 'AssigningUser - Assigning User')

@section('content')
<h4><span class="text-muted fw-light">Home /</span> Assigning User </h4>

<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Assigning User</h5> <small class="text-muted float-end">Fill in the required information to
            assign a user</small>
    </div>
    <div class="card-body">
        <form>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <select class="form-control" id="recruiter">
                            <option value="1">Naveen</option>
                            <option value="1">Soumya</option>
                            <option value="1">Sourav</option>
                        </select>
                        <label for="shift">Recruiter</label>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <select class="form-control" id="Job-Title">
                            <option value="1">React</option>
                            <option value="1">PHP</option>
                            <option value="1">Java</option>
                        </select>
                        <label for="shift">Job Title</label>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

@endsection