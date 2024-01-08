@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
        <li>
          {{$error}}
        </li>
        @endforeach
      </ul>
     </div>
    @endif
    @if(session()->get('message'))
    <div class="alert alert-success" role="alert">
      <strong>Success: </strong>{{session()->get('message')}}
    </div>
    @endif
      <div class="row">
          <div class="col-md-6">
              <div class="card">
                {{-- {{ dd($edit_user->fname) }} --}}
                  <div class="card-header">{{ $edit_user->fname .' '.$edit_user->lname}}'s Profile</div>
                  
                  <div class="card-body">
                      @if (session('status'))
                          <div class="alert alert-success" role="alert">
                              {{ session('status') }}
                          </div>
                      @endif
                      @if($message = Session::get('success'))
                        <div class="alert alert-success">
                     <p>{{$message}}</p>
                        </div>
                     @endif
                      <form action="{{ url('/update_user',$edit_user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                       
                        
                        <div class="form-group">
                          <label for="sri_number"><strong>SRI Number:</strong></label>
                          <input type="text" class="form-control" id ="sri_number" name="sri_number" value="{{$edit_user->sri_number}}">
                        </div>
                        <div class="form-group">
                            <label for="srs_number"><strong>SRS Number:</strong></label>
                            <input type="text" class="form-control" id ="srr_number" style="text-transform: uppercase;" name="srr_number" value="{{$edit_user->srr_number}}">
                          </div>
                          
                         <div class="form-group">
                             <label for="name"><strong>First Name:</strong></label>
                             <input type="text" class="form-control" id ="name" name="fname" value="{{$edit_user->fname}}" readonly>
                         </div>
                         <div class="form-group">
                            <label for="name"><strong>Last Name:</strong></label>
                            <input type="text" class="form-control" id ="name" name="lname" value="{{$edit_user->lname}}" readonly>
                        </div>
                          <div class="form-group">
                             <label for="email"><strong>Email:</strong></label>
                             <input type="text" class="form-control" id ="email" value="{{$edit_user->email}}" name="email" readonly>
                         </div>
                          <div class="form-group">
                                  <label for="status"><strong>Status:</strong></label>
                                  <select class="form-control" name="status">
                                      @if ($edit_user->status == 1)
                                          <option value="1" selected>Active</option>
                                          <option value="0">Deactivate</option>
                                      @elseif ($edit_user->status == 0)
                                          <option value="1">Active</option>
                                          <option value="0" selected>Deactivate</option>
                                      @endif
                                  </select>
                            </div>

                          <button class="btn btn-primary" type="submit">Update Profile</button>
                     </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
  @endsection