@extends('layouts.app')
@section('content')

<!--**********************************
            Content body start
        ***********************************-->
<style>
  .input-group {
    position: relative;
  }

  .input-group-addon {
    border: none;
  }

  .linkname {
    display: none;
  }

  #copyButton {
    cursor: pointer;
    background: #f1bb3a;
  }

  #copyTarget {
    border-left: none;
  }

  .copied {
    opacity: 1;
    position: absolute;
    left: 55px;
  }

  @media (min-width: 768px) {
    .copied {
      left: 135px;
    }

    .linkname {
      display: block;
      background: #3b3e45;
      color: #fff;
    }
  }
</style>
<div class="content-body">
  <div class="container-fluid">
    <div class="mt-2">
      <div class="row">
        <div class="col-lg-12 margin-tb">


        </div>
      </div>
      @if ($message = Session::get('success'))
      <div class="alert alert-success">
        <p>{{ $message }}</p>
      </div>
      @endif
      <!-- new tables section -->
      <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-3 pt-4 pt-sm-0">
          <h4>Group sale income</h4>
          <table id="example3" class="table table-bordered table-striped dataTable dtr-inline" style="width:100%">
           
            <thead>
              <tr>
                <th>Date</th>
                <th>Amount</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($binary_data as $user)
              <tr>
              <td>{{ $user->created_at}}</td>
              <td>{{ $user->amount}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-3 pt-4 pt-sm-0">
          <h4>Globle revenue income</h4>
          <table id="example3" class="table table-bordered table-striped dataTable dtr-inline" style="width:100%">
            <thead>
              <tr>
                <th>Date</th>
                <th>Amount</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($daily_data as $user)
              <tr>
              <td>{{ $user->created_at}}</td>
              <td>{{ $user->amount}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-3 pt-4 pt-sm-0">
          <h4>Team Income</h4>
          <table id="example3" class="table table-bordered table-striped dataTable dtr-inline" style="width:100%">
            <thead>
              <tr>
                <th>Date</th>
                <th>Amount</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($level_data as $user)
              <tr>
              <td>{{ $user->created_at}}</td>
              <td>{{ $user->amount}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-3 pt-4 pt-sm-0">
          <h4>Direct sale income</h4>
          <table id="example6" class="table table-bordered table-striped dataTable dtr-inline" style="width:100%">
            <thead>
              <tr>
                <th>Date</th>
                <th>Amount</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($direct_data as $user)
              <tr>
              <td>{{ $user->created_at}}</td>
              <td>{{ $user->amount}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection