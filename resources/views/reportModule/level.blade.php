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
                <table id="example2" class="table table-bordered table-striped dataTable dtr-inline" style="width:100%">
                    <thead>
                        <tr>
                            <th>User id</th>
                            <th>User Name</th>
                            <th>Level Commission</th>
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