@extends('layouts.app')
@section('content')

   <!--**********************************
            Content body start
        ***********************************-->
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
            <div class="table-responsive">
                <table id="example2" class="dataTable" style="width:100%">
                    <thead>
                        <tr>
                            <th>User id</th>
                            <th>User Name</th>
                            <th>Package Value</th>
                            <th>Payment Methode</th>
                            <th>Created at</th>
                            <th>Package status</th>
                            <th width="280px">Action</th>
                        </tr>
                           
                    </thead>
                    <tbody>
                        @foreach ($data as $oder)
            <tr>
            
            <td>{{ $oder->uid}}</td>
            <td>{{ $oder->fname ." ".$oder->lname}}</td>
            <td>{{ $oder->product_value}}</td>
            <td>{{ $oder->payment_method}}</td>
            <td>{{ $oder->created_at}}</td>
            
            @if ($oder->status==0)
            <td>{{ 'Pending' }}</td>
            @elseif($oder->status==1)
            <td>{{ 'Activate' }}</td>
            @else
            <td>{{ 'Rejected' }}</td>
            @endif
            <td>
                
                <a class="btn btn-primary" href="{{ route('oders.edit',$oder->id) }}">View</a>
                <a href="#myModal" class="btn btn-danger" id="aButton" data-toggle="modal">Delete</a>
                
            </td>
            <!-- Modal HTML -->
            <div id="myModal" class="modal fade">
                <div class="modal-dialog modal-confirm">
                    <div class="modal-content">
                        <div class="modal-header flex-column">
                            <div class="icon-box">
                                
                            </div>						
                            <h4 class="modal-title w-100">Are you sure?</h4>	
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p>Do you really want to delete this package ?</p>
                        </div>
                        <form action="{{ route('oders.destroy',$oder->id) }}" method="Post">
                        @csrf
                        @method('DELETE')
                        <div class="modal-footer justify-content-center">
                            <button type="submit" class="btn btn-danger">Delete</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            
                        </div>
                     
                  </form>
                    </div>
                </div>
            </div>
            
            
            </tr>
           
            @endforeach
                        
                    </tbody>
                   
                </table>
            </div>
            
        </div>
            </div>
        </div>

 @endsection