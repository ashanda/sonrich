@extends('layouts.app')
@section('content')

<div class="content-body">

    <div class="container-fluid">
        <div class="mt-2">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Add Gas Fee</h2>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-6">
                    <form id="stepregForm" class="stepregForm PT-3" action="{{ route('gas_fee_collect.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="tab pb-3">
                            <div class="form-group">
                                <label for="mobNo1" class="form-label">User ID</label>
                                <input class="form-control vali" placeholder="" name="user_id">
                            </div>
                            <div class="form-group">
                                <label for="mobNo2" class="form-label">Gas Fee</label>
                                <input class="form-control vali" placeholder="" name="gas_fee">
                            </div>
                            <div class="form-group">
                                <label for="mobNo2" class="form-label">Last Earn </label>
                                <input class="form-control vali" placeholder="" name="last_earn">
                            </div>
                          
                            <button type="submit" class="btn btn-primary">Submit</button>
                           
                        </div>
                    </div>   
            </div>      
        </div>


    </div>
</div>
    @endsection