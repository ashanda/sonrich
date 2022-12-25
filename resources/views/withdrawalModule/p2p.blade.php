@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{url('p2p/trans')}}">
      @csrf
      <div class="form-group row">
        <div class="col-sm-6">
          <label for="exampleInputEmail1">Friend User ID</label>
          <input type="number" step="0" min="2" name="request_user_id" class="form-control" required="">
        </div>
        <div class="col-sm-6">
          <label for="exampleInputEmail1">Amount</label>

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
          <div class="form-group row">
            <div class="col-12 col-sm-7">
              <input type="number" step="0" min="2" max="{{ $wallet_balance }}" name="request_amount" class="form-control" required="">
            </div>
            <div class="col-12 col-sm-5 pt-3 pt-sm-0">
              <button type="submit" class="btn btn-primary">Submit Your Request</button>
            </div>
          </div>


        </div>
      </div>
    </form>
  </div>

</div>
@endsection