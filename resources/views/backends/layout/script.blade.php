<!-- jQuery -->
<script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('backend/sweetalert2/js/sweetalert2@10.js') }}"></script>
<script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<!-- Bootstrap 4 -->
<script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ asset('backend/dist/js/adminlte.min.js') }}"></script>
{{-- <!-- DataTables  & Plugins -->
<script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('backend/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('backend/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script> --}}

<script src="{{ asset('backend/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('backend/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<script src="{{ asset('backend/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Datepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

{{-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" /> --}}
{{-- summernote --}}
<script src="{{ asset('backend/plugins/summernote/summernote-bs4.min.js') }}"></script>

<!-- AdminLTE for demo purposes -->
{{-- <script src="{{ asset('backend/dist/js/demo.js') }}"></script> --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.js"></script>

{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
<script src="{{ asset('backend/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script src="{{ asset('backend/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('js/compress.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>
{{ Session::has('message') }}
{{-- DataTable --}}
<script>
    $(document).ready(function() {
        if ($('#OrderdataTable').length && $('#OrderdataTableButtons').length) {
            if ($.fn.DataTable.isDataTable('#OrderdataTable')) {
                $('#OrderdataTable').DataTable().clear().destroy();
                // $('#dataTable').empty();
            }
            setTimeout(function() {
                let OrderdataTable;
                let actionColumnIndex = -1;
                $('#OrderdataTable thead th').each(function(index) {
                    let columnText = $(this).text().trim().toLowerCase();
                    if (columnText.includes('action')) {
                        actionColumnIndex = index;
                    }
                });

                OrderdataTable = $('#OrderdataTable').DataTable({
                    responsive: true,
                    dom: '<"d-flex justify-content-between align-items-center"lfB>rtip',
                    buttons: [{
                            extend: 'csv',
                            text: '<i class="fas fa-file-csv"></i> Export to CSV',
                            exportOptions: {
                                columns: ':visible:not(:last-child)'
                            }
                        },
                        {
                            extend: 'excel',
                            text: '<i class="fas fa-file-excel"></i> Export to Excel',
                            exportOptions: {
                                columns: ':visible:not(:last-child)'
                            }
                        },
                        {
                            extend: 'print',
                            text: '<i class="fas fa-print"></i> Print',
                            exportOptions: {
                                columns: ':visible:not(:last-child)'
                            }
                        },
                        {
                            extend: 'colvis',
                            text: '<i class="fas fa-columns"></i> Column Visibility'
                        },
                        {
                            extend: 'pdf',
                            text: '<i class="fas fa-file-pdf"></i> Export to PDF',
                            exportOptions: {
                                columns: ':visible:not(:last-child)'
                            }
                        },
                    ],
                    columnDefs: actionColumnIndex !== -1 ? [{
                        orderable: false,
                        targets: actionColumnIndex
                    }] : [],
                    language: {
                        search: "",
                        searchPlaceholder: "Search..."
                    },
                    pagingType: "full_numbers"

                });

                if ($('#OrderdataTableButtons').length) {
                    $('.dataTables_length').prependTo('#OrderdataTableButtons');
                    OrderdataTable.buttons().container().appendTo('#OrderdataTableButtons');
                    $('.dataTables_filter').appendTo('#OrderdataTableButtons');
                } else {
                    console.error("Div #OrderdataTableButtons not found.");
                }
            }, 100);

        } else {
            console.error("Table #dataTable or Div #OrderdataTableButtons not found.");
        }
    });
</script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/searchpanes/2.2.0/js/dataTables.searchPanes.min.js"></script>
<!-- Required for Export to Excel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<!-- Required for Export to PDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script>
    $(document).on('click', '.rowfy-addrow', function() {
        let rowfyable = $(this).closest('table');
        let lastRow = $('tbody tr:last', rowfyable).clone();
        $('input', lastRow).val('');
        $('tbody', rowfyable).append(lastRow);
        $(this).removeClass('rowfy-addrow btn-success').addClass('rowfy-deleterow btn-danger').text('-');
    });

    /*Delete row event*/
    $(document).on('click', '.rowfy-deleterow', function() {
        $(this).closest('tr').remove();
    });

    /*Initialize all rowfy tables*/
    $('.rowfy').each(function() {
        $('tbody', this).find('tr').each(function() {
            $(this).append('<td><button type="button" class="btn btn-sm ' +
                ($(this).is(":last-child") ?
                    'rowfy-addrow btn-success">+' :
                    'rowfy-deleterow btn-danger">-') +
                '</button></td>');
        });
    });
</script>
<script>
    $(function() {

        $(".thumbnail").fancybox();

        $(document).on("click", ".btn-modal", function(e) {
            e.preventDefault();
            var container = $(this).data("container");

            $.ajax({
                url: $(this).data("href"),
                dataType: "html",
                success: function(result) {
                    $(container).html(result).modal("show");
                    $('.select2').select2();
                },
            });
        });
        //Initialize Select2 Elements
        $('.select2').select2({
            placeholder: `{{ __('Please Select') }}`,
            allowClear: true
        });

        // init custom file input
        bsCustomFileInput.init();

        // init summernote
        $('.summernote').summernote({
            placeholder: '{{ __('Type something') }}',
            tabsize: 2,
            height: $('.summernote').data('height') ?? 300
        });
        $('.in_kind_support_summernote').summernote({
            placeholder: '{{ __('Type something') }}',
            tabsize: 2,
            height: 100,
            width: 500
        });

        // $('.summernote').summernote({
        //     placeholder: '{{ __('Type something') }}',
        //     tabsize: 2,
        //     height: $('.summernote').data('height') ?? 300,
        //     callbacks: {
        //         onInit: function() {
        //             // Clean up initial content
        //             var initialContent = $('.summernote').summernote('code');
        //             var cleanedContent = initialContent.replace(/<p><br><\/p>/g, '');
        //             $('.summernote').summernote('code', cleanedContent);
        //         },
        //         onChange: function(contents, $editable) {
        //             // Optionally, clean up content on change if needed
        //             var cleanedContent = contents.replace(/<p><br><\/p>/g, '');
        //             $('.summernote').summernote('code', cleanedContent);
        //         }
        //     }
        // });
        // $(document).ready(function() {
        //     // Initialize Summernote as before
        //     $('.summernote').summernote({
        //         placeholder: '{{ __('Type something') }}',
        //         tabsize: 2,
        //         height: $('.summernote').data('height') ?? 300
        //     });

        //     $('.in_kind_support_summernote').summernote({
        //         placeholder: '{{ __('Type something') }}',
        //         tabsize: 2,
        //         height: 100,
        //         width: 500
        //     });

        //     // Strip HTML tags before form submission
        //     $('form').on('submit', function(e) {
        //         $('.summernote').each(function() {
        //             var plainText = $(this).summernote('code').replace(
        //                 /<\/?[^>]+(>|$)/g, ""); // Strip HTML tags
        //             $(this).val(
        //                 plainText
        //             ); // Set the stripped text as the value of the textarea
        //         });
        //     });
        // });




        $('.datepicker').datepicker({
            language: "es",
            autoclose: true,
            format: "yyyy-mm-dd",
        });


        // $(".table").DataTable({
        // "responsive": true, "lengthChange": false, "autoWidth": false,
        // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        // }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        // $('#example2').DataTable({
        // "paging": true,
        // "lengthChange": false,
        // "searching": false,
        // "ordering": true,
        // "info": true,
        // "autoWidth": false,
        // "responsive": true,
        // });
    });
</script>

<script>
    $(document).ready(function() {
        // alert(1);
        var success_audio = "{{ URL::asset('sound/success.wav') }}";
        var error_audio = "{{ URL::asset('sound/error.wav') }}";
        var success = new Audio(success_audio);
        var error = new Audio(error_audio);

        const Confirmation = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        });

        @if (Session::has('msg'))
            @if (Session::get('success') == true)
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true
                }
                toastr.success("{{ Session::get('msg') }}");
                success.play();
            @else
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true
                }
                toastr.error("{{ Session::get('msg') }}");
                error.play();
            @endif
        @endif

    });
</script>

<script>
    $(".Checkbox-parent input").on('click', function() {
        var _parent = $(this);
        var nextli = $(this).parent().next().children().children();

        if (_parent.prop('checked')) {
            console.log('Checkbox-parent checked');
            nextli.each(function() {
                $(this).children().prop('checked', true);
            });

        } else {
            console.log('Checkbox-parent un checked');
            nextli.each(function() {
                $(this).children().prop('checked', false);
            });

        }
    });

    $(".Checkbox-child input").on('click', function() {

        var ths = $(this);
        var parentinput = ths.closest('div').prev().children();
        var sibblingsli = ths.closest('ul').find('li');

        if (ths.prop('checked')) {
            console.log('Checkbox-child checked');
            parentinput.prop('checked', true);
        } else {
            console.log('Checkbox-child unchecked');
            var status = true;
            sibblingsli.each(function() {
                console.log('sibb');
                if ($(this).children().prop('checked')) status = false;
            });
            if (status) parentinput.prop('checked', false);
        }
    });

    // show hide accordion

    var acc = document.getElementsByClassName("Accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("Accordion--active");
            var panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
                panel.style.maxHeight = null;
            } else {
                panel.style.maxHeight = panel.scrollHeight + "px";
            }
        });
    }
</script>

@stack('js')
