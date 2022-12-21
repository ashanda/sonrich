@extends('layouts.app')

@section('content')
<div class="card-body">
    <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{url('p2p/trans')}}">
     @csrf
      <div class="form-group">
        <label for="exampleInputEmail1">Friend User ID</label>
        <input type="number" step="0" min="2" name="request_user_id" class="form-control" required="">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Amount</label>
        <input type="number" step="0" min="2" name="request_amount" class="form-control" required="">
      </div>
      <button type="submit" class="btn btn-primary">Submit Your Request</button>
    </form>
</div> 
@endsection