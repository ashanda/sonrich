@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
            <h4>
                {{ __('Dashboard') }}
            </h4>
        </div>
        <div class="col-sm-6 text-right">
            <div class="dUid ml-auto py-3 py-sm-0">
                <h5 class="px-4 py-2 bg-primary">User Id - {{ Auth::user()->id }}</h5>
                <!-- user name -->
                {{ Auth::user()->fname.' '.Auth::user()->lname }}
            </div>
        </div>
    </div>
    
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>

    @endif
    
    <a href="{{ route('daily_commission')}}" class="btn btn-warning">Daily Commission</a>
   

    
    <div class="row">
        <div class="col-sm-6 pb-3 pt-3">
            <div class="card text-center p-3">
                <h5>Total BV Points</h5>
                @if (product_wallet() == null)
                    
                @else
                <h1 class="pb-2 pt-1">{{ product_wallet()->wallet_balance + product_wallet()->wallet_balance}}</h1>
                @endif
                
            </div>
        </div>
        <div class="col-sm-6 pb-3 pt-0 pt-sm-3">
            <div class="card text-center p-3">
                <h5>Active Package</h5>
                @if (current_user_active_package() == null)
                    
                @else
                <h6>{{ current_user_active_package()->product_title }}</h6>
                <h3>{{ current_user_active_package()->product_value }}</h3>
                @endif
                
            </div>
        </div>
    </div>

   
    @if (current_user_active_package_count() > 0)
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
    @else
        
    @endif
    <div class="row">
        <div class="col-sm-6 pb-3 pt-4">
            <div class="card text-center p-3">
                <h5>User Account Status</h5>
                <!-- if active -->
                <p id="stIcon" class="acti mx-auto mt-1 my-0"></p>
                <!-- if not active -->
                @if (Auth::user()->status == 0 )
                <p id="sts" class="my-1">Deactive</p>
                @else
                <p id="sts" class="my-1">Active</p>
                @endif
                
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
                <span><a href="" class="btn text-dark">Contact Us</a></span>
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