@extends('layouts.app')
@section('content')

<div class="content-body">
    <div class="container-fluid">


<div class="col-md-12" >
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
    <th>Date</th>
    <th >Status</th>
    </tr>

    @foreach ($data as $user_data) 
    <tr>
    <td>{{ $user_data->uid }}</td>
    <td>{{ $user_data->fname.' '.$user_data->lname }}</td>
    <td>{{ $user_data->request_amount }}</td>
     @if($user_data->date == NULL)
    <td>{{ ' - ' }}</td>
    @else
    <td>{{ $user_data->date }}</td>
    @endif   
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
@endsection