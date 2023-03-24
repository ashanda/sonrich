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
        <table border="0" cellspacing="5" cellpadding="5">
          <tbody>
            <tr>
              <td>Minimum date:</td>
              <td><input type="text" id="min" name="min"></td>
            </tr>
            <tr>
              <td>Maximum date:</td>
              <td><input type="text" id="max" name="max"></td>
            </tr>
          </tbody>
        </table>
        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" style="width:100%">
          <thead>
            <tr>
              <th>User id</th>
              <th>User Name</th>
              <th>Direct Parent id</th>
              <th>Email</th>
              <th>Google Auth Code</th>
              <th>Status</th>
              <th>Created at</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $user)
            <tr>

              <td>{{ $user->id}}</td>
              <td>{{ $user->fname ." ".$user->lname}}</td>
              <td>{{ $user->parent}}</td>
              <td>{{ $user->email}}</td>
              <td>
                <div class="input-group">
                  <input type="text" id="copyTarget" class="form-control" value="{{ $user->google2fa_secret}}" readonly>
                  <span id="copyButton" class="input-group-addon btn" title="Click to copy">
                    <i class="fa fa-clipboard" aria-hidden="true"></i>
                  </span>

                </div>
              </td>
              @if ($user->status == 1)
              <td>{{ 'Active' }}</td>
              @else
              <td>{{ 'Banned' }}</td>
              @endif

              <td>{{ $user->created_at}}</td>
            </tr>

            @endforeach

          </tbody>

        </table>
      </div>

    </div>
  </div>
</div>

@endsection