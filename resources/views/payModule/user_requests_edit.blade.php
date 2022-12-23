@extends('layouts.app')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="container mt-2">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left mb-2">
                        <h2>approve Request</h2>
                        
                        

                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('friend_request.index') }}"> Back</a>
                    </div>
                </div>
            </div>
            @if(session('status'))
            <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
            </div>
            @endif
           
            <form action="{{ route('friend_request.update',$id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">

                    
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Request Value:</strong>
                            <input type="text" name="requset_value" class="form-control" value="{{ $buy_requests[0]->request_amount }}" readonly>
                           
                            @error('product_price')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                   
                  
                   
                    
                    
                    <button type="submit" class="btn btn-primary ml-3">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection