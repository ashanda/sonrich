@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    <!-- test -->
                    <!-- <input type="text" value="Hello World" id="myInput">
                    <button onclick="myFunction()">Copy text</button>

                    <script>
                        function myFunction() {
                            // Get the text field
                            var copyText = document.getElementById("myInput");

                            // Select the text field
                            copyText.select();
                            copyText.setSelectionRange(0, 99999); // For mobile devices

                            // Copy the text inside the text field
                            navigator.clipboard.writeText(copyText.value);

                            // Alert the copied text
                            alert("Copied the text: " + copyText.value);
                        }
                    </script> -->

                    <!-- test -->
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