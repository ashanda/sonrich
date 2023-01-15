@extends('layouts.app')
@section('content')

<!-- Step by stem form -->
<div class="container-fluid">
    <div class="pull-right">

        <a class="btn btn-primary" href="{{ route('kyc.index') }}"> Back</a>

    </div>

    <form id="stepregForm" class="stepregForm PT-3" action="{{ route('kyc.update',$id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
        <!-- One "tab" for each step in the form: -->
        <div class="tab pb-3">
            <div class="form-group">
                <label for="mobNo1" class="form-label">Mobile No 01</label>
                <input class="form-control" value="{{ $kyc->mobile_number1 }}" name="mobile_number1">
            </div>
            <div class="form-group">
                <label for="mobNo2" class="form-label">Mobile No 02</label>
                <input class="form-control" value="{{ $kyc->mobile_number2 }}" name="mobile_number2">
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
                    <option value="Driving License">Driving License</option>
                    <option value="Passport">Passport</option>
                </select>
            </div>
            <div class="form-group">
                <label for="bankAcc" class="form-label">Address</label>
                <input class="form-control" value="{{ $kyc->address }}" name="address">
            </div>
            <div class="form-group">
                <label for="bankAcc" class="form-label">Docs Front</label>
                <input class="form-control" type="file" value="{{ $kyc->id_doc_front }}" name="id_doc_front">
                <img src="{{ $kyc->id_doc_front }}" class="img-fluid" alt="Docs Front">
            </div>
            <div class="form-group">
                <label for="bankAcc" class="form-label">Docs Back</label>
                <input class="form-control" type="file" value="{{ $kyc->id_doc_back }}" name="id_doc_back">
                <img src="{{ $kyc->id_doc_back }}" class="img-fluid" alt="Docs Back">
            </div>

        </div>
        <div class="tab pb-3">
            <div class="form-group">
                <label for="bankName" class="form-label">Bank Name</label>
                <input class="form-control" value="{{ $kyc->bank_name }}" name="bank_name">
            </div>
            <div class="form-group">
                <label for="branchName" class="form-label">Branch Name</label>
                <input class="form-control" value="{{ $kyc->branch_name }}" name="branch_name">
            </div>
            <div class="form-group">
                <label for="bankAcc" class="form-label">Bank Account Details</label>
                <input class="form-control" value="{{ $kyc->bank_acount_number }}" name="bank_acount_number">
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
            <div class="form-group">
                <label for="selectCtz" class="form-label">Status</label>
                <select class="form-select p-2 ml-2" name="status">
                    @if ($kyc->status == 0)
                    <option value="1">Active</option>
                    <option value="2">Reject</option>  
                    @elseif ($kyc->status == 1)
                    <option value="0">Pending</option>
                    <option value="2">Reject</option> 
                    @else
                    <option value="0">Pending</option>
                    <option value="1">Ative</option> 
                    @endif
                </select>
            </div>
            <div id="crypto_wall" style="display: none;" class="form-group">
                <label for="cryWall" class="form-label">Crypto Walet address</label>
                <input id="cryWall" class="form-control" value="{{ $kyc->crypto_wallet }}" name="crypto_wallet">
                
                <input type="hidden" class="form-control" value="{{ $kyc->user_id }}" name="user_id">
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
@endsection