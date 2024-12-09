<tbody class="social-media-tbody tbody">
    @if ($social_medias)
        @foreach (json_decode($social_medias, true) as $key => $row)
            <tr>
                <td>
                    <input type="text" class="form-control" name="social_media[title][]" value="{{ $row['title'] ?? null }}">
                    {{-- <select name="social_media[title][]" class="form-control" id="">
                        <option value="fab fa-facebook" @if($row['title'] == 'fab fa-facebook') selected @endif>Facebook</option>
                        <option value="fab fa-twitter" @if($row['title'] == 'fab fa-twitter') selected @endif>Twitter</option>
                        <option value="fab fa-instagram" @if($row['title'] == 'fab fa-instagram') selected @endif>Instagram</option>
                        <option value="fab fa-youtube" @if($row['title'] == 'fab fa-youtube') selected @endif>Youtube</option>
                        <option value="fab fa-linkedin" @if($row['title'] == 'fab fa-linkedin') selected @endif>Linkedin</option>
                    </select> --}}
                </td>
                <td>
                    <input type="file" class="d-none social_media_icon_input_{{ $key }}" name="social_media[icon][]">
                    <img src="{{ $row['icon'] ? asset('uploads/social_media/'. $row['icon']) : asset('uploads/image/default.png') }}" height="auto" width="60px" style="margin-bottom: 6px; cursor:pointer; border:none !important" alt="" class="avatar border social_media_icon social_media_icon_{{ $key }}">

                    <input type="hidden" name="social_media[old_icon][]" value="{{ $row['icon'] ?? null }}">
                </td>
                <td>
                    <input type="text" class="form-control" name="social_media[link][]" value="{{ $row['link'] ?? null }}">
                </td>
                <td>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input switcher_input status" id="{{ $row['title'] }}" data-id="{{ $row['title'] }}" {{ $row['status'] == 1 ? 'checked' : '' }} name="social_media[status_{{ $key }}]">
                        <label class="custom-control-label" for="{{ $row['title'] }}"></label>
                    </div>
                </td>
                <td>
                    <a type="button">
                        <i class="fa fa-trash-alt text-danger delete_social_media"></i>
                    </a>
                </td>
            </tr>
            @push('js')
                <script>
                    $(function () {
                        $('.social_media_icon_{{ $key }}').click(function (e) {
                            console.log('social_media_icon_{{ $key }}');
                            $('.social_media_icon_input_{{ $key }}').trigger('click');
                        });

                        $('.social_media_icon_input_{{ $key }}').change(function (e) {
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                $('.social_media_icon_{{ $key }}').attr('src', e.target.result).show();
                            }
                            reader.readAsDataURL(this.files[0]);
                        });

                        $('.delete_social_media').click(function (e) {
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
