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
                  <div class="card-header">{{Auth::user()->fname .' '.Auth::user()->lname}}'s Profile</div>
                  
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
                      <form action="{{ route('edit-profile.update',Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                          <label for="sri_number"><strong>SRI Number:</strong></label>
                          <input type="text" class="form-control" id ="sri_number" name="sri_number" value="{{Auth::user()->sri_number}}">
                        </div>
                         <div class="form-group">
                             <label for="name"><strong>First Name:</strong></label>
                             <input type="text" class="form-control" id ="name" name="fname" value="{{Auth::user()->fname}}">
                         </div>
                         <div class="form-group">
                            <label for="name"><strong>Last Name:</strong></label>
                            <input type="text" class="form-control" id ="name" name="lname" value="{{Auth::user()->lname}}">
                        </div>
                          <div class="form-group">
                             <label for="email"><strong>Email:</strong></label>
                             <input type="text" class="form-control" id ="email" value="{{Auth::user()->email}}" name="email">
                         </div>
                         <div class="form-group">
                            <label for="password"><strong>password:</strong></label>
                            <input type="password" class="form-control" id ="password" value="" name="password">
                        </div>
                          <button class="btn btn-primary" type="submit">Update Profile</button>
                     </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
  @endsection