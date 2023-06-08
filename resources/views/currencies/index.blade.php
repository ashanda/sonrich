@extends('layouts.app')
@section('content')

<div class="content-body">

    <div class="container-fluid">
        <div class="mt-2">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>All Currency</h2>
                    </div>

                </div>
            </div>
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
            <h5><a class="btn btn-primary" href="{{ route('currencies.create') }}">Add Currencies</a></h5>
            <div class="table table-bordered table-striped dataTable dtr-inline">
                <!-- Add appropriate HTML structure and layout for the index view -->
                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" style="width:100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Conversion Rate</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($currencies as $currency)
                        <tr>
                            <td>{{ $currency->name }}</td>
                            <td>{{ $currency->code }}</td>
                            <td>{{ $currency->convertion_rate }}</td>
                            <td>
                                <a class="btn btn-primary" href="{{ route('currencies.edit', $currency->id) }}">Edit</a>
                                <form action="{{ route('currencies.destroy', $currency->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection    