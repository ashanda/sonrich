@extends('layouts.app')
@section('content')
<div class="product-section">


    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <div class="row">
        @foreach ($data as $product)
        <div class="col-sm-6 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="new-arrival-product">
                        <div class="new-arrivals-img-contnent text-center">
                            <img class="img-fluid pro_img" src="{{ asset('products/img/'.$product->product_image) }}" alt="">
                            <img src="{{ asset('img/sample_product.png') }}" alt="" class="img-fluid pro_img">
                            <span class="pkg_duration">{{ $product->point_value }} Points</span>
                        </div>
                        <div class="new-arrival-content text-center mt-3">
                            <h4 class="mb-1">{{ $product->product_title  }}</h4>
                            <!-- <ul class="star-rating p-0">
                                <span class="pkg_desc">{{ $product->product_description }}</span>
                            </ul> -->
                            <span class="price">LKR {{ $product->product_price }}</span>
                            <?php /* <span class="userMsg">{{ ' (Will be charged $10 as a service charge)' }}</span>*/ ?>
                            <div>
                                @if (user_product_count() == 0)
                                <form enctype="multipart/form-data" method="POST" action="{{url('buy_product/real_cash')}}">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id  }}">
                                    <input type="hidden" name="product_price" value="{{ $product->product_price  }}">
                                    <input type="hidden" name="product_point" value="{{ $product->point_value  }}">
                                    <input type="hidden" name="status" value="0">
                                    <button type="submit" class="btn btn-primary mt-2 w-75">Buy Now</button>
                                </form>

                                <form enctype="multipart/form-data" method="POST" action="{{url('buy_product/sponsor_funds')}}">
                                    @csrf
                                    <input class="w-75" type="number" name="sponsor_id" placeholder="Sponsor ID" value="">
                                    <input type="hidden" name="product_id" value="{{ $product->id  }}">
                                    <input type="hidden" name="product_price" value="{{ $product->product_price  }}">
                                    <input type="hidden" name="status" value="0">
                                    <button type="submit" class="btn btn-primary d-block mx-auto mt-2 w-75">Buy Using Sponsor Funds</button>
                                </form>

                                @else
                             
                                @if(isset(spilled_package(Auth::user()->id)->total_package_earnings))
                               
                               
                                @if (product_wallet_balance() >= $product->product_price && spilled_package(Auth::user()->id)->total_package_earnings >= spilled_package(Auth::user()->id)->max_value)
                                <form enctype="multipart/form-data" method="POST" action="{{url('buy_product/product_wallet')}}">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id  }}">
                                    <input type="hidden" name="product_price" value="{{ $product->product_price  }}">
                                    <input type="hidden" name="product_point" value="{{ $product->point_value  }}">
                                    <input type="hidden" name="status" value="0">
                                    <button type="submit" class="btn btn-primary mt-2 w-75">Revolve Using Product Wallet</button>
                                </form>
                                @endif

                                @if (product_wallet_balance() >= 20000 && spilled_package(Auth::user()->id)->total_package_earnings >= spilled_package(Auth::user()->id)->max_value)
                                <form enctype="multipart/form-data" method="POST" action="{{url('buy_product/wallet_and_cash')}}">
                                    @csrf
                                    <input type="hidden" name="amount" value="">
                                    <input type="hidden" name="product_id" value="{{ $product->id  }}">
                                    <input type="hidden" name="product_price" value="{{ $product->product_price  }}">
                                    <input type="hidden" name="product_point" value="{{ $product->point_value  }}">
                                    <input type="hidden" name="status" value="0">
                                    <button type="submit" class="btn btn-primary mt-2 w-75">Revolve Using Product Wallet + Cash</button>
                                </form>
                                @endif
                                @endif
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endforeach
    </div>


</div>
@endsection 