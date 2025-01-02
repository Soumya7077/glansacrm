@extends('layouts/contentNavbarLayout')
@section('title', 'Department - Department')

@section('content')
<h4><span class="text-muted fw-light">Home /</span> Department</h4>

<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Department</h5>
    </div>
    <div class="card-body">
        <form id="department" novalidate>
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