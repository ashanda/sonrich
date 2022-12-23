@extends('layouts.app')

@section('content')
   

<div class="card-body">
    <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{url('cash/trans')}}">
     @csrf
      <div class="form-group">
        <label for="exampleInputEmail1">Request Amount</label>
        @php
        if(cash_wallet(Auth::user()->id) == NULL){
          $wallet_balance = 0;
        }else{
          if (cash_wallet(Auth::user()->id)->wallet_balance == null){

            $wallet_balance = 0;

            }else{

            $wallet_balance = cash_wallet(Auth::user()->id)->wallet_balance;

            }
        }

          
        @endphp
        <input type="number" step="0.01" min="0.2" max="{{ $wallet_balance }}" name="request_amount" class="form-control" required="">
      </div>
      <button type="submit" class="btn btn-primary">Submit Your Request</button>
    </form>
</div>   
@endsection