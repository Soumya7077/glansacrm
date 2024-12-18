@extends('layouts/contentNavbarLayout')

@section('title', 'Social Media Form')

@section('content')

<div class="col-xxl">
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Social Media Form</h5>
        </div>
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" id="basic-default-fullname"
                                placeholder="Name" />
                            <label for="basic-default-fullname">Applicant Name</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="number" class="form-control" id="basic-default-fullname"
                                placeholder="Phone Number" />
                            <label for="basic-default-fullname">Phone Number</label>
                        </div>
                      
                    </div>
                    <div class="col-md-6">
                        <div class="mb-4">
                            <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="basic-default-email" class="form-control"
                                        placeholder="user.name" aria-label="john.doe"
                                        aria-describedby="basic-default-email2" />
                                    <label for="basic-default-email">Email</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <select id="defaultSelect" class="form-select">
                                <option hidden>Interseted In</option>
                                <option value="1">Role 1</option>
                                <option value="2">Role 2</option>
                                <option value="3">Role 3</option>
                            </select> <label for="basic-default-company">Interested In</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>
    </div>
</div>

@endsection