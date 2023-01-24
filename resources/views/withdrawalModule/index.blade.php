@extends('layouts.app')

@section('content')
<div class="content-body" style="min-height: 796px;">
    <div class="container-fluid withdraw-section">
      @if (Auth::user()->role == 0 )
      <a class="btn btn-primary" href="/trans/cash" role="button">Cash Withdraw</a>
      <a class="btn btn-primary" href="/trans/p2p" role="button">P2P Transfer</a>
      @else
      <a class="btn btn-primary" href="/trans/p2p" role="button">P2P Transfer</a>
      <a class="btn btn-primary" href="/trans/cash" role="button">Cash Withdraw</a>
      
      @endif
      
  
    </div>
  </div>

  @endsection