<tbody class="contact_tbody">
    @if ($contacts)
        @foreach (json_decode($contacts, true) as $key => $row)
            <tr>
                <td>
                    <input type="text" class="form-control" name="contact[title][]" value="{{ $row['title'] ?? null }}">
                </td>
                <td>
                    <input type="file" class="d-none contact_icon_input_{{ $key }}" name="contact[icon][]">

                    @php
                        $icon = $row['icon'] ?? 'default.png';
                    @endphp

                    <img src="{{ asset('uploads/social_media/' . $icon) }}" height="auto" width="60px"
                        style="margin-bottom: 6px; cursor:pointer; border:none !important" alt=""
                        class="avatar border social_media_icon contact_icon_{{ $key }}">

                    <input type="hidden" name="contact[old_icon][]" value="{{ $icon }}">
                </td>
                <td>
                    <input type="text" class="form-control" name="contact[link][]"
                        value="{{ $row['link'] ?? null }}">
                </td>
                <td>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input switcher_input status"
                            id="{{ $row['title'] }}" data-id="{{ $row['title'] }}"
                            {{ $row['status'] == 1 ? 'checked' : '' }} name="contact[status_{{ $key }}]">
                        <label class="custom-control-label" for="{{ $row['title'] }}"></label>
                    </div>
                </td>
                <td>
                    <a type="button">
                        <i class="fa fa-trash-alt text-danger delete_contact"></i>
                    </a>
                </td>
            </tr>
            @push('js')
                <script>
                    $(function() {
                        $('.contact_icon_{{ $key }}').click(function(e) {
                            console.log('contact_icon_{{ $key }}');
                            $('.contact_icon_input_{{ $key }}').trigger('click');
                        });

                        $('.contact_icon_input_{{ $key }}').change(function(e) {
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                $('.contact_icon_{{ $key }}').attr('src', e.target.result).show();
                            }
                            reader.readAsDataURL(this.files[0]);
                        });
                        $('.delete_contact').click(function(e) {
                            var tbody = $('.tbody');
                            var numRows = tbody.find("tr").length;
                            if (numRows == 1) {
                                toastr.error('{{ __('Cannot remove all row') }}');
                                return;
                            } else if (numRows >= 2) {

                                $(this).closest('tr').remove();
                            }
                        });
                    });
                </script>
            @endpush
        @endforeach
    @endif

</tbody>
