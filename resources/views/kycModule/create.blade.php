@extends('layouts.app')


@section('content')

<!-- Step by stem form -->
<div class="container-fluid">
    <div class="pull-right">

        <a class="btn btn-primary" href="{{ route('kyc.index') }}"> Back</a>

    </div>

    <div class="row">
        <div class="col-md-12 col-lg-6">
            <form id="stepregForm" class="stepregForm PT-3" action="{{ route('kyc.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- One "tab" for each step in the form: -->
                <div class="tab pb-3">
                    <div class="form-group">
                        <label for="mobNo1" class="form-label">Mobile No 01</label>
                        <input class="form-control vali" placeholder="" name="mobile_number1">
                    </div>
                    <div class="form-group">
                        <label for="mobNo2" class="form-label">Mobile No 02</label>
                        <input class="form-control vali" placeholder="" name="mobile_number2">
                    </div>
                    <div class="form-group">
                        <label for="country" class="form-label">Country Selected</label>
                        <br>

                        <select class="form-select p-1 w-100" name="country" aria-label="Default select example">
                            @foreach (getCountryList() as $country)
                            <option value="{{ $country }}">{{ $country }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="tab pb-3">
                    <div class="form-group">
                        <label for="formFileLg" class="form-label">ID/Driving License/Passport</label>
                        <select class="form-select p-2 ml-2" name="id_docs_type">
                            <option value="ID">ID</option>
                            <option value="Driving_License">Driving_License</option>
                            <option value="Passport">Passport</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="bankAcc" class="form-label">Address</label>
                        <input class="form-control vali" placeholder="" name="address">
                    </div>
                    <div class="form-group">
                        <label for="bankAcc" class="form-label">Docs Front</label>
                        <input class="form-control vali" placeholder="" name="id_doc_front">
                    </div>
                    <div class="form-group">
                        <label for="bankAcc" class="form-label">Docs Back</label>
                        <input class="form-control vali" placeholder="" name="id_doc_back">
                    </div>

                </div>
                <div class="tab pb-3">
                    <div class="form-group">
                        <label for="bankName" class="form-label">Bank Name</label>
                        <input class="form-control vali" placeholder="" name="bank_name">
                    </div>
                    <div class="form-group">
                        <label for="branchName" class="form-label">Branch Name</label>
                        <input class="form-control vali" placeholder="" name="branch_name">
                    </div>
                    <div class="form-group">
                        <label for="bankAcc" class="form-label">Bank Account Details</label>
                        <input class="form-control vali" placeholder="" name="bank_acount_number">
                    </div>

                    <!-- checkbox -->
                    <div class="form-group">
                        <label for="selectCtz" class="form-label">Are you Sri Lankan Citizen</label>
                        <select class="form-select p-2 ml-2" id="comboA" onchange="getComboA(this)" name="citizen">
                            <option value="">Select Yes/No</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                    <div id="crypto_wall" style="display: none;" class="form-group">
                        <label for="cryWall" class="form-label">Crypto Walet address</label>
                        <input id="cryWall" class="form-control" placeholder="" name="crypto_wallet">
                        <input type="hidden" class="form-control" name="status" value="0">
                        <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id }}">
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
    </div>
</div>
<!-- Step by stem form -->




@endsection