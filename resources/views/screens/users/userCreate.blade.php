@extends('layouts/contentNavbarLayout')

@section('title', 'Users List')

@section('content')

<div class="col-xxl">
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Add User</h5>
        </div>
        <div class="card-body">
            <form>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="basic-default-name" placeholder="User Name" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-company">Role</label>
                    <div class="col-sm-10">
                        <select id="defaultSelect" class="form-select">
                            <option hidden>Default select</option>
                            <option value="1">Role 1</option>
                            <option value="2">Role 2</option>
                            <option value="3">Role 3</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-email">Email</label>
                    <div class="col-sm-10">
                        <div class="input-group input-group-merge">
                            <input type="text" id="basic-default-email" class="form-control" placeholder="email"
                                aria-label="john.doe" aria-describedby="basic-default-email2" />
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-password42">Password</label>
                    <div class="col-sm-10">
                        <div class="input-group input-group-merge">
                            <input type="password" class="form-control" id="basic-default-password42"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="basic-default-password42" />
                            <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="mb-1 mt-3">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </form>
        </div>


    </div>
</div>
</div>

@endsection