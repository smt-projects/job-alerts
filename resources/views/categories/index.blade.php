@extends('theme.default')
@section('content')
 
    <!-- Content Header (Page header) -->
    <div class="content-header category__header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-8 col-7">
            <h1 class="m-0">Categories</h1>
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Categories</li>
              </ol>
          </div>
          <div class="col-md-4 col-5 d-flex justify-content-end align-items-center">
            <a href="{{ route('job-categories.create') }}" class="btn addCategory_btn float-right"><i class="fas fa-plus"></i> Add Category</a> 
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="container-fluid content category__content">      
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
              <!-- <div class="card-body"> -->
                <table class="table table-bordered table-striped text-nowrap">
                <!-- <table id="example1" class="table table-bordered table-striped"> -->
                  <thead class="thead-dark">
                    <tr>
                      <th>ID</th>
                      <th>Title</th>
                      <th>Author</th>
                      <th>Status</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    @foreach ($categories as $category)
                    <tr>
                      <td>{{ ++$i }}</td>
                      <td>{{ $category->title }}</td>
                      <td>{{ $category->name }}</td>
                      <td>@if ($category->is_active == 1)
                          <span class="tag tag-danger">Active</span>
                          @else
                          <span class="tag tag-success">Deactive</span>
                          @endif
                      </td>
                      <td>{{ $category->created_at }}</td>
                      <td class="d-flex justify-content-center">
                        <form action="{{ route('job-categories.update',$category->cat_id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="title" value="{{ $category->title }}" class="form-control">
                            <input type="hidden" value="{{ auth()->user()->id }}" name="created_by">
                            <input type="hidden" value="0" name="is_active">
                            <button type="submit" class="btn Edit_btn">Deactivate</button>
                                

                        </form>

                        <form action="{{ route('job-categories.destroy',$category->cat_id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                        </form>
                      </td>
                    </tr> 
                    @endforeach

                  </tbody>
                </table>
                <div class="pull-right mt-2 float-right">
                  {!! $categories->links() !!}
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

    </section>
    <!-- /.content -->
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

<!-- jQuery -->
<script src="{!! asset('theme/plugins/jquery/jquery.min.js') !!}"></script>
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

<!-- AdminLTE App -->
<script src="{!! asset('theme/dist/js/adminlte.js') !!}"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    
  });
</script>



@endsection