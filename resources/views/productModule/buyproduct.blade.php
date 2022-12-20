@extends('layouts.app')
@section('content')
<div class="row product-section" style="margin-top: 85px;padding:20px;">

    <div class="container mt-2">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
            <p>{{ $message }}</p>
            </div>
        @endif
   
    <div class="row">
  
        @foreach ($data as $product)
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
                            
                           
                            @if (user_product_count() == 0)
                            <a class="btn btn-primary ml-3" href="buy_product/real_cash" role="button">Real Cash</a>
                            <a class="btn btn-primary ml-3" href="buy_product/sponser_funds" role="button">Using Sponser Funds</a>
                            @else
                            <a class="btn btn-primary ml-3 mb-2" href="buy_product/wallet_and_cash" role="button">Using Product Wallet + Cash</a>
                            <a class="btn btn-primary ml-3" href="buy_product/product_wallet" role="button">Using Product Wallet</a>
                            @endif

                            

                        </div>
                    </div>

                </div>

            </div>
        </div>
        @endforeach
    </div>
    
</div>
</div>
@endsection