@extends('layouts.app')
@section('content')

@if (Auth::user()->role == 2 || Auth::user()->role == 1)
<div class="content-body">

    <div class="container-fluid">
        <div class="mt-2">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Pending KYC</h2>
                    </div>

                </div>
            </div>
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif

            <div class="table-responsive">
                <table id="example2" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Status</th>

                            <th width="280px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $kyc)
                        <tr>
                            <td>{{ $kyc->id }}</td>
                            <td>{{ $kyc->fname .' '. $kyc->lname}}</td>
                            @php
                            if ($kyc->status==0)
                            {
                            $status='Pending';
                            }else if($kyc->status==1){
                            $status='Approved';
                            }else{
                            $status='Rejected';
                            }
                            @endphp
                            <td>{{ $status }}</td>

                            <td>
                                <form action="{{ route('kyc.destroy',$kyc->id) }}" method="Post">
                                    <a class="btn btn-primary" href="{{ route('kyc.edit',$kyc->id) }}">View</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>
        </div>


    </div>
</div>
@else
<div class="content-body">
    <div class="container-fluid">
        <div class="mt-2">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">

                        <h2>Your KYC</h2>
                        @php
                        $get_user_kyc = get_user_kyc();
                        @endphp
                    </div>
                    <div class="pull-right mb-2">
                        @if (count($get_user_kyc) > 0 )
                        <a class="btn btn-primary" href="{{ route('kyc.edit',$get_user_kyc[0]->id) }}"> Edit KYC</a>
                        @else

                        <a class="btn btn-primary" href="{{ route('kyc.create') }}"> Create KYC</a>
                        @endif


                    </div>
                </div>
            </div>
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
            <div>


                @if (count($get_user_kyc) > 0 )
                @if ($get_user_kyc[0]->status==0)
                <h3 class="btn btn-secondary d-block btn-lg">Your KYC Is Pending</h3>
                @elseif ($get_user_kyc[0]->status==1)
                <h3 class="btn btn-secondary d-block btn-lg">Your KYC Is Approved</h3>
                @else
                <h3 class="btn btn-secondary d-block btn-lg">Your KYC Is Reject</h3>

                @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endif


@endsection