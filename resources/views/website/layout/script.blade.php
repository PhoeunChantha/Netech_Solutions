   @stack('js')
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

   <!-- UIkit JS -->
   <script src="https://cdn.jsdelivr.net/npm/uikit@3.21.11/dist/js/uikit.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/uikit@3.21.11/dist/js/uikit-icons.min.js"></script>
   {{-- <script>
        $(document).ready(function() {
            var success_audio = "{{ URL::asset('sound/success.wav') }}";
            var error_audio = "{{ URL::asset('sound/error.wav') }}";
            var success = new Audio(success_audio);
            var error = new Audio(error_audio);

            @if (Session::has('msg'))
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "timeOut": 4000
                }
                @if (Session::get('success') == true)
                    toastr.success("{{ Session::get('msg') }}");
                    success.play();
                @else
                    toastr.error("{{ Session::get('msg') }}");
                    error.play();
                @endif
            @endif
        });
    </script> --}}
   <script>
       @if (session('success'))
           Swal.fire({
               position: 'center',
               icon: 'success',
               title: '{{ session('msg') }}',
               showConfirmButton: false,
               timer: 2000
           });
       @endif

       @if (session('warning'))
           Swal.fire({
               position: 'center',
               icon: 'warning',
               title: '{{ session('msg') }}',
               showConfirmButton: false,
               timer: 2000
           });
       @endif

       @if (session('danger'))
           Swal.fire({
               position: 'center',
               icon: 'error',
               title: '{{ session('msg') }}',
               showConfirmButton: false,
               timer: 2000
           });
       @endif
       //    pre loader
       //    document.addEventListener("DOMContentLoaded", function() {
       //        window.addEventListener("load", function() {
       //            // Set the duration for the preloader (in milliseconds)
       //            const preloaderDuration = 3000; // 3000ms = 3 seconds

       //            setTimeout(function() {
       //                document.querySelector(".preloader").style.display = "none";
       //                document.querySelector(".content").style.display = "block";
       //            }, preloaderDuration);
       //        });
       //    });
       //    window.addEventListener('load', function() {
       //        const preloaderDuration = 2000; // 3000ms = 3 seconds
       //        const preloader = document.querySelector('.preloader');
       //        const content = document.querySelector('.content');

       //        if (preloader) {
       //            preloader.style.display = "flex";
       //        }

       //        if (content) {
       //            content.style.display = "none";
       //        }
       //        setTimeout(function() {
       //            if (preloader) {
       //                preloader.style.display = "none";
       //            }
       //            if (content) {
       //                content.style.display = "block";
       //            }
       //        }, preloaderDuration);
       //    });
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
