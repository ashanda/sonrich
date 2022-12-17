@extends('layouts.app')


@section('content')

<!-- Step by stem form -->
<div class="container-fluid">
    <form id="stepregForm" class="stepregForm PT-3" action="">
        @csrf
        <!-- One "tab" for each step in the form: -->
        <div class="tab pb-3">
            <div class="form-group">
                <label for="mobNo1" class="form-label">Mobile No 01</label>
                <input class="form-control" placeholder="" name="mobNo1">
            </div>
            <div class="form-group">
                <label for="mobNo2" class="form-label">Mobile No 02</label>
                <input class="form-control" placeholder="" name="mobNo2">
            </div>
            <div class="form-group">
                <label for="country" class="form-label">Country Selected</label>
                <br>
                <select class="form-select p-1 w-100" name="country" aria-label="Default select example">
                    <option selected>Select Country</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
        </div>
        <div class="tab pb-3">
            <div class="form-group">
                <label for="formFileLg" class="form-label">Id/Driving License/Passport</label>
                <input class="form-control form-control-lg" id="formFileLg" type="file" />
            </div>

        </div>
        <div class="tab pb-3">
            <div class="form-group">
                <label for="bankName" class="form-label">Bank Name</label>
                <input class="form-control" placeholder="" name="bankName">
            </div>
            <div class="form-group">
                <label for="branchName" class="form-label">Branch Name</label>
                <input class="form-control" placeholder="" name="branchName">
            </div>
            <div class="form-group">
                <label for="bankAcc" class="form-label">Bank Account Details</label>
                <input class="form-control" placeholder="" name="bankAcc">
            </div>
            <!-- checkbox -->
            <div class="form-group">
                <label for="selectCtz" class="form-label">Are you Sri Lankan Citizen</label>
                <select class="form-select p-2 ml-2" id="comboA" onchange="getComboA(this)" name="selectCtz">
                    <option value="">Select Yes/No</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
            </div>
            <div id="crypto_wall" style="display: none;" class="form-group">
                <label for="cryWall" class="form-label">Crypto Walet address</label>
                <input id="cryWall" class="form-control" placeholder="" name="cryWall">
            </div>
        </div>
        <div style="overflow:auto;">
            <div style="float:right;">
                <button class="btn btn-secondary" type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                <button class="btn btn-primary" type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
            </div>
        </div>
        <!-- Circles which indicates the steps of the form: -->
        <div style="text-align:center;margin-top:40px;">
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
        </div>
    </form>
</div>
<!-- Step by stem form -->

<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2>Add New Product</h2>

        </div>

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('kyc.index') }}"> Back</a>

        </div>

    </div>

</div>



@if ($errors->any())

<div class="alert alert-danger">

    <strong>Whoops!</strong> There were some problems with your input.<br><br>

    <ul>

        @foreach ($errors->all() as $error)

        <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif



<form action="{{ route('kyc.store') }}" method="POST">

    @csrf



    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Name:</strong>

                <input type="text" name="name" class="form-control" placeholder="Name">

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Detail:</strong>

                <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail"></textarea>

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">

            <button type="submit" class="btn btn-primary">Submit</button>

        </div>

    </div>



</form>

@endsection