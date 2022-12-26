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
    <th width="280px">Action</th>
    </tr>
    @foreach ($data as $user_data)
    <tr>
    <td>{{ $user_data->id }}</td>
    <td>{{ $user_data->fname.' '.$user_data->lname }}</td>
    <td>{{ $user_data->request_amount }}</td>
   
    <td>
        <form action="{{ route('p2p.destroy',$user_data->id) }}" method="POST">
        <a class="btn btn-primary" href="{{ route('p2p.edit',$user_data->id) }}">Edit</a>
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </td>
    </tr>
    @endforeach
    </table>
</div>
    </div>
</div>
@endsection