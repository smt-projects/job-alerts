@extends('theme.default')
@section('content')
 
    <!-- Content Header (Page header) -->
    <div class="content-header subscriberList__header">
      <div class="container-fluid">
        <div class="mb-2">
            <h1 class="m-0">Subscribers List</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item active">Subscribers</li>
            </ol>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content subscriberList__content">
        
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif



        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- <div class="card-body table-responsive p-0"> -->
              <div class="card-body">
              <div class="table-responsive" >
                <table id="subscriberList__table" class="table table-bordered table-striped ">
                  <thead class="thead-dark">
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
                      <td >  
                        <div class="d-flex">
    
                        <a class="btn" href="{{ route('subscribers.show',$subscriber->id) }}">View</a>
                        <form action="{{ route('subscribers.update',$subscriber->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn">Deactivate</button>
                        </form>
                        </div>    
                      </td>
                    </tr> 
                    @endforeach

                  </tbody>
                </table>
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
<!-- <script src="{!! asset('theme/plugins/jquery/jquery.min.js') !!}"></script> -->
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<!-- Bootstrap 4 -->
<script src="{!! asset('theme/plugins/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
<!-- DataTables  & Plugins -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <!-- <script src="{!! asset('theme/plugins/pdfmake/pdfmake.min.js') !!}"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.5/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.5/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    

<!-- AdminLTE App -->
<script src="{!! asset('theme/dist/js/adminlte.js') !!}"></script>
<!-- Page specific script -->
<script>
 $(document).ready(function () {
    const urlParams = new URLSearchParams(window.location.search);
    const s = urlParams.get('s');
    
    $("#subscriberList__table").DataTable({
      "dom": 'Bfrtip',"lengthChange": false, "autoWidth": false,
      "paging": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "responsive": true,
      "responsive": true,
      "search": {
        "search": s
      },
      buttons: [
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            },
            'colvis'
        ]
 
    }).buttons().container().appendTo('#subscriberList_wrapper .col-md-6:eq(0)');

  });

</script>



@endsection