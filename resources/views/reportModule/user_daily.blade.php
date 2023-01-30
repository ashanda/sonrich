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
      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" style="width:100%">
          <thead>
            <tr>
              <th>User id</th>
              <th>User Name</th>
              <th>Email</th>
              <th>Google Auth Code</th>
              <th>Status</th>
              <th>Created at</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
      <!-- new tables section -->
      <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-3 pt-4 pt-sm-0">
          <table id="example3" class="table table-bordered table-striped dataTable dtr-inline" style="width:100%">
            <thead>
              <tr>
                <th>Date</th>
                <th>Amount</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-3 pt-4 pt-sm-0">
          <table id="example3" class="table table-bordered table-striped dataTable dtr-inline" style="width:100%">
            <thead>
              <tr>
                <th>Date</th>
                <th>Amount</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-3 pt-4 pt-sm-0">
          <table id="example3" class="table table-bordered table-striped dataTable dtr-inline" style="width:100%">
            <thead>
              <tr>
                <th>Date</th>
                <th>Amount</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-3 pt-4 pt-sm-0">
          <table id="example6" class="table table-bordered table-striped dataTable dtr-inline" style="width:100%">
            <thead>
              <tr>
                <th>Date</th>
                <th>Amount</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection