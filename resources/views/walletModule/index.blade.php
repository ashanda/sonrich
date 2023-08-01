@extends('layouts.app')

@section('content')
<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
    <!-- New wallet sec -->
    @if (Auth::user()->role == 0 || Auth::user()->role == 1)
    <div class="container-fluid wallt pb-2">
        <div class="form-head mb-sm-5 mb-3 d-flex align-items-center flex-wrap">
            <h4 class="font-w600 mb-0 mr-auto mb-2">My Wallet</h4>
        </div>
        <div class="wall_sec">

            <div class="data_sec mt-3">
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <div class="card p-5 w-75 mx-auto">
                            <div class="row text-center">
                                <div class="col-12">
                                    <h2 class="left text-bold">Total Earnings</h2>
                                </div>
                                <div class="col-12">
                                    <h2 class="right text-bold">BV <span class="curr-val">{{ number_format(direct_total() + level_total() + binary_total() + daily_total(), 2, '.', ',') }}</span> </h2>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Newly aded section -->
                <div class="row">
                    <div class="col-sm-6 col-xs-12 pt-2">
                        <div class="card p-3 mr-0 mr-md-5">
                            <div class="row">
                                <div class="col-7">
                                    <span class="left">Binary Left</span>
                                </div>
                                <div class="col-5">
                                    @if (binary_point(Auth::user()->id) == null )
                                    <span class="right">BV <span class="curr-val">0</span></span>
                                    @else
                                    <span class="right">BV <span class="curr-val">{{ binary_point(Auth::user()->id)->left_total*1000 }}</span></span>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-12 pt-2">
                        <div class="card p-3 ml-0 ml-md-5">
                            <div class="row">
                                <div class="col-7">
                                    <span class="left">Binary Right</span>
                                </div>
                                <div class="col-5">
                                    @if (binary_point(Auth::user()->id) == null )
                                    <span class="right">BV <span class="curr-val">0</span></span>
                                    @else
                                    <span class="right">BV <span class="curr-val">{{ binary_point(Auth::user()->id)->right_total*1000 }}</span></span>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-xs-12 pt-2">
                        <div class="card p-3 mr-0 mr-md-5">
                            <div class="row">
                                <div class="col-7">
                                    <span class="left">Product Wallet</span>
                                </div>
                                <div class="col-5">
                                    @if (product_wallet() == null )
                                    <span class="right">BV <span class="curr-val">0</span></span>
                                    @else
                                    <span class="right">BV <span class="curr-val">{{ product_wallet()->wallet_balance }}</span></span>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-12 pt-2">
                        <div class="card p-3 ml-0 ml-md-5">
                            <div class="row">
                                <div class="col-7">
                                    <span class="left">Cash Wallet</span>
                                </div>
                                <div class="col-5">
                                    @if (cash_wallet(Auth::user()->id) == null )
                                    <span class="right">BV <span class="curr-val">0</span></span>
                                    @else
                                    <span class="right">BV <span class="curr-val">{{ cash_wallet(Auth::user()->id)->wallet_balance }}</span></span>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Newly aded section -->
                <div class="row">
                    <div class="col-sm-6 col-xs-12 pt-2">
                        <div class="card p-3 mr-0 mr-md-5">
                            <div class="row">
                                <div class="col-7">
                                    <span class="left">Daily Commission</span>
                                </div>
                                <div class="col-5">
                                    <span class="right">BV <span class="curr-val">{{ daily_total() }}</span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-12 pt-2">
                        <div class="card p-3 ml-0 ml-md-5">
                            <div class="row">
                                <div class="col-7">
                                    <span class="left">Binary Commission</span>
                                </div>
                                <div class="col-5">
                                    <span class="right">BV <span class="curr-val">{{ binary_total() }}</span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-xs-12 pt-2">
                        <div class="card p-3 mr-0 mr-md-5">
                            <div class="row">
                                <div class="col-7">
                                    <span class="left">Level Commission</span>
                                </div>
                                <div class="col-5">
                                    <span class="right">BV <span class="curr-val">{{ level_total() }}</span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-12 pt-2">
                        <div class="card p-3 ml-0 ml-md-5">
                            <div class="row">
                                <div class="col-7">
                                    <span class="left">Direct Sale Commission</span>
                                </div>
                                <div class="col-5">
                                    <span class="right">BV <span class="curr-val">{{ direct_total() }}</span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            @if (Auth::user()->role == 0 || Auth::user()->role == 1)
            <h5><a class="btn btn-primary" href="/withdrawal">Withdrawal</a></h5>
            @endif
            <div class="text-center blue p-3">
                Transaction History
            </div>

        </div>

    </div>

    @endif

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
                    <table id="example1" class="table table-bordered table-hover dataTable dtr-inline" style="width:100%">
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
                                <td>BV <span class="curr-val">{{ $withdrawel->request_amount }}</span></td>
                                <td>BV <span class="curr-val">{{ $withdrawel->company_fee}}</span></td>
                                <td>BV <span class="curr-val">{{ $withdrawel->tranfer_amount}}</span></td>

                                @if ($withdrawel->status=='0')
                                <td>{{ 'Pending' }}</td>
                                @elseif($withdrawel->status=='1')
                                <td>{{ 'Approve' }}</td>
                                @elseif($withdrawel->status=='2')
                                <td>{{ 'reject' }}</td>
                                @endif


                                @if (Auth::user()->role == 1)
                                <td>
                                    <form action="{{ route('withdraw.update',$withdrawel->id) }}" method="POST">

                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="request_amount" value={{ $withdrawel->request_amount}}>
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

</div>
<!--**********************************
            Content body end
        ***********************************-->
@endsection