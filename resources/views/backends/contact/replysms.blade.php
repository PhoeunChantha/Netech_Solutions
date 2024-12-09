<style>
    .close {
        background: none !important;
    }
</style>
<!-- Modal -->
<div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{ __('Reply Message') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="background: none">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <form action="{{ route('admin.messages.sendReply', $contact->id) }}" class="submit-form" method="post">
            @csrf
            <div class="modal-body">
                <ul class="list-group">
                    <li class="list-group-item">
                        <b class="ml-5">{{ __('Name') }}</b>
                        <p class="float-right mr-5"> {{ $contact->first_name }} {{ $contact->last_name }}
                        </p>
                    </li>
                    <li class="list-group-item">
                        <b class="ml-5">{{ __('Email') }}</b>
                        <p class="float-right mr-5">{{ $contact->email }}</p>
                    </li>
                    <li class="list-group-item">
                        <b class="ml-5">{{ __('Message') }}</b>
                        <p class="float-right mr-5">{{ $contact->message }}</p>
                    </li>
                    <li class="list-group-item">
                        <b class="ml-5">{{ __('Received at') }}</b>
                        <p class="float-right mr-5">{{ $contact->created_at }}</p>
                    </li>
                </ul>

                <div class="replysms">
                    <input type="hidden" name="customerEmail" value="{{ $contact->email }}">
                    <div class="form-group">
                        <label for="reply">{{ __('Your Reply') }}</label>
                        <textarea class="form-control" id="reply" name="replymessage" rows="3" placeholder="reply message"></textarea>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                    id="closeButton">{{ __('Close') }}</button>
                {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button> --}}
                <button type="submit" class="btn btn-primary submit">{{ __('Send') }}</button>
            </div>
        </form>
    </div>
</div>
<script>
    document.getElementById('closeButton').addEventListener('click', function() {
        location.reload();
    });
</script>
