@extends('layouts.app')
@section('content')

@if (Auth::user()->role == 1 || Auth::user()->role == 2)
<div class="content-body">
    <div class="container-fluid">
<div class="mt-2">
    <div class="row">
    @if (Auth::user()->role == 1)
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
        <h2>All product</h2>
        </div>
       
    </div>
    @else
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
        <h2>Create product</h2>
        </div>
        <div class="pull-right mb-2">
        <a class="btn btn-success" href="{{ route('product.create') }}"> Create product</a>
        </div>
    </div> 
    @endif
    

    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
    <p>{{ $message }}</p>
    </div>
    @endif
    <table class="table table-bordered table-striped dataTable dtr-inline">
    <tr>
    <th>S.No</th>
    <th>product Name</th>
    <th>product price</th>
    <th>product face value</th>
    <th>product points value</th>
        @if (auth::user()->role == 2)
        <th width="280px">Action</th>
        @endif
    
  
    </tr>
    @foreach ($data as $product)
    <tr>
    <td>{{ $product->id }}</td>
    <td>{{ $product->product_title }}</td>
    <td>{{ $product->product_price }}</td>
    <td>{{ $product->product_face_price }}</td>
    <td>{{ $product->point_value }}</td>
    @if (auth::user()->role == 2)
    <td>
        <form action="{{ route('product.destroy',$product->id) }}" method="POST">
        <a class="btn btn-primary" href="{{ route('product.edit',$product->id) }}">Edit</a>
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </td>
    @endif
    </tr>
    @endforeach
    </table>
</div>
    </div>
</div>

@else
<div class="row product-section" style="margin-top: 85px;padding:20px;">

    <div class="mt-2">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
            <p>{{ $message }}</p>
            </div>
        @endif
   
    <div class="row">
  

        <table class="table table-bordered table-striped dataTable dtr-inline">
            <tr>
            <th>S.No</th>
            <th>product Name</th>
            <th>product price</th>
            <th>product points value</th>
            <th width="280px">Action</th>
            </tr>
            @foreach ($data as $oder)
            <tr>
            <td>{{ $oder->id }}</td>
            <td>{{ $oder->product_title }}</td>
            <td>{{ $oder->product_price }}</td>
            <td>{{ $oder->point_value }}</td>
            <td>
               @if ($oder->status == 1)
                {{ 'Active' }}
               @elseif ($oder->status == 2)
               {{ 'Completed' }}
               @elseif ($oder->status == 0)
               {{ 'Pending' }}
               @else
               {{ 'Cancel' }}
               @endif
            </td>
            </tr>
            @endforeach
            </table>
    </div>






</div>




</div>
</div>

@endif


@endsection