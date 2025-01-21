@extends('layouts/contentNavbarLayout')
@section('title', 'Applicants - Social Media applicants list')

@section('content')
<div class="container-fluid mt-3 px-0">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Social Media Applicants list</h3>
    </div>
    <div id="loading-spinner" style="display: none;">
        <span>
            <h4 class="text-primary">Loading...</h4>
        </span>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover shadow-sm text-sm" id="table">
            <thead class="table-dark text-center small">
                <tr class="text-center align-middle">
                    <th>Select Applicant</th>
                    <th>Applicant's Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Upload</th>
                </tr>
            </thead>
            <tbody id="tbody">


            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-end mt-3">
        <button id="clearForm" class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasBackdrop" aria-controls="offcanvasBackdrop"> Assign </button>
    </div>
</div>

<div class="col-lg-4 col-md-6">
    <div class="mt-3">
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasBackdrop"
            aria-labelledby="offcanvasBackdropLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasBackdropLabel" class="offcanvas-title">Assigning User</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <hr>
            <div class="offcanvas-body mx-0 flex-grow-0">
                <form id="assignUserForm" novalidate>
                    @csrf
                    <input type="hidden" id="userId">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-floating form-floating-outline mb-4">
                                <select class="form-control" id="recruiter" required>
                                    <option value="" hidden>Select Recruiter</option>
                                </select>
                                <label for="recruiter">Recruiter</label>
                                <div class="invalid-feedback">Please select a recruiter.</div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mb-2">Submit</button>
                </form>
                <button type="button" class="btn btn-outline-secondary d-grid w-100" id="cancelButton">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Success</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Your data has been successfully assigned!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function () {

            function fetchApplicants() {
                $('#loading-spinner').show();

                $.ajax({
                    url: '/api/getsmapplicant',
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        console.log("resssss", response)
                        $('#loading-spinner').hide();
                        var tableBody = $('#tbody');
                        tableBody.empty();
                        if (response.status === 'success' && response.data.length > 0) {
                            response.data.forEach((applicant) => {
                                const rows =
                                    `<tr class="text-center small" data-id="${applicant.id}">
                                         <td><input type="checkbox" class="select-applicant" data-id="${applicant.id}"></td>
                                         <td>${applicant.FirstName} ${applicant.LastName || ''}</td>
                                         <td>${applicant.Email || 'N/A'}</td>
                                        <td>${applicant.PhoneNumber || 'N/A'}</td>
                                        <td><button class="btn btn-info btn-xs">Upload</button></td>
                                     </tr>`;
                                tableBody.append(rows);
                            });
                        } else {
                            tableBody.append(`<tr>
                    <td colspan="6" class="text-center">No applicants found.</td>
                                             </tr> `);
                        }
                    },
                    error: function () {
                        $('#loading-spinner').hide();
                        showErrorModal('Failed to fetch applicants. Please try again later.');
                    }
                });
            }

            fetchApplicants();

            $(document).on('click', '#clearForm', function () {
                $('#offcanvasBackdrop').offcanvas('show');
            });

            $('#assignUserForm').on('submit', function (e) {
                e.preventDefault();
                $('#offcanvasBackdrop').offcanvas('hide');
                showSuccessModal('Applicants assigned successfully');
            });

            $('#cancelButton').on('click', function () {
                $('#assignUserForm')[0].reset();
            });

            function showSuccessModal(message) {
                $('#successModal .modal-body').text(message);
                $('#successModal').modal('show');
            }

            function showErrorModal(message) {
                $('#errorModal .modal-body').text(message);
                $('#errorModal').modal('show');
            }
        });
    </script>
@endpush