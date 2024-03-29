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
                    </tbody>
                </table>
                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" style="width:100%">
                    <thead>
                        <tr>
                            <th>User id</th>
                            <th>User Name</th>
                            <th>Daily Commission</th>
                            <th>Oder ID</th>
                            <th>Created at</th>
                            
                            
                        </tr>
                           
                    </thead>
                    <tbody>
                        @foreach ($data as $oder)
            <tr>
            
            <td>{{ $oder->uid}}</td>
            <td>{{ $oder->fname ." ".$oder->lname}}</td>
            <td><span class="curr-val">{{ $oder->amount}}</span></td>
            <td>{{ $oder->oder_id}}</td>
            <td>{{ $oder->created_at}}</td>
            </tr>
            
            @endforeach
                        
                    </tbody>
                   
                </table>
                {{ $data->links() }}
            </div>
            
        </div>
            </div>
        </div>

 @endsection
 @push('styles')
    <style>
        .hidden {
            display: none!important;
        }
    </style>
@endpush