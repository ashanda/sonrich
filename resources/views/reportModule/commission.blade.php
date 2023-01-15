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
                            <th>Date</th>
                            <th>Direct Bonus</th>
                            <th>Matching Bonus</th>
                            <th>Level Bonus</th>
                            <th>Daily bonus</th>
                            <th>Total</th>
                            
                            
                        </tr>
                           
                    </thead>
                    <tbody>
                       
                        @foreach ($data as $oder)
            <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
           
            </tr>
           
            @endforeach
                        
                    </tbody>
                   
                </table>
            </div>
            
        </div>
            </div>
        </div>

 @endsection