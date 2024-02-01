@extends('theme.default')
  
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header subscriberDetails__header">
      <div class="container-fluid">
            <h1 class="m-0">Subscribers</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('subscribers.index') }}">Subscribers</a></li>
              <li class="breadcrumb-item active">Details</li>
            </ol>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <?php use \App\Http\Controllers\JobCategoriesController; ?>

    <!-- Main content -->
    <section class="content subscriberDetails__content">      
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
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
                <h3 class="profile-username text-center">{{ $subscriber->fname }} {{ $subscriber->lname }}</h3>
                <p class="text-muted text-center">{{ $subscriber->email }}</p>
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b><i class="icon-login pr-1"></i>Total Email Sent</b> <a class="float-right">{{ JobCategoriesController::getEmailCount($subscriber->id) }}</a>
                  </li>
                  <li class="list-group-item">
                    <b><i class="icon-subscriber pr-1"></i>Subscribed</b> <a class="float-right">@if ($subscriber->unsubscription_date == '')
                          Yes
                          @else
                          No
                          @endif</a>
                  </li>
                  <li class="list-group-item">
                    <b><i class="icon-calender pr-1"></i>Date</b> <a class="float-right"><?php echo  date('M d, Y', strtotime($subscriber->subscription_date)) ?></a>
                  </li>
                  <li class="list-group-item">
                    <b><i class="icon-users pr-1"></i>User Status</b> <a class="float-right">@if ($subscriber->unsubscription_date == '')
                          <!-- Deactivate -->
                          <input id="switch-event" type="checkbox" data-toggle="switchbutton" checked="checked" data-onlabel="Active" data-offlabel="Inactive">
                          
                          @else
                          <!-- Activate -->
                          <input id="switch-event" type="checkbox" data-toggle="switchbutton" data-onlabel="Active" data-offlabel="Inactive">
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
          <div class="col-xl-9 col-lg-8 subscriberInformation">
            <div class="card">
              <div class="card-header">
                <h2 class="card-title">User Information</h2>
                  @if ($subscriber->unsubscription_date == '')
                <span id="statsub"><a href="#" class="btn btn-success float-right" > Subscribed</a></span>
                  @else
                <span id="statsub"><a href="#" class="btn btn-danger float-right" >Unsubscribed</a></span>
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
                        </span>
                        <span class="description">The job alerts that the user opted in</span>
                      </div>
                      <!-- /.user-block -->
                      <p id="sublist">    
                        <?php $sfor = ($subscriber->opted_for != NULL)? explode(',', $subscriber->opted_for) : [];
                            $a=array("success","primary","info","danger","warning","dark");
                            foreach ($sfor as $opted) {
                                    $cat = JobCategoriesController::getCat($opted);
                                    
                                ?>
                                
                                <button type="button" class="btn btn-success<?php //echo $a[array_rand($a)]; ?> btn-md unsub_btn" data-catid="<?php echo $opted; ?>"  data-toggle="tooltip" data-placement="top" title="Click To Unsubscribe"><?php echo $cat[0]['title']; ?></button>
                            <?php }
                         ?>
                        <!-- </div> -->
                        
                      </p>

                      
                      <div class="row">
                          <div class="joinDate">
                            <h6>
                              <b>Joined:</b>@if ($subscriber->subscription_date != '')
                              <?php echo date('M d, Y', strtotime($subscriber->subscription_date)); ?>
                              @endif
                            </h6>
                            
                          </div>  
                          <div class="prasentStatus"><h6><b>Status:</b>@if ($subscriber->unsubscription_date == '')
                           <span id="statact"> Active </span>
                          @else
                          <span id="statact">Inactive</span>
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
            
            <div class="card">
              <div class="card-header">
               
                <h2 class="card-title">Categories</h2>
                 
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                    <div class="post">
                      <div class="">
                        <span class="username">
                          <a href="#">Categories to add to the user's subscription list</a>
                        </span>
                      </div>
                      <!-- /.user-block -->
                      <p></p>
                      <p id="unsublist">   
                        <?php $sfors = ($subscriber->opted_for != NULL)? $subscriber->opted_for : '';
                        
                            $allcat = JobCategoriesController::getrestCat($sfors);
                            $a=array("success","primary","info","danger","warning","dark");
                            foreach ($allcat as $cats) {
                              ?>
                                
                                <button type="button" class="btn btn-success<?php //echo $a[array_rand($a)]; ?> btn-md sub_btn" data-catid="<?php echo $cats['id']; ?>"  data-toggle="tooltip" data-placement="top" title="Click To Add to Subscription List"><?php echo $cats['title']; ?></button>
                            <?php }
                         ?>
                        <!-- </div> -->
                        
                      </p>
                      
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

<script src="{!! asset('theme/plugins/bootstrap-switch/js/bootstrap-switch.min.js') !!}"></script>

<script>
  $(function() {
    var subid = "{{ $subscriber->id }}";
    $('[data-toggle="tooltip"]').tooltip()
    $('#switch-event').change(function() {
      $('#console-event').html('Switch-Button: ' + $(this).prop('checked'));
      var yesno = $(this).prop('checked');
      if (yesno == true) {
        yesno = 'yes';
        $("#statsub").html('<a href="#" class="btn btn-success float-right" > Subscribed</a>');
        $("#statact").html('Active');
      }else{
        yesno = 'no';
        $("#statsub").html('<a href="#" class="btn btn-danger float-right" >Unsubscribed</a>');
        $("#statact").html('Inactive');
      }

      console.log("{{ csrf_token() }}");
      $.ajax({
          headers: {
              'X-CSRF-TOKEN': "{{ csrf_token() }}"
          },
          url : "{{ url('updateSubscriber') }}",
          data : {'yesno' : yesno, 'subid' : subid},
          type : 'POST',
          dataType : 'json',
          success : function(result){

              console.log("===== " + result + " =====");

          }
      });


    })
    
    $('#sublist').on('click','.unsub_btn',function(){
      var cat_id = $(this).data('catid');
      // var id = $(this).data('id');

      $.ajax({
          headers: {
              'X-CSRF-TOKEN': "{{ csrf_token() }}"
          },
          url : "{{ url('updateSubscriberOptedin') }}",
          data : {'opted_for' : cat_id, 'subid' : subid},
          type : 'POST',
          dataType : 'json',
          success : function(result){

              console.log("===== " + result + " =====");
              $(this).hide();

          }
      });
      $text = $(this).text();
      $(this).hide();
       $this = '<button type="button" class="btn btn-success btn-md sub_btn" data-catid="'+cat_id+'"  data-toggle="tooltip" data-placement="top" title="Click To add to Subscription List">'+$text+'</button>';
      $('#unsublist').append($this);
      alert('Successfully unsubscribed!');

    });

    $('#unsublist').on('click','.sub_btn',function(){
      var cat_id = $(this).data('catid');
      // var id = $(this).data('id');

      $.ajax({
          headers: {
              'X-CSRF-TOKEN': "{{ csrf_token() }}"
          },
          url : "{{ url('updateSubscriberOptedout') }}",
          data : {'opted_for' : cat_id, 'subid' : subid},
          type : 'POST',
          dataType : 'json',
          success : function(result){

              console.log("===== " + result + " =====");
              $(this).hide();

          }
      });
      $text = $(this).text();
      $(this).hide();
      $this = '<button type="button" class="btn btn-success btn-md unsub_btn" data-catid="'+cat_id+'"  data-toggle="tooltip" data-placement="top" title="Click To Unsubscribe">'+$text+'</button>';
      $('#sublist').append($this);
      alert('Successfully Added to Subscription List!');

    });


  })
</script>
@endsection