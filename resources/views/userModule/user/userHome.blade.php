@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h4>
        {{ __('User Dashboard') }}
    </h4>
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="copy_text py-2">
                <span class="mr-4">Ref Link - <span id="refLink"> {{ 'http://127.0.0.1:8000/register?ref_id='.Auth::user()->id }}</span></span>
                <button class="btn btn-primary" onclick="copyContent()">Copy!</button>
                <div id="mess" style="display: none;" class="alert alert-success py-2 px-4 ml-3" role="alert">Copied!</div>
            </div>
        </div>
        <!-- <div class="col-md-6 col-sm-12">
            <div class="alert alert-secondary py-2" role="alert">
                {{ __('You are normal user.') }}
            </div>
        </div> -->
    </div>
</div>
<script>
    let text = document.getElementById("refLink").innerHTML;
    const copyContent = async () => {
        try {
            await navigator.clipboard.writeText(text);
            // alert("Content copied to clipboard");
            document.getElementById("mess").style.display = "inline";
            $("#mess").fadeOut();
        } catch (err) {
            alert("Failed to copy: ", err);
        }
    };
</script>
@endsection