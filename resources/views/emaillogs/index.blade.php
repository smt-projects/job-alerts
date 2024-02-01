@extends('theme.default')
@section('content')
 
    <!-- Content Header (Page header) -->
    <div class="content-header emailLogs_header">
      <div class="container-fluid">       
          <h1 class="">Email Logs</h1>       
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item active">Email Logs</li>
            </ol>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content emailLogs_content">
        
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <!-- <div class="card-body table-responsive p-0"> -->
              <div class="card-body">
                <div class="table-responsive">
                <table id="EmailLogList__table" class="table table-bordered table-striped ">
                  <thead class="thead-dark">
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Action</th>
                      <th>Category</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody> 
                    
                  </tbody>
                </table>
                </div>
                
                <!-- Modal -->
                <div class="modal fade" id="emailModalLong" tabindex="-1" role="dialog" aria-labelledby="emailModalLongTitle" aria-hidden="true">
                  <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="emailModalLongTitle"></b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        
                      </div>
                      <div class="modal-footer">
                      </div>
                    </div>
                  </div>
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
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

<!-- AdminLTE App -->
<script src="{!! asset('theme/dist/js/adminlte.js') !!}"></script>
<!-- Page specific script -->
<script>
  $(document).ready(function () {
    $("#EmailLogList__table").DataTable({
      "dom": 'Bfrtip',"lengthChange": true, "autoWidth": false,"paging": true,
      "responsive": true,
      processing: true,
      serverSide: true,
      ajax: "{{route('getemaillogs')}}",
      columns: [
         { data: 'id' },
         { data: 'username' },
         { data: 'email' },
         { data: 'email_content' },
         { data: 'title' },
         { data: 'email_created_at' },
      ],
      //"buttons": ['copy', 'csv', 'excel', 'pdf', 'print', 'colvis'],
      buttons: [
            {
                extend: 'copyHtml5',
                exportOptions: {
                    //columns: ':visible'
                    modifier: {
                      page: 'all',
                      search: 'none'   
                    },
                    columns: [0,1,2,4,5]
                }
            },
            {
                extend: 'csvHtml5',
                filename: 'Email Logs__<?php echo date("Y-m-d"); ?>',
                exportOptions: {
                    //columns: ':visible'
                    columns: [0,1,2,4,5]
                }
            },
            {
                extend: 'excelHtml5',
                filename: 'Email Logs__<?php echo date("Y-m-d"); ?>',
                exportOptions: {
                    //columns: ':visible'
                    columns: [0,1,2,4,5]
                }
            },
            {
                extend: 'pdfHtml5',
                filename: 'Email Logs__<?php echo date("Y-m-d"); ?>',
                exportOptions: {
                  //columns: ':visible'
                  columns: [0,1,2,4,5]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    //columns: ':visible'
                    columns: [0,1,2,4,5]
                }
            },
            'colvis'
        ]
 
    }).buttons().container().appendTo('#EmailLogList_wrapper .col-md-6:eq(0)');

      $('#EmailLogList__table_wrapper').on('click', '.modal_btn', function(){
        $(".modal-body").html('');
          let id = $(this).data('cont');
          let bodyTitle = $(this).data('title');
          $.ajax({
            headers: {
                      'X-CSRF-TOKEN': "{{ csrf_token() }}"
                  },
            url: "{{ route('getEmaildata') }}",
            data : {id: id},
            method: "GET",
            success: function(data) {
              console.log(data);
              // $("#unsubToday").text(data[0].unsubToday);
              $("#emailModalLongTitle").text(bodyTitle);
              $(".modal-body").html(data[0].email_content);
             
            }
          });
      });
  });

  
</script>



@endsection