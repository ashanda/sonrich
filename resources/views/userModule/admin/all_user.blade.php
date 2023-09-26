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
  .pagination {
  margin: 0 auto;
  display: inline-flex;
  padding: 0;
}

.page-item {
  display: inline-block;
  color: #000;
  background-color: #fff;
  border: 1px solid #ddd;
  margin: 0;
  text-align: center;
}

.page-item:hover {
  background-color: #eee;
}

.page-item.active a {
  background-color: #007bff;
  border-color: #007bff;
  color: #fff;
}

.page-link {
  display: block;
  padding: 0.5rem 1rem;
  border: none;
  background: none;
  color: #000;
  text-decoration: none;
}

.page-link:hover {
  color: #fff;
  background-color: #007bff;
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
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($all_user as $user)
            <tr>

              <td>{{ $user->id}}</td>
              <td>{{ $user->fname ." ".$user->lname}}</td>
              <td>{{ $user->email}}</td>
              @if ($user->status == 1)
              <td>{{ 'Active' }}</td>
              @else
              <td>{{ 'Banned' }}</td>
              @endif
               <td><a href="{{ url('edit_user/'.$user->id) }}"><i class="fas fa-edit fa-1x"></i>
                Edit </a></td> 
            </tr>

            @endforeach

          </tbody>

        </table>
        
      </div>
      
    </div>
  </div>
</div>

@endsection

@section('script')
<script>
  $(document).ready(function () {
    $('#example1').DataTable({
      "pageLength": 100 // Set the default number of rows to 100
    });
  });
</script>



@endsection