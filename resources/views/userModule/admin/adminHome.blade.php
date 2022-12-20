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

                                
                           
                        </div>
                    @endif

                    {{ 'http://127.0.0.1:8000/register?ref_id='.Auth::user()->id }}
                    <br>
                    {{ __('You are admin user.') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
