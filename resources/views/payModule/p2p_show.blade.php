@extends('layouts.app')
@section('content')

<div class="content-body">
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-6" >
<div class="mt-2">
    <div class="row">
        <h4 class="font-w600 mb-0 mr-auto mb-2">Recived P2P</h4>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
    <p>{{ $message }}</p>
    </div>
    @endif
    <table class="table table-bordered table-striped dataTable dtr-inline">
    <tr>
    <th>User ID</th>
    <th>User Name</th>
    <th>Request Amount</th>
    <th >Status</th>
    </tr>
  
    @foreach ($data as $user_data) 
    <tr>
    <td>{{ user_data_get($user_data->request_user_id)->id }}</td>
    <td>{{ user_data_get($user_data->request_user_id)->fname.' '.user_data_get($user_data->request_user_id)->lname }}</td>
    <td>{{ $user_data->request_amount }}</td>
   
    @if ($user_data->status == 0)
    <td>{{ 'pending' }}</td>
    @else
    <td>{{ 'success' }}</td>
    @endif
    </tr>
    @endforeach
    </table>
</div>
</div>
<div class="col-md-6" >
<div class="mt-2">
    <div class="row">
        <h4 class="font-w600 mb-0 mr-auto mb-2">Send P2P</h4>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
    <p>{{ $message }}</p>
    </div>
    @endif
    <table class="table table-bordered table-striped dataTable dtr-inline">
    <tr>
    <th>User ID</th>
    <th>User Name</th>
    <th>Send Amount</th>
    <th >Status</th>
    </tr>
  
    @foreach ($data as $user_data) 
    <tr>
    <td>{{ Auth::user()->id }}</td>
    <td>{{ user_data_get(Auth::user()->id)->fname.' '.user_data_get(Auth::user()->id)->lname }}</td>
    <td>{{ $user_data->request_amount }}</td>
   
    
       
    @if ($user_data->status == 0)
    <td>{{ 'pending' }}</td>
    @else
    <td>{{ 'success' }}</td>
    @endif
    </tr>
    @endforeach
    </table>
</div>
</div>
    </div>
</div>
</div>
@endsection