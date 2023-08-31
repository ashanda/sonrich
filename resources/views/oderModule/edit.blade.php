@extends('layouts.app')
@section('content')

<div class="content-body">
    <div class="container-fluid">
        <div class="mt-2">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left mb-2">
                        <h2>Activate Oders</h2>
                        
                      
                       

                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('oders.index') }}"> Back</a>
                    </div>
                </div>
            </div>
            @if(session('status'))
            <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
            </div>
            @endif
            <form action="{{ route('oders.update',$id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>User Name:</strong>
                            <input type="text" name="user_name" readonly class="form-control" value="{{ $oder[0]->fname.' '.$oder[0]->lname }}">
                            @error('user_name')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Oder Value:  <span class="curr-val">{{ $oder[0]->product_value }}</span></strong>
                            {{-- oder value remove
                            <input type="text" name="oder_value" readonly class="form-control curr-val" value="{{ $oder[0]->product_value }}"> --}}
                            @error('user_name')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            @if (!empty($oder[0]->srr_number))
                                <strong>SRS:  <span class="curr-val">{{ $oder[0]->srr_number }}</span></strong>
                            @else
                                <strong>You Need added SRS Click Here </strong><a class="btn btn-primary" href="{{ url('edit_user/'.$oder[0]->user_id) }}" role="button">Edit</a>
                            @endif
                            
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Payment Methode:</strong>
                            <input type="text" name="payment_method" readonly class="form-control" value="{{ $oder[0]->payment_method }}">
                            @error('payment_method')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    
                    
                    
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Package Status:</strong>
                            <div class="dropdown bootstrap-select default-select">
                                <select class="form-control default-select" tabindex="-98" name="oder_status">
                                  
                                    @if ($oder[0]->status == '0')
                                    <option value="1">Active</option>
                                    
                                   
                                    @else
                                    
                                    
                                    <option value="3">Cancel</option>
                                   
                                    @endif
                                  
                                  
                                  
                                  
                              </select>
                              
                              <input type="hidden" name="user_id" value="{{ $oder[0]->uid }}">
                              <input type="hidden" name="product_value" value="{{ ($oder[0]->product_value) }}"> 
                              <input type="hidden" name="point_value" value="{{ $oder[0]->product_point }}">
                              
                            </div>
                            @error('status')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    
                    <button type="submit" class="btn btn-primary ml-2">Activate Oder</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<!--**********************************
            Content body end
        ***********************************-->
@endsection       