@extends('layouts/contentNavbarLayout')

@section('title', 'Social Media Form')

@section('content')

<div class="col-xxl">
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Offer Letter</h5>
        </div>
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" id="basic-default-fullname"
                                placeholder="Organisation Name" />
                            <label for="basic-default-fullname">Organisation Name</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="file" class="form-control" id="file" required />
                            <label for="resume">File</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline mb-4">
                            <select id="defaultSelect" class="form-select">
                                <option hidden>Status</option>
                                <option value="1">Sent</option>
                                <option value="2">Pending</option>
                            </select> <label for="basic-default-company">Status</label>
                        </div>
                        <div class="mb-4">
                            <div class="form-floating form-floating-outline mb-4">
                                <input type="text" class="form-control" id="basic-default-fullname"
                                    placeholder="Description" />
                                <label for="basic-default-fullname">Description</label>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>
    </div>
</div>

@endsection