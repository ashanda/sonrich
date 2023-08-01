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
            <table class="table table-bordered table-hover dataTable dtr-inline">
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
                    <td><span class="curr-val">{{ $user_data->request_amount }}</span></td>

                    <td>
                        <form action="{{ route('friend_request.destroy',$user_data->id) }}" method="POST">
                            <a class="btn btn-primary" href="{{ route('friend_request.edit',$user_data->id) }}">Edit</a>
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