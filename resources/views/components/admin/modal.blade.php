<div class="modal fade" id="{{ $id ?? 'myModal' }}" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">{{ $title ?? '모달 제목' }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{ $body }}
      </div>
      <div class="modal-footer d-none">
        {{ $footer ?? '' }}
      </div>
    </div>
  </div>
</div>