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
              <li class="breadcrumb-item">Subscribers</li>
              <li class="breadcrumb-item active">Details</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <?php use \App\Http\Controllers\JobCategoriesController; ?>

    <!-- Main content -->
    <section class="content">
        
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        
        <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{!! asset('theme/dist/img/avatar5.png') !!}"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{ $subscriber->fname }} {{ $subscriber->lname }}</h3>

                <p class="text-muted text-center">{{ $subscriber->email }}</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Total Email Sent</b> <a class="float-right">1,322</a>
                  </li>
                  <li class="list-group-item">
                    <b>Subscribed</b> <a class="float-right">@if ($subscriber->unsubscription_date == '')
                          Yes
                          @else
                          No
                          @endif</a>
                  </li>
                  <li class="list-group-item">
                    <b>Date</b> <a class="float-right"><?php echo  date('M d, Y', strtotime($subscriber->subscription_date)) ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>User Status</b> <a class="float-right">@if ($subscriber->unsubscription_date == '')
                          Deactivate
                          @else
                          Activate
                          @endif</a>
                  </li>
                </ul>

                <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <!-- <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                </ul> -->
                <h2 class="card-title">User Information</h2>
               @if ($subscriber->unsubscription_date == '')
                           <a href="#" class="btn btn-success float-right"> Subscribed</a>
                          @else
                          <a href="#" class="btn btn-danger float-right">Unsubscribed</a>
                          @endif
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                    <div class="post">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="{!! asset('theme/dist/img/avatar5.png') !!}" alt="user image">
                        <span class="username">
                          <a href="#">User Subscribed For</a>
                          <!-- <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a> -->
                        </span>
                        <span class="description">The job alerts that the user opted in</span>
                      </div>
                      <!-- /.user-block -->
                      <p>
                        <!-- <div class="btn-group"> -->
                            
                        <?php $sfor = explode(',', $subscriber->opted_for);
                            $a=array("success","primary","info","danger","warning","dark");
                            foreach ($sfor as $opted) {
                                    $cat = JobCategoriesController::getCat($opted);
                                    // print_r($cat[0]['title']);
                                ?>
                                
                                <button type="button" class="btn btn-<?php echo $a[array_rand($a)]; ?> btn-md"><?php echo $cat[0]['title']; ?></button>
                            <?php }
                         ?>
                        <!-- </div> -->
                        
                      </p>

                      
                      <div class="row">
                          <div class="col-md-3"><h6>Unsubscribed:@if ($subscriber->unsubscription_date == '')
                           No
                          @else
                          Yes
                          @endif</h6></div> | 
                          <div class="col-md-3"><h6>Unsubscription date:@if ($subscriber->unsubscription_date != '')
                            <?php echo date('M d, Y', strtotime($subscriber->unsubscription_date)); ?>
                            @endif
                          </h6></div> | 
                          <div class="col-md-3"><h6>User Status:@if ($subscriber->unsubscription_date == '')
                           Active
                          @else
                          Inactive
                          @endif</h6></div>
                      </div>
                      
                    </div>
                    <!-- /.post -->


                   
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    
                  </div>
                  
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
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
<!-- AdminLTE App -->
<script src="{!! asset('theme/dist/js/adminlte.min.js') !!}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{!! asset('theme/dist/js/demo.js') !!}"></script>
@endsection