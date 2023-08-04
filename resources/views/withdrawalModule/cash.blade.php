@extends('layouts.app')

@section('content')


<div class="row">
  <div class="col-sm-12 col-md-6">
    <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{url('cash/trans')}}">
      @csrf
      <div class="form-group">
        <label for="exampleInputEmail1">Request Amount Only LKR</label>
      </div>
      <div class="form-group row">

        <div class="col-sm-7">

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
        <div class="col-sm-5 pt-3 pt-sm-0">
          <!-- <button type="submit" class="btn btn-primary">Submit Your Request</button> -->
          <!-- confirm model -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#confModel">
                Submit Your Request
              </button>

              <!-- Modal -->
              <div class="modal fade" id="confModel" tabindex="-1" role="dialog" aria-labelledby="confModelLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-body">
                      Are you sure
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Yes</button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- confirm model -->
        </div>
      </div>

    </form>
  </div>
</div>
@endsection