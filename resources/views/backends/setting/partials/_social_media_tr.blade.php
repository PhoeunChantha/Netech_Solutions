<tr class="tr_{{ $key }}">
    <td>
        <input type="text" class="form-control" name="social_media[title][]">
    </td>
    <td>
        <input type="file" class="d-none social_media_icon_input_{{ $key }}" name="social_media[icon][]">
        <img src="{{ asset('uploads/defualt.png') }}" height="auto" width="60px" style="margin-bottom: 6px; cursor:pointer; border:none !important" alt="" class="avatar border social_media_icon social_media_icon_{{ $key }}">

        <input type="hidden" name="social_media[old_icon][]" value="">
    </td>
    <td>
        <input type="text" class="form-control" name="social_media[link][]">
    </td>
    <td>
        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input switcher_input status" id="{{ $key }}" data-id="{{ $key }}" checked name="social_media[status_{{ $key }}]">
            <label class="custom-control-label" for="{{ $key }}"></label>
        </div>
    </td>
    <td>
        <a type="button">
            <i class="fa fa-trash-alt text-danger delete_social_media"></i>
        </a>
    </td>
</tr>

<script>
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
</script>

@push('js')

@endpush
