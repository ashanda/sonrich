@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
<<<<<<< HEAD
 
=======
>>>>>>> 135c1cf557776b96cd8ae434b8854fd0f1158d0e
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    <br>
                    {{ __('You are super user') }}
                    
<<<<<<< HEAD
                    <!-- {{ LevelCommissionCalc( 2, 5, 1)}} -->
=======
                    {{ user_positioning(5) }}
>>>>>>> 135c1cf557776b96cd8ae434b8854fd0f1158d0e
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
