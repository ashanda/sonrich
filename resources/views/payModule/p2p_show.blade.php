@extends('layouts.app')
@section('content')

<div class="content-body">
    <div class="container-fluid">
<div class="mt-2">
    <div class="row">

    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
    <p>{{ $message }}</p>
    </div>
    @endif
    <table class="table table-bordered table-striped dataTable dtr-inline">
    <tr>
    <th>S.No</th>
    <th>User Name</th>
    <th>Request Amount</th>
    <th width="280px">Status</th>
    </tr>
    @foreach ($data as $user_data)
    <tr>
    <td>{{ $user_data->id }}</td>
    <td>{{ $user_data->fname.' '.$user_data->lname }}</td>
    <td>{{ $user_data->request_amount }}</td>
   
    
       
     <td>{{ 'success' }}</td>
    
    </tr>
    @endforeach
    </table>
</div>
    </div>
</div>
@endsection