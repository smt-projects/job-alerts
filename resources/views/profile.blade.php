@extends('theme.default')
  
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header subscriberDetails__header">
      <div class="container-fluid">
            <h1 class="m-0">Profile</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ol>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <?php use \App\Http\Controllers\JobCategoriesController; ?>

    <!-- Main content -->
    <section class="content subscriberDetails__content">      
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if($errors)
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif
        
      <div class="container-fluid">
        <div class="row">
          <div class="col-xl-3 col-lg-4 subscriberProfile">
            <!-- Profile Image -->
            <div class="card">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{!! asset('theme/dist/img/avatar5.png') !!}"
                       alt="User profile picture">
                </div>
                <h3 class="profile-username text-center">{{ auth()->user()->name }}</h3>
                <p class="text-muted text-center">{{ auth()->user()->email }}</p>
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b><i class="icon-login pr-1"></i>Email</b> <a class="float-right">{{ auth()->user()->email }}</a>
                  </li>
                  <li class="list-group-item">
                    <b><i class="icon-login pr-1"></i>Member Since</b> <a class="float-right"><?php echo date('M d, Y', strtotime(auth()->user()->created_at)); ?></a>
                  </li>
                </ul>
                <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-xl-9 col-lg-8 subscriberInformation">
            <div class="card">
              <div class="card-header">
                 <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Change Password</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Change Username</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Change Email</a></li>
                </ul>
                <!--<h2 class="card-title">Change Password</h2>-->
                  
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                    <div class="post">
                      <!-- form start -->
                      <form class="form-horizontal" method="POST" action="{{ route('changePasswordPost') }}">
                          {{ csrf_field() }}

                          <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                              <label for="new-password" class="col-xl-6 col-lg-8 col-md-10 control-label">Current Password</label>
                              <div class="col-xl-6 col-lg-8 col-md-10">
                                  <input id="current-password" type="password" class="form-control" name="current-password" required>

                                  @if ($errors->has('current-password'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('current-password') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                              <label for="new-password" class="col-xl-6 col-lg-8 col-md-10 control-label">New Password</label>

                              <div class="col-xl-6 col-lg-8 col-md-10">
                                  <input id="new-password" type="password" class="form-control" name="new-password"  required>

                                  @if ($errors->has('new-password'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('new-password') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="new-password-confirm" class="col-xl-6 col-lg-8 col-md-10 control-label">Confirm New Password</label>

                              <div class="col-xl-6 col-lg-8 col-md-10">
                                  <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                              </div>
                          </div>

                          <div class="form-group">
                              <div class="col-md-6 col-md-offset-4">
                                  <button type="submit" class="btn btn-primary changePasswor">
                                      Change Password
                                  </button>
                              </div>
                          </div>
                      </form>
                      
                    </div>
                    <!-- /.post -->


                   
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    <!-- Post -->
                    <div class="post">
                      <!-- form start -->
                      <form class="form-horizontal" method="POST" action="{{ route('changeUsernamePost') }}">
                          {{ csrf_field() }}

                          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                              <label for="name" class="col-md-4 control-label">Username</label>

                              <div class="col-xl-6 col-lg-8 col-md-10">
                                  <input id="name" type="text" class="form-control" name="name" required>

                                  @if ($errors->has('name'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('name') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>

                          

                          <div class="form-group">
                              <div class="col-xl-6 col-lg-8 col-md-10">
                                  <button type="submit" class="btn btn-primary changePasswor">
                                      Change Username
                                  </button>
                              </div>
                          </div>
                      </form>
                      
                    </div>
                    <!-- /.post -->
                  </div>

                  <div class="tab-pane" id="settings">
                    <!-- Post -->
                    <div class="post">
                      <!-- form start -->
                      <form class="form-horizontal" method="POST" action="{{ route('changeEmailPost') }}">
                          {{ csrf_field() }}

                          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                              <label for="email" class="col-xl-6 col-lg-8 col-md-10 control-label">Email Address</label>

                              <div class="col-xl-6 col-lg-8 col-md-10">
                                  <input id="email" type="email" class="form-control" name="email" required>

                                  @if ($errors->has('email'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('email') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>

                          

                          <div class="form-group">
                              <div class="col-md-6 col-md-offset-4">
                                  <button type="submit" class="btn btn-primary changePasswor">
                                      Change Email
                                  </button>
                              </div>
                          </div>
                      </form>
                      
                    </div>
                    <!-- /.post -->
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
<!-- AdminLTE App -->
<script src="{!! asset('theme/dist/js/adminlte.min.js') !!}"></script>
<!-- AdminLTE for demo purposes -->
<!--<script src="{!! asset('theme/dist/js/demo.js') !!}"></script>-->

<script src="{!! asset('theme/plugins/bootstrap-switch/js/bootstrap-switch.min.js') !!}"></script>

<script>
  //document.getElementById('switch-event').switchButton('Deactivate')
  $(function() {
    

  })
</script>
@endsection