
@extends('layouts/contentNavbarLayout')


@section('title', 'Users List')

@section('content')
<div class="d-flex justify-content-between align-items-center py-3">
  <h3 class="mb-0">Users</h3>
  <a class="btn btn-primary" href="/userForm">+Add User</a>
</div>

<!-- Basic Bootstrap Table -->
<div>
  <h5 class="card-header">User Master List</h5>
  <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover shadow-sm text-sm" id="table">
      <thead class="table-dark text-center small">
        <tr>
          <th>S No.</th>
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="tbody">
        
      </tbody>
    </table>
  </div>
</div>


@endsection
<script>
  
</script>

