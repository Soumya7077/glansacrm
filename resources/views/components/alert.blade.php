<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="confirmModalLabel">{{ $title ?? 'Confirmation' }}</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
      {{ $message ?? 'Are you sure you want to perform this action?' }}
    </div>
    <div class="modal-footer">
      @if($showCancelButton ?? true)
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
      {{ $cancelButtonText ?? 'Cancel' }}
      </button>
    @endif
      @if($showConfirmButton ?? true)
      <button type="button" class="{{$confirmButtonClass ?? 'btn btn-primary'}}"
      id="{{ $confirmButtonId ?? 'confirmButton' }}">
      {{ $confirmButtonText ?? 'Confirm' }}
      </button>
    @endif
    </div>
  </div>
</div>
