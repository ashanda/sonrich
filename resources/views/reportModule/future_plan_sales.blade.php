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
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="display" id="records" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Delivery code</th>
                                    <th>2</th>
                                    <th>3</th>
                                    <th>5</th>
                                    <th>10</th>
                                    <th>SRI#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
 
                                {{-- @foreach ($results as $data)
                                <tr>
                                
                                <td>*</td>
                                <td>{{ $data->srr_number}}</td>
                                <td>{{ $data->package1}}</td>
                                <td>{{ $data->package2}}</td>
                                <td>{{ $data->package3}}</td>
                                <td>{{ $data->package4}}</td>
                                <td>{{ $data->sri_number}}</td>
                                <td>{{ $data->fname ." ".$data->lname}}</td>
                                <td>{{ $data->email}}</td>

                                </tr>
                            
                                @endforeach --}}
                                            
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
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        </div>
    </div>


@endsection