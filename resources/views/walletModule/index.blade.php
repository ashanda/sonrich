@extends('layouts.app')

@section('content')
   <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- New wallet sec -->
            @if (Auth::user()->role == 0 || Auth::user()->role == 1)
            <div class="container-fluid wallt pb-4">
                <div class="form-head mb-sm-5 mb-3 d-flex align-items-center flex-wrap">
                    <h4 class="font-w600 mb-0 mr-auto mb-2">My Wallet</h4>
                </div>
                <div class="wall_sec">
                    @if (Auth::user()->role == 0)
                    <div class="row text-center">
                        <a href="/withdrawal">
                            <div class="bg_blue"> Withdrawals</div>
                        </a>
                        
                    </div>
                    @endif
                    <div class="data_sec mt-3">
                        <div class="row">
                            <div class="col-sm-6 col-xs-12">
                                <div class="dark_blue">
                                    <span class="left">Daily Commission</span>
                                    <span class="right">BV {{ daily_total() }}</span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="dark_blue">
                                    <span class="left">Binary Commission</span>
                                    <span class="right">BV {{ binary_total() }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-xs-12">
                                <div class="dark_blue">
                                    <span class="left">Level Commission</span>
                                    <span class="right">BV {{ level_total() }}</span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="dark_blue">
                                    <span class="left">Direct Sale Commission</span>
                                    <span class="right">BV {{ direct_total() }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-xs-12">
                                <div class="dark_blue">
                                    <span class="left">Total Earnings</span>
                                    <span class="right">{{ direct_total() + level_total() + binary_total() + daily_total()}}  </span>
                                </div>
                            </div>  
                        </div>
                    </div>
                    <div class="text-center blue my-3 p-3">
                        Transaction History
                    </div>
        
                </div>

            </div>
  
            @endif

        <div class="content-body">
			<div class="container-fluid">
        <div class="container mt-2">
            <div class="row">
            <div class="col-lg-12 margin-tb">
            </div>
            </div>
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
            <p>{{ $message }}</p>
            </div>
            @endif
            <table id="example2" class="display" style="width:100%">
                <thead>
            <tr>
            <th>No</th>
            <th>User Name</th>
            <th>User ID</th>
            <th>Requested Amount</th>
            <th>Campany Fee</th>
            <th>Tranfer Amount</th>
            <th>Withdrawel status</th>
            @if (Auth::user()->role == 1)
            <th>Action</th>
            @endif
            </tr>
        </thead>
            @php
                $i = 1;
            @endphp
            <tbody>
            @foreach ($data as $withdrawel)
            <tr>
            <td>{{ $i }}</td>
            <td>{{ $withdrawel->fname ." ".$withdrawel->lname }}</td>
             <td>{{ $withdrawel->uid }}</td>
            <td>BV {{ $withdrawel->request_amount }}</td>
            <td>BV {{ $withdrawel->company_fee}}</td>
            <td>BV {{ $withdrawel->tranfer_amount}}</td>
            
            @if ($withdrawel->status=='0')
            <td>{{ 'Pending' }}</td>
            @elseif($withdrawel->status=='1')
            <td>{{ 'Approve' }}</td> 
            @elseif($withdrawel->status=='2')
            <td>{{ 'reject' }}</td>
            @endif
            <td>
            @if (Auth::user()->role == 1)
            <td>
            <form action="{{ route('withdraw.update',$withdrawel->id) }}" method="POST">
              
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-danger">Approve</button>
            </form>
            </td>
            @endif
            
            
            
            </tr>
            @php
                $i++;
            @endphp
            @endforeach
        </tbody>
            </table>
        </div>
            </div>
        </div>
    
</div>
        <!--**********************************
            Content body end
        ***********************************-->
@endsection