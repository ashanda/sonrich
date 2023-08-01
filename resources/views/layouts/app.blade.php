</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
    <!-- BS Stepper -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/bs-stepper/css/bs-stepper.min.css') }}">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/dropzone/min/dropzone.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <!-- Custom style -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- test -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.2.0/css/dataTables.dateTime.min.css">
    <!-- test -->

</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        @include('includes.navbar')


        @include('includes.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @include('sweetalert::alert')
            <!-- Content -->
            @yield('content')
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; <script type="text/javascript">
                    document.write(new Date().getFullYear());
                </script> <a href="">Company Name</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('adminlte/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
    <!-- InputMask -->
    <script src="{{ asset('adminlte/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- bootstrap color picker -->
    <script src="{{ asset('adminlte/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">
    </script>
    <!-- BS-Stepper -->
    <script src="{{ asset('adminlte/plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
    <!-- dropzonejs -->
    <script src="{{ asset('adminlte/plugins/dropzone/min/dropzone.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('adminlte/dist/js/demo.js') }}"></script>
    <!-- Datepicker -->

    <!-- test -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.2.0/js/dataTables.dateTime.min.js"></script>
    <!-- Datepicker -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <!-- Datatables -->

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>


    <!-- test -->


    <!-- Custom script -->
    <script src="{{ asset('js/script.js') }}"></script>
    @yield('script')


    {{-- <script>
        $(function () {
            $("#example1")
                .DataTable({
                    responsive: true,
                    lengthChange: true,
                    autoWidth: false,
                    paging: true,
                })
                .buttons()
                .container()
                .appendTo("#example1_wrapper .col-md-6:eq(0)");

            $("#example3,#example4,#example5,#example6").DataTable({
                responsive: true,
                lengthChange: false,
                autoWidth: false,
                searching: false,
                paging: true,
            });

        });

        // daterange
        var minDate, maxDate;

        // Custom filtering function which will search data in column four between two values
        $.fn.dataTable.ext.search.push(
            function (settings, data, dataIndex) {
                var min = minDate.val();
                var max = maxDate.val();
                // var date = new Date(data[5]);
                var data;
                var date;

                if (data[5]) {
                    date = new Date(data[5]);
                } else if (data[4]) {
                    date = new Date(data[4]);
                } else if (data[0]) {
                    date = new Date(data[0]);
                } else {
                    // throw an error or set date to a default value
                    console.error("Date not found in data array");
                }

                if (
                    (min === null && max === null) ||
                    (min === null && date <= max) ||
                    (min <= date && max === null) ||
                    (min <= date && date <= max)
                ) {
                    return true;
                }
                return false;
            }
        );

        $(document).ready(function () {
            // Create date inputs
            minDate = new DateTime($('#min'), {
                format: 'MMMM Do YYYY'
            });
            maxDate = new DateTime($('#max'), {
                format: 'MMMM Do YYYY'
            });

            // DataTables initialisation
            var table = $('#example1,#example3,#example4,#example5,#example6').DataTable();

            // Refilter the table
            $('#min, #max').on('change', function () {
                table.draw();
            });
            
        });

    </script> --}}
    <script>
        $(document).ready(function() {
            $("#start_date").datepicker({
                "dateFormat": "yy-mm-dd"
            });
            $("#end_date").datepicker({
                "dateFormat": "yy-mm-dd"
            });
        });
        // Fetch records
        function fetch(start_date, end_date) {
            $.ajax({
                url: "{{ route('future_plan_sales/records') }}",
                type: "GET",
                data: {
                    start_date: start_date,
                    end_date: end_date
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: "json",
                success: function(data) {
                    
                    // Datatables
                    var i = 1;
                    $('#records').DataTable({
                        "data": data.students,
                        // responsive
                        "responsive": true,
                        "columns": [{
                                "data": "id",
                                "render": function(data, type, row, meta) {
                                    return i++;
                                }
                            },
                            {
                                "data": "user_id",
                                "render": function(data, type, row, meta) {
                                    return `${row.user_id}`;
                                }
                            },
                            {
                                "data": "srr_number",
                                "render": function(data, type, row, meta) {
                                    return `${row.srr_number}`;
                                }
                            },
                            {
                                "data": "RCT",

                                "render": function(data, type, row, meta) {
                                    //console.log(row.RCT);
                                    return `${row.RCT}`;
                                }
                            },
                            {
                                "data": "SFT",
                                "render": function(data, type, row, meta) {
                                    // console.log(typeof row.SFT);
                                    return `${row.SFT}`;
                                }
                            },
                            {
                                "data": "PWT",
                                "render": function(data, type, row, meta) {
                                    return `${row.PWT}`;
                                }
                            },
                            {
                                "data": "WCT",
                                "render": function(data, type, row, meta) {
                                    return `${row.WCT}`;
                                }
                            },
                            {
                                "data": "package1",
                                "render": function(data, type, row, meta) {
                                    return `${row.package1}`;
                                }
                            },
                            {
                                "data": "package2",
                                "render": function(data, type, row, meta) {
                                    return `${row.package2}`;
                                }
                            },
                            {
                                "data": "package3",
                                "render": function(data, type, row, meta) {
                                    return `${row.package3}`;
                                }
                            },
                            {
                                "data": "package4",
                                "render": function(data, type, row, meta) {
                                    return `${row.package4}`;
                                }
                            },

                            {
                                "data": "sri_number",
                                "render": function(data, type, row, meta) {
                                    return `${row.sri_number}`;
                                }
                            },
                            {
                                "data": "fname",
                                "render": function(data, type, row, meta) {
                                    return `${row.fname} ${row.lname}`;
                                }
                            },
                            {
                                "data": null,
                                "defaultContent": "",
                                "className": "dt-right",
                                "orderable": false,
                                "searchable": false,
                                "render": function(data, type, row, meta) {
                                    var total = parseInt(row.RCT) + parseInt(row.SFT) + parseInt(row.PWT) + parseInt(row.WCT);
                                    return total;
                                }
                            },



                        ],

                        dom: 'Bfrtip',
                        "buttons": [{
                                extend: 'copy',
                                title: $('title').text(),
                                filename: function() {
                                    return $('title').text().replace(/[^a-zA-Z0-9]/g, '_');
                                }
                            },
                            {
                                extend: 'csv',
                                title: $('title').text(),
                                filename: function() {
                                    return $('title').text().replace(/[^a-zA-Z0-9]/g, '_');
                                }
                            },
                            {
                                extend: 'excel',
                                title: $('title').text(),
                                filename: function() {
                                    return $('title').text().replace(/[^a-zA-Z0-9]/g, '_');
                                }
                            },
                            {
                                extend: 'pdf',
                                title: $('title').text(),
                                filename: function() {
                                    return $('title').text().replace(/[^a-zA-Z0-9]/g, '_');
                                }
                            },
                            {
                                extend: 'print',
                                title: $('title').text(),
                                filename: function() {
                                    return $('title').text().replace(/[^a-zA-Z0-9]/g, '_');
                                }
                            }
                        ],

                    });


                    $('#records_table').DataTable({
                        "data": data.students,
                        // responsive
                        "responsive": true,
                        "columns": [

                            {
                                "data": "user_id",
                                "render": function(data, type, row, meta) {

                                    return `${row.user_id}`;
                                }
                            },

                            {
                                "data": "srr_number",
                                "render": function(data, type, row, meta) {
                                    return `${row.srr_number}`;
                                }
                            },

                            {
                                "data": "RC1",
                                "render": function(data, type, row, meta) {
                                    return `${row.RC1}`;
                                }
                            },
                            {
                                "data": "SF1",
                                "render": function(data, type, row, meta) {
                                    return `${row.SF1}`;
                                }
                            },
                            {
                                "data": "PW1",
                                "render": function(data, type, row, meta) {
                                    return `${row.PW1}`;
                                }
                            },
                            {
                                "data": "WC1",
                                "render": function(data, type, row, meta) {
                                    return `${row.WC1}`;
                                }
                            },

                            {
                                "data": "RC2",
                                "render": function(data, type, row, meta) {
                                    return `${row.RC2}`;
                                }
                            },
                            {
                                "data": "SF2",
                                "render": function(data, type, row, meta) {
                                    return `${row.SF2}`;
                                }
                            },
                            {
                                "data": "PW2",
                                "render": function(data, type, row, meta) {
                                    return `${row.PW2}`;
                                }
                            },
                            {
                                "data": "WC2",
                                "render": function(data, type, row, meta) {
                                    return `${row.WC2}`;
                                }
                            },

                            {
                                "data": "RC3",
                                "render": function(data, type, row, meta) {
                                    return `${row.RC3}`;
                                }
                            },
                            {
                                "data": "SF3",
                                "render": function(data, type, row, meta) {
                                    return `${row.SF3}`;
                                }
                            },
                            {
                                "data": "PW3",
                                "render": function(data, type, row, meta) {
                                    return `${row.PW3}`;
                                }
                            },
                            {
                                "data": "WC3",
                                "render": function(data, type, row, meta) {
                                    return `${row.WC3}`;
                                }
                            },

                            {
                                "data": "RC4",
                                "render": function(data, type, row, meta) {
                                    return `${row.RC4}`;
                                }
                            },
                            {
                                "data": "SF4",
                                "render": function(data, type, row, meta) {
                                    return `${row.SF4}`;
                                }
                            },
                            {
                                "data": "PW4",
                                "render": function(data, type, row, meta) {
                                    return `${row.PW4}`;
                                }
                            },
                            {
                                "data": "WC4",
                                "render": function(data, type, row, meta) {
                                    return `${row.WC4}`;
                                }
                            },
                            {
                                "data": null,
                                "defaultContent": "",
                                "className": "dt-right",
                                "orderable": false,
                                "searchable": false,
                                "render": function(data, type, row, meta) {
                                    var total = parseInt(row.RC1) + parseInt(row.RC2) + parseInt(row.RC3) + parseInt(row.RC4) + parseInt(row.SF1) + parseInt(row.SF2) + parseInt(row.SF3) + parseInt(row.SF4) + parseInt(row.PW1) + parseInt(row.PW2) + parseInt(row.PW3) + parseInt(row.PW4) + parseInt(row.WC1) + parseInt(row.WC2) + parseInt(row.WC3) + parseInt(row.WC4);
                                    return total;
                                }
                            },

                        ],


                        dom: 'Bfrtip',
                        "buttons": [{
                                extend: 'copy',
                                title: $('title').text(),
                                filename: function() {
                                    return $('title').text().replace(/[^a-zA-Z0-9]/g, '_');
                                }
                            },
                            {
                                extend: 'csv',
                                title: $('title').text(),
                                filename: function() {
                                    return $('title').text().replace(/[^a-zA-Z0-9]/g, '_');
                                }
                            },
                            {
                                extend: 'excel',
                                title: $('title').text(),
                                filename: function() {
                                    return $('title').text().replace(/[^a-zA-Z0-9]/g, '_');
                                }
                            },
                            {
                                extend: 'pdf',
                                title: $('title').text(),
                                filename: function() {
                                    return $('title').text().replace(/[^a-zA-Z0-9]/g, '_');
                                }
                            },
                            {
                                extend: 'print',
                                title: $('title').text(),
                                filename: function() {
                                    return $('title').text().replace(/[^a-zA-Z0-9]/g, '_');
                                }
                            }
                        ],

                    });
                }
            });
        }
        fetch();
        // Filter
        $(document).on("click", "#filter", function(e) {
            e.preventDefault();
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();
            if (start_date == "" || end_date == "") {
                alert("Both date required");
            } else {
                $('#records').DataTable().destroy();
                $('#records_table').DataTable().destroy();
                fetch(start_date, end_date);

            }
        });
        // Reset
        $(document).on("click", "#reset", function(e) {
            e.preventDefault();
            $("#start_date").val(''); // empty value
            $("#end_date").val('');
            $('#records').DataTable().destroy();
            $('#records_table').DataTable().destroy();
            fetch();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.price:not(.LKR)').hide();

            $('#currencySelect').change(function() {
                var currency = $(this).find(':selected').data('currency');
                $('.price').hide();
                $('.price.' + currency).show();
            });

            // Set initial currency selection on page load
            var initialCurrency = $('#currencySelect').find(':selected').data('currency');
            $('.price').hide();
            $('.price.' + initialCurrency).show();
        });
    </script>


    <!-- Currency changing script -->
    <script>
        var programmaticallyChanged = false;
        
        var divisionFactor = 100; // Replace with your desired value

        function updateCurrency() {
            var x = document.getElementById("modeSelect").value;
            // Save the selected value in localStorage
            localStorage.setItem("selectedMode", x);

            // Update the currency values based on the selected option
            if (x === "curr1") {
                // Do not change the data in class "curr-val"
            } else if (x === "curr2") {
                // Divide the data in class "curr-val" by the divisionFactor variable
                var currValElements = document.getElementsByClassName("curr-val");
                for (var i = 0; i < currValElements.length; i++) {
                    var value = parseFloat(currValElements[i].textContent.replace(/,/g, ''));
                    value = value / divisionFactor;
                    currValElements[i].textContent = value.toFixed(2);
                }
            }

            // Manually trigger the page reload by navigating to the same page with the updated values
            if (!programmaticallyChanged) {
                programmaticallyChanged = true;
                window.location.href = window.location.href;
            } else {
                programmaticallyChanged = false;
            }
        }

        // Call the function on page load to update the values
        window.onload = function() {
          
            var storedValue = localStorage.getItem("selectedMode");
            if (storedValue) {
                document.getElementById("modeSelect").value = storedValue;
                programmaticallyChanged = true;
                updateCurrency(); // Update the elements based on the selected value and reload the page
            }
        };
    </script>



</body>

</html>