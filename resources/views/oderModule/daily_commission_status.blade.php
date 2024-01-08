@extends('layouts.app')
@section('content')

<div class="content-body">
    <div class="container-fluid">
        <div class="mt-2">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left mb-2">
                        <h2>Activate Or Deactivate Daily Commission this Oder</h2>
                        
                      
                       

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
            <form action="{{ route('daily_commission_status_change') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>User Name:</strong>
                            <input type="text" name="user_name" readonly class="form-control" value="{{ user_data_get($oder_data->user_id)->fname ." ".user_data_get($oder_data->user_id)->lname }}">
                            @error('user_name')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Oder Value:  <span class="curr-val">{{ $oder_data->product_value }}</span></strong>
                            {{-- oder_data value remove
                            <input type="text" name="oder_value" readonly class="form-control curr-val" value="{{ $oder_data->product_value }}"> --}}
                            @error('user_name')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            @if (!empty($oder_data->srr_number))
                                <strong>SRS:  <span class="curr-val">{{ $oder_data->srr_number }}</span></strong>
                            @else
                                <strong>You Need added SRS Click Here </strong><a class="btn btn-primary" href="{{ url('edit_user/'.$oder_data->user_id) }}" role="button">Edit</a>
                            @endif
                            
                        </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Daily Commission Status:</strong>
                            <div class="dropdown bootstrap-select default-select">
                                <select class="form-control default-select" tabindex="-98" name="oder_status">
                                  
                                    @if ($oder_data->daily_commission == '0')
                                    <option value="1">Active</option>
                                    
                                   
                                    @else
                                    
                                    
                                    <option value="0">Deactive</option>
                                   
                                    @endif
                                  
                                  
                                  
                                  
                              </select>
                              
                              <input type="hidden" name="oder_id" value="{{ $oder_data->id }}">
                              
                              
                            </div>
                            @error('status')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    
                    <button type="submit" class="btn btn-primary ml-2">Change Daily Commission Status</button>
                </div>
            </form>
          
            <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            @if ( CheckUserSRS($oder_data->user_id) == 0)
                                <strong>You Need added user SRS Click Here </strong><a class="btn btn-primary" href="{{ url('edit_user/'.$oder_data->user_id) }}" role="button">Edit</a> 
                            @endif
                            <form id="innerForm" action="{{ route('srs_update') }}"  method="POST"> 
                                @csrf 
                                @method('PUT')   
                                 <div class="form-group">
                            @if (!empty($oder_data->srr_number))  
                                  <strong>Oder Old SRS:</strong>
                                        <input type="text" name="oder_srs" value="{{ $oder_data->srr_number }}" class="form-control" >
                                        <input type="hidden" name="oderid_srs" class="form-control" value="{{ $oder_data->id }}">
                                        @error('oder_srs')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror 
                            @endif 
                            </div>
                                <button type="submit" onclick="submitInnerForm()" class="btn btn-primary">Update Oder SRS</button>
                                </form> 
                    </div>
             </div>
        </div>
    </div>
</div>
</div>
<!--**********************************
            Content body end
        ***********************************-->
@endsection       