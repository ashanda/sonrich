@extends('layouts.app')
@section('content')

<div class="content-body">
    <div class="container-fluid">
        <div class="mt-2">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left mb-2">
                        <h2>Edit Currency</h2>
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
            <!-- Add appropriate HTML structure and layout for the edit view -->
            <form action="{{ route('currencies.update', $currency->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name:</label><br/>
                    <input type="text" name="name" id="name" value="{{ $currency->name }}" required>
                </div>
                <div class="form-group">
                <label for="code">Code:</label><br/>
                <input type="text" name="code" id="code" value="{{ $currency->code }}" required>
                 </div>
                <div class="form-group">
                <label for="convertion_rate">Conversion Rate:</label><br/>
                <input type="number" name="convertion_rate" id="convertion_rate" value="{{ $currency->convertion_rate }}" step="0.01" required>
                </div>
                <!-- Add other input fields as needed -->
                <button type="submit" class="btn btn-primary">Update Currency</button>
            </form>
        </div>
    </div>
</div>
</div>
<!--**********************************
            Content body end
        ***********************************-->
@endsection   