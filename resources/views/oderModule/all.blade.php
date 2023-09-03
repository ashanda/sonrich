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
                
                <table id="example8" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="min-width: 50px;">User id</th>
                            <th style="min-width: 60px;">Oder id</th>
                            <th style="min-width: 80px;">User Name</th>
                            <th style="min-width: 90px;">SRI Number</th>
                            <th style="min-width: 110px;">Package Value</th>
                            <th style="min-width: 100px;">Pay by Wallet</th>
                            <th style="min-width: 90px;">Pay by Cash</th>  
                            <th style="min-width: 130px;">Payment Methode</th>
                            <th style="min-width: 50px;">Earnings</th>
                            <th style="min-width: 80px;">Created at</th>
                            <th style="min-width: 120px;">Package status</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach ($data as $oder)
                        <tr>
                            <td>{{ $oder->uid}}</td>
                            <td>{{ $oder->id}}</td>
                            <td>{{ $oder->fname ." ".$oder->lname}}</td>
                            <td>{{ $oder->sri_number}}</td>
                            <td><span class="curr-val">{{ $oder->product_value}}</span></td>
                            <td><span class="curr-val">{{ $oder->wallet_pay_amount}}</span></td>
                            <td><span class="curr-val">{{ $oder->cash_pay_amount}}</span></td>
                            <td>{{ $oder->payment_method}}</td>
                            <td><span class="curr-val">{{ $oder->total_package_earnings}}</span></td>
                            <td>{{$oder->created_at}}</td>

                            @if ($oder->status==0)
                            <td>{{ 'Pending' }}</td>
                            @elseif($oder->status==1)
                            <td><a href="{{ route('daily_commission_status', $oder->id) }}">{{ 'Activate' }}</a></td>
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