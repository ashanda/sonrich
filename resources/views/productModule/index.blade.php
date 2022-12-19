@extends('layouts.app')
@section('content')

@if (Auth::user()->role == 1 || Auth::user()->role == 2)
<div class="content-body">
    <div class="container-fluid">
<div class="container mt-2">
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
    <table class="table table-bordered">
    <tr>
    <th>S.No</th>
    <th>product Name</th>
    <th>product price</th>
    <th>product points value</th>
    <th width="280px">Action</th>
    </tr>
    @foreach ($data as $product)
    <tr>
    <td>{{ $product->id }}</td>
    <td>{{ $product->product_title }}</td>
    <td>{{ $product->product_price }}</td>
    <td>{{ $product->point_value }}</td>
    <td>
        <form action="{{ route('product.destroy',$product->id) }}" method="POST">
        <a class="btn btn-primary" href="{{ route('product.edit',$product->id) }}">Edit</a>
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

@else
<div class="row product-section" style="margin-top: 85px;padding:20px;">

    <div class="container mt-2">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
            <p>{{ $message }}</p>
            </div>
        @endif
   
    <div class="row">
    @foreach ( $data as $product)
    <div class="col-xl-3 col-lg-3 col-sm-4">
        <div class="card">
            <div class="card-body">

                <div class="new-arrival-product">
                    <div class="new-arrivals-img-contnent">
                        <img class="img-fluid" src="{{ asset('products/img/'.$product->product_image) }}" alt="">
                    </div>
                    <div class="new-arrival-content text-center mt-3">
                        <h4>{{ $product->product_title  }}</h4>
                        <ul class="star-rating">
                            <span class="pkg_duration">Product Points : {{ $product->point_value }}</span>
                            <span class="pkg_desc">{{ $product->product_description }}</span>
                        </ul>

                        
                        <span class="price">{{ $product->product_price }}</span>
                        <?php /*
                        <span class="userMsg">{{ ' (Will be charged $10 as a service charge)' }}</span>
                        */ ?>
                        <h3>Buy product</h3>

                        <input type="hidden" name="product_id" value="{{ $product->id  }}">
                        
                        <div>
                            
                           <?php /* 
                            @if (user_product_count() == 0)
                            <a class="btn btn-primary ml-3" href="buy_product/{{ $product->id }}/progress" role="button">Using Crypto</a>
                            @else
                            <a class="btn btn-primary ml-3 mb-2" href="buy_product/{{ $product->id }}/progress" role="button">Using Crypto</a>
                            <a class="btn btn-primary ml-3" href="buy_product/{{ $product->id }}/wallet_buy" role="button">Using Wallet</a>
                            @endif

                            */ ?>













                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    @endforeach





</div>




</div>
</div>

@endif


@endsection