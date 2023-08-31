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

        {{ $data->links() }}
      </div>

    </div>
  </div>
</div>

@endsection

@section('script')
  <script>
        $(function () {
            $("#example1")
                .DataTable({
                    responsive: true,
                    lengthChange: true,
                    autoWidth: false,
                    paging: true,
                })
                .buttons()
                .container()
                .appendTo("#example1_wrapper .col-md-6:eq(0)");

            $("#example3,#example4,#example5,#example6").DataTable({
                responsive: true,
                lengthChange: false,
                autoWidth: false,
                searching: true,
                paging: true,
            });

        });

        // daterange
        var minDate, maxDate;

        // Custom filtering function which will search data in column four between two values
        $.fn.dataTable.ext.search.push(
            function (settings, data, dataIndex) {
                var min = minDate.val();
                var max = maxDate.val();
                // var date = new Date(data[5]);
                var data;
                var date;

                if (data[5]) {
                    date = new Date(data[5]);
                } else if (data[4]) {
                    date = new Date(data[4]);
                } else if (data[0]) {
                    date = new Date(data[0]);
                } else {
                    // throw an error or set date to a default value
                    console.error("Date not found in data array");
                }

                if (
                    (min === null && max === null) ||
                    (min === null && date <= max) ||
                    (min <= date && max === null) ||
                    (min <= date && date <= max)
                ) {
                    return true;
                }
                return false;
            }
        );

        $(document).ready(function () {
            // Create date inputs
            minDate = new DateTime($('#min'), {
                format: 'MMMM Do YYYY'
            });
            maxDate = new DateTime($('#max'), {
                format: 'MMMM Do YYYY'
            });

            // DataTables initialisation
            var table = $('#example1,#example3,#example4,#example5,#example6').DataTable();

            // Refilter the table
            $('#min, #max').on('change', function () {
                table.draw();
            });
            
        });

    </script>
@endsection