@extends('layouts.app')
@section('content')

<div class="content-body">
    <div class="container-fluid">
        <div class="mt-2">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left mb-2">
                        <h2>Add Currency</h2>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('currencies.index') }}"> Back</a>
                    </div>
                </div>
            </div>
            @if(session('status'))
            <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
            </div>
            @endif
            <!-- Add appropriate HTML structure and layout for the create view -->
            <div class="row">
                <div class="col-md-12 col-lg-6">
            <form class="stepregForm PT-3" action="{{ route('currencies.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name:</label><br/>
                    <input type="text" name="name" id="name" required>
                </div>
                <div class="form-group">
                <label for="code">Code:</label><br/>
                <input type="text" name="code" id="code" required>
                 </div>
                <div class="form-group">
                <label for="convertion_rate">Conversion Rate:</label><br/>
                <input type="number" name="convertion_rate" id="convertion_rate" step="0.01" required>
                </div>
                <!-- Add other input fields as needed -->
                <button type="submit" class="btn btn-primary">Create Currency</button>
            </form>
        </div>
    </div>
</div>
</div>
</div>
</div>
<!--**********************************
            Content body end
        ***********************************-->
@endsection       