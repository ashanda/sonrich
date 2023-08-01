@extends('layouts.app')
@section('content')

<div class="content-body">

    <div class="container-fluid">
        <div class="mt-2">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>All Gas Fee</h2>
                    </div>

                </div>
            </div>
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
            <h5><a class="btn btn-primary" href="{{ route('gas_fee_collect.create') }}">Add Gas Fee</a></h5>
            <div class="table table-bordered table-striped dataTable dtr-inline">
                <table id="example1" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Fee</th>
                            <th>Last Earn Amount</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $user_data)
                        <tr>
                            <td>{{ $user_data->id }}</td>
                            <td>{{ $user_data->fname." ".$user_data->lname }}</td>

                            <td><span class="curr-val">{{ $user_data->gas_fee }}</span></td>

                            <td><span class="curr-val">{{ $user_data->last_earn }}</span></td>
                        </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>
        </div>


    </div>
</div>

@endsection