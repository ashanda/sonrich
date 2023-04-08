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
                                    <span class="input-group-text btn btn-primary text-white" id="basic-addon1"><i
                                            class="fas fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" id="start_date" placeholder="Start Date"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text btn btn-primary text-white" id="basic-addon1"><i
                                            class="fas fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" id="end_date" placeholder="End Date" readonly>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button id="filter" class="btn btn-primary">Filter</button>
                        <button id="reset" class="btn btn-warning">Reset</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-instructions">
                        <p>
                            2 : 20,000 Package ,
                            3 : 30,000 Package ,
                            4 : 50,000 Package ,
                            5 : 100,000 Package <br>
                            RC : Real Cassh ,
                            PW : Product Wallet ,
                            SF : Sponser Funds ,
                            WC : Wallet + Real Cash ,
                        </p>
                    </div>
                    <div class="table-responsive">
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
                        <div class="table-responsive">
                            <table class="cell-border" id="records_table" style="width:100%">
    
                                <thead>
                                   
                                    <tr>
                                        <tr>
                                            <th>User ID</th>
                                            <th>D Code</th>
                                            <th>RC-2</th>
                                            <th>SF-2</th>
                                            <th>PW-2</th>
                                            <th>WC-2</th>

                                            <th>RC-3</th>
                                            <th>SF-3</th>
                                            <th>PW-3</th>
                                            <th>WC-3</th>

                                            <th>RC-5</th>
                                            <th>SF-5</th>
                                            <th>PW-5</th>
                                            <th>WC-5</th>

                                            <th>RC-10</th>
                                            <th>SF-10</th>
                                            <th>PW-10</th>
                                            <th>WC-10</th>
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
