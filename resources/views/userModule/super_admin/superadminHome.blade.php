@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}

                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    <br>
                    {{ __('You are super user') }}
<<<<<<< HEAD
                    
                    {{ place_user(4) }}
=======

                    {{ LevelCommissionCalc( 2, 5, 1)}}

                    {{ user_positioning(5) }}

>>>>>>> a509a57d03b788ba0eb44536c467c4e352362560
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
