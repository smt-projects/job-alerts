@extends('theme.default')
@section('content')
 
    <!-- Content Header (Page header) -->
    <div class="content-header addCategoties__header">
      <div class="container-fluid">
        <h1 class="m-0">Categories</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item">Categories</li>
          <li class="breadcrumb-item active">Create</li>
        </ol>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->



    <!-- Main content -->
    <section class="content addCategories__content">

    <div class="container-fluid">

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

        <div class="row">
          <!-- left column -->
          <div class="col-xl-8 col-lg-9 col-md-12">
            <!-- general form elements -->
            <div class="card">
              <div class="card-header">
                <!-- <h3 class="card-title">Add New Category</h3> -->
                <div class="pull-left">
                    <h3 class="card-title">Add New Category</h3>
                </div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ route('job-categories.store') }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="card-body">
                  <div class="form-group">
                    <label for="title">This adds a new job alert selection to the sign up form.</label>
                    <input type="text" name="title" class="form-control" placeholder="Label for Bullhorn Category">
                  </div>
                  <div class="form-group">
                    <!-- <label for="title">Category Title</label> -->
                    <!-- <input type="text" name="title" class="form-control" placeholder="Category Title"> -->
                    <select class="form-control select2" name="categories[]" data-placeholder="Select Bullhorn Category" multiple="multiple" style="width: 100%;">
                      <option>Select Bullhorn Category</option>
                      <?php echo  $cathtml; ?>
                    </select>
                  </div>
                  <input type="hidden" value="{{ auth()->user()->id }}" name="created_by">
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
        </div>

    </div>
</section>   
</div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="https://www.vanderhouwen.com/" target="_blank">Vanderhouwen</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

<!-- jQuery -->
<script src="{!! asset('theme/plugins/jquery/jquery.min.js') !!}"></script>

<!-- Select2 -->
<script src="{!! asset('theme/plugins/select2/js/select2.full.min.js') !!}"></script>

<!-- Bootstrap 4 -->
<script src="{!! asset('theme/plugins/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
<!-- DataTables  & Plugins -->
<script src="{!! asset('theme/plugins/datatables/jquery.dataTables.min.js') !!}"></script>
<script src="{!! asset('theme/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') !!}"></script>
<script src="{!! asset('theme/plugins/datatables-responsive/js/dataTables.responsive.min.js') !!}"></script>
<script src="{!! asset('theme/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') !!}"></script>
<script src="{!! asset('theme/plugins/datatables-buttons/js/dataTables.buttons.min.js') !!}"></script>
<script src="{!! asset('theme/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') !!}"></script>
<script src="{!! asset('theme/plugins/jszip/jszip.min.js') !!}"></script>
<script src="{!! asset('theme/plugins/pdfmake/pdfmake.min.js') !!}"></script>
<script src="{!! asset('theme/plugins/pdfmake/vfs_fonts.js') !!}"></script>
<script src="{!! asset('theme/plugins/datatables-buttons/js/buttons.html5.min.js') !!}"></script>
<script src="{!! asset('theme/plugins/datatables-buttons/js/buttons.print.min.js') !!}"></script>
<script src="{!! asset('theme/plugins/datatables-buttons/js/buttons.colVis.min.js') !!}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<!-- AdminLTE App -->
<script src="{!! asset('theme/dist/js/adminlte.js') !!}"></script>

<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    
    //Initialize Select2 Elements
    $('.select2').select2();
  });
</script>
@endsection