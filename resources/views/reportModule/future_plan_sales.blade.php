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
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text btn btn-primary text-white" id="basic-addon1"><i class="fas fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" id="start_date" placeholder="Start Date" readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text btn btn-primary text-white" id="basic-addon1"><i class="fas fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" id="end_date" placeholder="End Date" readonly>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button id="filter" class="btn btn-primary">Filter</button>
                        <button id="reset" class="btn btn-warning">Reset</button>
                        <button class="btn btn-secondary float-right" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            Key Compass
                        </button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-instructions">
                        <!-- <p>
                            2 : 20,000 Package ,
                            3 : 30,000 Package ,
                            4 : 50,000 Package ,
                            5 : 100,000 Package <br>
                            RC : Real Cash ,
                            PW : Product Wallet ,
                            SF : Sponser Funds ,
                            WC : Wallet + Real Cash ,
                        </p> -->

                        <div class="collapse mt-2" id="collapseExample">
                            <div class="card card-body">
                                <div class="row">
                                    <div class="col-6 border-right">
                                        <h6><b>Packages</b></h6>
                                        <p>2 : <span class="curr-val">20000</span> Package</p>
                                        <p>3 : <span class="curr-val">30000</span>Package</p>
                                        <p>5 : <span class="curr-val">50000</span>Package</p>
                                        <p>10 : <span class="curr-val">100000</span>Package</p>
                                    </div>
                                    <div class="col-6 pl-md-4">
                                        <h6><b>Abbreviations</b></h6>
                                        <p>RC : Real Cash</p>
                                        <p>PW : Product Wallet</p>
                                        <p>SF : Sponser Funds</p>
                                        <p>WC : Wallet + Real Cash</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <h5 class="mt-4 mb-3">Summery</h5>
                        <table class="cell-border" id="records" style="width:100%">

                            <thead>

                                <tr>
                                    <th>No</th>
                                    <th>User ID</th>
                                    <th>D Code</th>
                                    <th>Real Cash</th>
                                    <th>Sponser Funds</th>
                                    <th>Product Wallet</th>
                                    <th>Wallte + Cash</th>
                                    <th>2</th>
                                    <th>3</th>
                                    <th>5</th>
                                    <th>10</th>
                                    <th>SRI#</th>
                                    <th>Name</th>
                                    <th>Total</th>

                                </tr>
                            </thead>
                            <tbody>



                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="table-responsive hov-ttle">
                            <h5 class="mt-4 mb-3">Detailed Summery</h5>
                            <table class="cell-border" id="records_table" style="width:100%">

                                <thead>

                                    <tr>
                                    <tr>
                                        <th>User ID</th>
                                        <th>D Code</th>
                                        <th class="hov-th">RC-2 <span class="hov">Real Cash <br> <span class="curr-val">20000</span> Package</span></th>
                                        <th class="hov-th">SF-2 <span class="hov">Sponser Funds <br> <span class="curr-val">20000</span> Package</span></th>
                                        <th class="hov-th">PW-2 <span class="hov">Product Wallet <br> <span class="curr-val">20000</span> Package</span></th>
                                        <th class="hov-th">WC-2 <span class="hov">Wallet + Real Cash <br> <span class="curr-val">20000</span> Package</span></th>

                                        <th class="hov-th">RC-3 <span class="hov">Real Cash <br> <span class="curr-val">30000</span> Package</span></th>
                                        <th class="hov-th">SF-3 <span class="hov">Sponser Funds <br> <span class="curr-val">30000</span> Package</span></th>
                                        <th class="hov-th">PW-3 <span class="hov">Product Wallet <br> <span class="curr-val">30000</span> Package</span></th>
                                        <th class="hov-th">WC-3 <span class="hov">Wallet + Real Cash <br> <span class="curr-val">30000</span> Package</span></th>

                                        <th class="hov-th">RC-5 <span class="hov">Real Cash <br> <span class="curr-val">50000</span> Package</span></th>
                                        <th class="hov-th">SF-5 <span class="hov">Sponser Funds <br> <span class="curr-val">50000</span> Package</span></th>
                                        <th class="hov-th">PW-5 <span class="hov">Product Wallet <br> <span class="curr-val">50000</span> Package</span></th>
                                        <th class="hov-th">WC-5 <span class="hov">Wallet + Real Cash <br> <span class="curr-val">50000</span> Package</span></th>

                                        <th class="hov-th">RC-10 <span class="hov">Real Cash <br> <span class="curr-val">100000</span> Package</span></th>
                                        <th class="hov-th">SF-10 <span class="hov">Sponser Funds <br> <span class="curr-val">100000</span> Package</span></th>
                                        <th class="hov-th">PW-10 <span class="hov">Product Wallet <br> <span class="curr-val">100000</span> Package</span></th>
                                        <th class="hov-th">WC-10 <span class="hov">Wallet + Real Cash <br> <span class="curr-val">100000</span> Package</span></th>
                                        <th>Total</th>
                                    </tr>
                                    </tr>
                                </thead>
                                <tbody>


                                </tbody>

                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>


@endsection