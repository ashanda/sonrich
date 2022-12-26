@extends('layouts.app')
@section('content')
<div class="row product-section" style="margin-top: 85px;padding:20px;">

    <div class="mt-2">
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

                        
                        
                        <div>
                            
                           
                            @if (user_product_count() == 0)
                            <form enctype="multipart/form-data" method="POST" action="{{url('buy_product/real_cash')}}">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id  }}">
                                <input type="hidden" name="product_price" value="{{ $product->product_price  }}">
                                <input type="hidden" name="product_point" value="{{ $product->point_value  }}">
                                <input type="hidden" name="status" value="0">
                                 <button type="submit" class="btn btn-primary">Real Cash</button>
                            </form>

                           <form enctype="multipart/form-data" method="POST" action="{{url('buy_product/sponsor_funds')}}">
                                @csrf
                                <label>Sponsor ID</label>
                                <input type="number" name="sponsor_id" value="">
                                <input type="hidden" name="product_id" value="{{ $product->id  }}">
                                <input type="hidden" name="product_price" value="{{ $product->product_price  }}">
                                <input type="hidden" name="status" value="0">
                                <button type="submit" class="btn btn-primary">Using Sponser Funds</button>
                            </form>
                           
                            @else
                            @if (product_wallet_balance() >= $product->product_price)
                            <form enctype="multipart/form-data" method="POST" action="{{url('buy_product/product_wallet')}}">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id  }}">
                                <input type="hidden" name="product_price" value="{{ $product->product_price  }}">
                                <input type="hidden" name="product_point" value="{{ $product->point_value  }}">
                                <input type="hidden" name="status" value="0">
                                 <button type="submit" class="btn btn-primary">Using Product Wallet</button>
                            </form>
                            @endif
                            
                            @if (product_wallet_balance() >= 20000)
                            <form enctype="multipart/form-data" method="POST" action="{{url('buy_product/wallet_and_cash')}}">
                                @csrf
                                <input type="hidden" name="amount" value="">
                                <input type="hidden" name="product_id" value="{{ $product->id  }}">
                                <input type="hidden" name="product_price" value="{{ $product->product_price  }}">
                                <input type="hidden" name="product_point" value="{{ $product->point_value  }}">
                                <input type="hidden" name="status" value="0">
                                 <button type="submit" class="btn btn-primary">Using Product Wallet + Cash</button>
                            </form>
                            @endif
                           
                           
                            
                            
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