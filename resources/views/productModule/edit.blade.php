@extends('layouts.app')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="mt-2">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left mb-2">
                        <h2>Edit Package</h2>
                        
                        

                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('product.index') }}"> Back</a>
                    </div>
                </div>
            </div>
            @if(session('status'))
            <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
            </div>
            @endif
           
            <form action="{{ route('product.update',$id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Package Name:</strong>
                            <input type="text" name="product_title" class="form-control" value="{{ $product[0]->product_title }}">
                            @error('product_title')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Package Value:</strong>
                            <input type="text" name="product_price" class="form-control" value="{{ $product[0]->product_price }}">
                            @error('product_price')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Package Duration:</strong>
                            <input type="text" name="point_value" class="form-control" value="{{ $product[0]->point_value }}">
                            @error('point_value')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Package Description:</strong>
                            <textarea name="product_description" class="form-control" >
                                {{ $product[0]->product_description }}
                            </textarea>
                            @error('product_description')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Package Image:</strong>
                            <img src="{{ url('products/img/'.$product[0]->product_image) }}"
 style="height: 100px; width: 150px;">
            
                            <input type="file" name="product_image" class="form-control" placeholder="Package Image">
                            @error('product_image')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                   
                    
                    
                    <button type="submit" class="btn btn-primary ml-3">Submit</button>
                </div>
            </form>
        </div>
   
@endsection