@extends('layouts/contentNavbarLayout')

@section('title', 'Add Users')

@section('content')

<div class="col-xxl">
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Add User</h5>
        </div>
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" id="basic-default-fullname"
                                placeholder="User Name" />
                            <label for="basic-default-fullname">User Name</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <select id="roleSelect" class="form-select">
                                
                            </select> <label for="basic-default-company">Role</label>
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
                        <div class="input-group input-group-merge">
                            <div class="form-floating form-floating-outline mb-4">
                                <input type="password" class="form-control" id="basic-default-password42"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="basic-default-password42" />
                                <label for="basic-default-phone">Password</label>
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