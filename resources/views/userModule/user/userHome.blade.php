@extends('layouts.app')

@section('content')
<div class="container-fluid">


    <h4 class="text-bold">
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
                <span class="mr-4">Ref Link - <span id="refLink"> {{ 'https://future.sonrich.net/register?ref_id='.Auth::user()->id }}</span></span>
                <button class="btn btn-primary" onclick="copyContent()">Copy!</button>
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
            alert("Content copied to clipboard");
        } catch (err) {
            alert("Failed to copy: ", err);
        }
    };
</script>
@endsection