<div class="card-body p-0 table-wrapper ">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th class="">{{ __('Name') }}</th>
                <th>{{ __('Message') }}</th>
                <th>{{ __('Email') }}</th>
                <th>{{ __('isRead') }}</th>
                <th>{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        {{ $contact->first_name }} {{ $contact->last_name }}
                    </td>

                    <td>{{ $contact->message }}</td>
                    <td>{{ $contact->email }}</td>
                    {{-- <td>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input switcher_input isRead"
                                id="isRead{{ $contact->id }}" {{ $contact->isRead == 1 ? 'checked' : '' }}
                                name="isRead" disabled>
                            <label class="custom-control-label" for="isRead{{ $contact->id }}"></label>
                        </div>
                    </td> --}}
                    <td>
                        <div>
                            @if ($contact->isRead == 1)
                                <span class="badge badge-success">{{__('Read')}}</span>
                            @else
                                <span class="badge badge-danger">{{__('Unread')}}</span>
                            @endif
                        </div>
                    </td>

                    <td>
                        @if (auth()->user()->can('message.reply'))
                            <a href="#" data-href="{{ route('admin.contact.replysms', $contact->id) }}"
                                class="btn btn-info btn-sm btn-modal view-btn" data-container=".modal_form"
                                data-toggle="modal" data-id="{{ $contact->id }}">
                                <i id="viewAndReplyIcon" class="fa-solid fa-comment-dots"></i>
                                {{ __('Reply Message') }}
                            </a>
                        @endif
                        @if (auth()->user()->can('contact.delete'))
                            <form action="{{ route('admin.contact.destroy', $contact->id) }}"
                                class="d-inline-block form-delete-{{ $contact->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" data-id="{{ $contact->id }}"
                                    data-href="{{ route('admin.contact.destroy', $contact->id) }}"
                                    class="btn btn-danger btn-sm btn-delete">
                                    <i class="fa fa-trash-alt"></i>
                                    {{ __('Delete') }}
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

    <div class="row">
        <div class="col-12 d-flex flex-row flex-wrap">
            <div class="row" style="width: -webkit-fill-available;">
                <div class="col-12 col-sm-6 text-center text-sm-left pl-3" style="margin-block: 20px">
                    {{ __('Showing') }} {{ $contacts->firstItem() }} {{ __('to') }} {{ $contacts->lastItem() }}
                    {{ __('of') }} {{ $contacts->total() }} {{ __('entries') }}
                </div>
                <div class="col-12 col-sm-6 pagination-nav pr-3"> {{ $contacts->links() }}</div>
            </div>
        </div>
    </div>
</div>
