<script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
{{-- <script src="{{ asset('backend/sweetalert2/js/sweetalert2@10.js') }}"></script> --}}
<script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Font Awesome Icons -->
<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> --}}
<!-- jQuery -->
<script src="{{ asset('website/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
<!-- Bootstrap 4 -->
<script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Datepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
{{-- summernote --}}
<script src="{{ asset('backend/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.js"></script>
<script src="{{ asset('backend/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script src="{{ asset('js/compress.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
<!-- UIkit JS -->
<script src="https://cdn.jsdelivr.net/npm/uikit@3.21.11/dist/js/uikit.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/uikit@3.21.11/dist/js/uikit-icons.min.js"></script>
{{-- intl-tel-input --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="https://www.google.com/recaptcha/enterprise.js?render=6Lds0GcqAAAAAHLrWnUOIPWAh3yxGw7L4MaKrKyp"></script>

{{-- <script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // var success_audio = "{{ URL::asset('sound/success.wav') }}";
        // var error_audio = "{{ URL::asset('sound/error.wav') }}";
        // var success = success_audio ? new Audio(success_audio) : null;
        // var error = error_audio ? new Audio(error_audio) : null;

        toastr.options = {
            "closeButton": true,
            "progressBar": true
        };

        @if (session()->has('msg'))
            @if (session('success') == 1)
                toastr.success("{{ session('msg') }}");
                if (success) success.play();
            @else
                toastr.error("{{ session('msg') }}");
                if (error) error.play();
            @endif
        @endif
    });
</script>


<script>
    // Get the button
    let mybutton = document.getElementById("myBtn");

    // When the user scrolls down 20px from the top of the document, show the button
    window.addEventListener('scroll', function() {
        if (document.body.scrollTop > 1000 || document.documentElement.scrollTop > 1000) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    });

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
</script>

<script>
    $(document).ready(function() {
        $('#dropdown-toggle').on('click', function() {
            $(this).next('.dropdown-menu').toggle();
        });
    });

    // Sticky navbar script
    var navbar = document.getElementById("sticky2");
    var sticky = navbar.offsetTop;

    window.addEventListener('scroll', function() {
        if (window.pageYOffset >= sticky) {
            navbar.classList.add("sticky");
        } else {
            navbar.classList.remove("sticky");
        }
    });
</script>
@stack('js')
