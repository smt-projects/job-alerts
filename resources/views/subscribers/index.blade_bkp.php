@extends('theme.default')
@section('content')
 
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Subscribers</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Subscribers</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Subscribers List</h3>

                <!-- <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div> -->
                <!-- <a href="{{ route('job-categories.create') }}" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Add Category</a> -->
              </div>
              <!-- /.card-header -->
              <!-- <div class="card-body table-responsive p-0"> -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Subscribed</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 0; ?>
                    @foreach ($subscribers as $subscriber)
                    <tr>
                      <td>{{ ++$i }}</td>
                      <td>{{ $subscriber->fname }} {{ $subscriber->lname }}</td>
                      <td>{{ $subscriber->email }}</td>
                      <td>@if ($subscriber->unsubscription_date == '')
                          <span class="tag tag-danger">Yes</span>
                          @else
                          <span class="tag tag-success">No</span>
                          @endif
                      </td>
                      <td>{{ $subscriber->subscription_date }}</td>
                      <td>
                        
                        <!-- <form action="{{ route('subscribers.destroy',$subscriber->id) }}" method="POST"> -->
    
                            <a class="btn btn-success" href="{{ route('subscribers.show',$subscriber->id) }}">View</a>

                            <!-- <a class="btn btn-primary" href="{{ route('job-categories.edit',$subscriber->id) }}">Edit</a> -->

                            <!-- @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form> -->

                        <form action="{{ route('subscribers.update',$subscriber->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- <input type="hidden" name="title" value="{{ $subscriber->title }}" class="form-control">
                            <input type="hidden" value="{{ auth()->user()->id }}" name="created_by">
                            <input type="hidden" value="0" name="is_active"> -->
                            <button type="submit" class="btn btn-danger">Deactivate</button>
                                

                        </form>

                      </td>
                    </tr> 
                    @endforeach

                  </tbody>
                </table>
              
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
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="#">Leidsens Tech</a>.</strong> All rights reserved.
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
<!-- AdminLTE for demo purposes -->
<script src="{!! asset('theme/dist/js/demo.js') !!}"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    // $('#example2').DataTable({
    //   "paging": true,
    //   "lengthChange": false,
    //   "searching": false,
    //   "ordering": true,
    //   "info": true,
    //   "autoWidth": false,
    //   "responsive": true,
    // });
  });
</script>



@endsection