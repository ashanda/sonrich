@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h4>
        {{ __('Dashboard') }}
    </h4>


    <h5>Welcome to Sonrich Asset Plan</h5>

    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>

    @endif
    <div class="row">
        <div class="col-sm-6 pb-3 pt-3">
            <div class="card text-center p-3">
                <h5>Total BV Points</h5>
                <h1 class="pb-2 pt-1">1395.22</h1>
            </div>
        </div>
        <div class="col-sm-6 pb-3 pt-0 pt-sm-3">
            <div class="card text-center p-3">
                <h5>Active Package</h5>
                <h6>Package Name</h6>
                <h3>30,000</h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="copy_text py-2">
                <h5>Refferal Link</h5>
                <div class="ref_content bg-secondary p-3 text-center">
                    <span id="refLink" class="mr-3"> {{ 'https://future.sonrich.net/register?ref_id='.Auth::user()->id }}</span></span>
                    <button class="btn btn-primary" onclick="copyContent()">Copy!</button>
                    <div id="mess" style="display: none;" class="alert alert-success py-2 px-4 ml-3" role="alert">Copied!</div>
                </div>
            </div>
        </div>
        <!-- <div class="col-md-6 col-sm-12">
            <div class="alert alert-secondary py-2" role="alert">
                {{ __('You are normal user.') }}
            </div>
        </div> -->
    </div>
    <div class="row">
        <div class="col-sm-6 pb-3 pt-4">
            <div class="card text-center p-3">
                <h5>User Account Status</h5>
                <!-- if active -->
                <p id="stIcon" class="acti mx-auto mt-1 my-0"></p>
                <!-- if not active -->
                <p id="sts" class="my-1">Active</p>
                <script>
                    var d = document.getElementById("stIcon");
                    var x = document.getElementById("sts").textContent;
                    if (x == "Active") {
                        d.className += " active_bg";
                    } else {
                        d.className += " nonactive_bg";
                    }
                </script>
            </div>
        </div>
        <div class="col-sm-6 pb-3 pt-0 pt-sm-4">
            <div class="card text-center p-3">
                <h5>Contact Support</h5>
                <span><i class="fa fa-phone"></i></span>
                <span><a href="" class="btn">Contact Us</a></span>
            </div>
        </div>
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