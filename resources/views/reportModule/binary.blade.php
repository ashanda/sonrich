@extends('layouts.app')
@section('content')

<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
    <div class="container-fluid">
        <div class="mt-2">
            <div class="row">
                <div class="col-lg-12 margin-tb">


                </div>
            </div>
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
            <div class="table-responsive">
                <table border="0" cellspacing="5" cellpadding="5">
                    <tbody>
                        <tr>
                            <td>Minimum date:</td>
                            <td><input type="text" id="min" name="min"></td>
                        </tr>
                        <tr>
                            <td>Maximum date:</td>
                            <td><input type="text" id="max" name="max"></td>
                        </tr>
                        <tr>
                            <td>User ID:</td>
                            <td><input type="text" id="user_id" name="user_id"></td>
                        </tr>
                        <tr>
                            <td>Matching Bonus Total:</td>
                            <td><span id="column3_total">0</span></td>
                        </tr>
                        <button type="button" class="btn btn-success" id="printButton">Print</button>
                    </tbody>
                </table>
             
                <table id="example8" class="table table-bordered table-striped dataTable dtr-inline" style="width:100%">
                    <thead>
                        <tr>
                            <th>User id</th>
                            <th>User Name</th>
                            <th>Binary Commission</th>
                            <th>Oder ID</th>
                            <th>Reference Oder ID</th>
                            <th>Created at</th>


                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($data as $oder)
                        <tr>

                            <td>{{ $oder->uid}}</td>
                            <td>{{ $oder->fname ." ".$oder->lname}}</td>
                            <td>{{ $oder->amount}}</td>
                            <td>{{ $oder->oder_id}}</td>
                            <td>{{ $oder->reference_oder_id}}</td>
                            <td>{{ $oder->created_at}}</td>
                        </tr>

                        @endforeach

                    </tbody>

                </table>
            </div>

        </div>
    </div>
</div>

@endsection

@section('script')
<script>
        var minDate, maxDate,userId,column3Total;

        // Custom filtering function which will search data in column four between two values
        $.fn.dataTable.ext.search.push(
            function (settings, data, dataIndex) {
                var min = minDate.val();
                var max = maxDate.val();
                var userId = $('#user_id').val();
                var date;

                if (data[5]) {
                    date = new Date(data[5]);
                } else if (data[4]) {
                    date = new Date(data[4]);
                } else if (data[0]) {
                    date = new Date(data[0]);
                } else {
                    console.error("Date not found in data array");
                }

                if (
                    (min === null && max === null) ||
                    (min === null && date <= max) ||
                    (min <= date && max === null) ||
                    (min <= date && date <= max)
                ) {
                    if (userId === '' || data[0] === userId) { // Assuming user_id is in the 7th column (index 6)
                         column3Total += parseFloat(data[2]);
                        return true;
                    }
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

            // DataTables initialization
            //   var table = $('#example1,#example3,#example4,#example5,#example6').DataTable();
            var table = $('#example8').DataTable({
                responsive: true,
                lengthChange: true,
                autoWidth: false,
                paging: true,
                
            });

            // Refilter the table
            $('#min, #max, #user_id').on('change', function () {
                column3Total = 0;
                table.draw();
            });
            // After table is drawn, display column 3 total
            table.on('draw', function () {
                $('#column3_total').text(column3Total);
            });
        });
    </script>
    <script>
    // Add event listener to the print button
    document.getElementById('printButton').addEventListener('click', function() {
        // Simulate Ctrl+P key press
        window.print();
    });
</script>
@endsection