@extends('layouts.app')
@section('content')

<!-- test -->




<!-- test -->

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
                    </tbody>
                </table>
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>User id</th>
                            <th>Oder id</th>
                            <th>User Name</th>
                            <th>SRI Number</th>
                            <th>Package Value</th>
                            <th>Payment Methode</th>
                            <th>Earnings</th>
                            <th>Created at</th>
                            <th>Package status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $oder)
                        <tr>

                            <td>{{ $oder->uid}}</td>
                            <td>{{ $oder->id}}</td>
                            <td>{{ $oder->fname ." ".$oder->lname}}</td>
                            <td>{{ $oder->sri_number}}</td>
                            <td>{{ $oder->product_value}}</td>
                            <td>{{ $oder->payment_method}}</td>
                            <td>{{ $oder->total_package_earnings}}</td>
                            <td>{{ $oder->created_at}}</td>

                            @if ($oder->status==0)
                            <td>{{ 'Pending' }}</td>
                            @elseif($oder->status==1)
                            <td>{{ 'Activate' }}</td>
                            @elseif($oder->status==2)
                            <td>{{ 'Complete' }}</td>
                            @else
                            <td>{{ 'Canceled' }}</td>
                            @endif
                        </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>

        </div>
    </div>
</div>


@endsection