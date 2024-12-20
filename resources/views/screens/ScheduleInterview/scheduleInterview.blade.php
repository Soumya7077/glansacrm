@extends('layouts/contentNavbarLayout')
@section('title', 'Documents - documents')

@section('content')

<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Schedule Interview</h5> 
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
                        <input type="date" class="form-control" id="organisation-name" placeholder="Organisation Name"
                            required />
                        <label for="organisation-name">Interview Date</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                        <textarea id="Subject-description" class="form-control" placeholder="Subject Description"
                            style="height: 122px;" required></textarea>
                        <label for="Subject-description">Interview Description</label>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Send Mail</button>
        </form>
    </div>
</div>

@endsection