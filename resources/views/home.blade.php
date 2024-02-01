@extends('theme.default')
@section('content')

<?php use \App\Http\Controllers\HomeController; ?>
<!-- Content Header (Page header) -->
    <div class="content-header dashboard_header">
      <div class="container-fluid">
        <h1 class="m-0">Dashboard</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content dashboardContent__section">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row dashboard__section">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box boxInner_1">
                <a href="{{ route('subscribers.index') }}">
              <div class="inner text-center">
                <h3><?php echo $subCount ?></h3>
                <p>TOTAL USERS</p>
              </div>
              </a>
              <!-- <div class="icon">
                <i class="ion ion-bag"></i>
              </div> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box boxInner_2">
                <a href="{{ route('emaillogs.index') }}">
              <div class="inner text-center">
                <h3><?php echo $emailCount ?><!-- <sup style="font-size: 20px">%</sup> --></h3>
                <p>EMAIL ALERTS</p>
              </div>
              </a>
              <!-- <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div> -->
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box boxInner_3">
                <a href="{{ route('subscribers.index') }}?s=Yes">
              <div class="inner text-center">
                <h3><?php echo $actCount ?></h3>
                <p>ACTIVE USERS</p>
              </div>
              </a>
              <!-- <div class="icon">
                <i class="ion ion-person-add"></i>
              </div> -->
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box boxInner_4">
                <a href="{{ route('subscribers.index') }}?s=No">
              <div class="inner text-center">
                <h3><?php echo $deactCount ?></h3>
                <p>INACTIVE USERS</p>
              </div>
              </a>
              <!-- <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div> -->
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box boxInner_2">
                <a href="{{ route('emaillogs.index') }}">
              <div class="inner text-center">
                <h3><?php echo $estimated ?><!-- <sup style="font-size: 20px">%</sup> --></h3>
                <p>ESTIMATED</p>
              </div>
              </a>
              <!-- <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div> -->
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box boxInner_3">
                <a href="{{ route('emaillogs.index') }}">
              <div class="inner text-center">
                <h3><?php echo $mailGunCount ?><!-- <sup style="font-size: 20px">%</sup> --></h3>
                <p>POSTMARK SENDS</p>
              </div>
              </a>
              <!-- <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div> -->
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box boxInner_4">
                <a href="{{ route('emaillogs.index') }}">
              <div class="inner text-center">
                <h3><?php echo $emailQueued[0]['count'] ?><!-- <sup style="font-size: 20px">%</sup> --></h3>
                <p>QUEUED</p>
              </div>
              </a>
              <!-- <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div> -->
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box boxInner_1">
                <a href="{{ route('emaillogs.index') }}">
              <div class="inner text-center">
                <h3><?php echo $notSent ?><!-- <sup style="font-size: 20px">%</sup> --></h3>
                <p>NOT SENT</p>
              </div>
              </a>
              <!-- <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div> -->
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row two_col__section">
          <!-- Left col -->
          <section class="col-lg-7 connectedSortable subscriptionUnsubscription_graph">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  SUBSCRIBE vs UNSUBSCRIBE
                </h3>
                <div class="card-tools">
                 
                  <?php 
                $tcnt = count($subdata);
                $i = 1;
                $str ='';
                $subsstr = ""; 
                $strArr = [];
                $subArr = [];
                $unsubArr = [];
                foreach($subdata as $sub){
                   $str .= "'".$sub['month']."'";
                   $subsstr .= $sub['count'];
                   if ($i < $tcnt) {
                    $str .= ",";
                    $subsstr .= ",";
                    $i++;
                   }
                   array_push($strArr, $sub['month']);
                   array_push($subArr, $sub['count']);

                }
                $j = 1;
                $unstr = "";
                foreach($unsubdata as $unsub){
                   $unstr .= $unsub['count'];
                   if ($j < $tcnt) {
                    $unstr .= ",";
                    $j++;
                   }
                   array_push($unsubArr, $sub['count']);

                }
               ?>
                </div>
              </div><!-- /.card-header -->

              <div class="card-body">
                <div class="tab-content p-0">
                  <!-- Morris chart - Sales -->
                  <div class="chart tab-pane active" id="revenue-chart"
                       style="position: relative; height: 342px;">
                      <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                   </div>
                  
                </div>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- Calendar -->
            
            <!-- /.card -->
            
          </section>
          <section class="col-lg-5 connectedSortable todaysUser__activity">
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <!-- <i class="fa fa-line-chart mr-1"></i> -->
                  <i class="fas fa-chart-line mr-1"></i>
                  TODAY'S STATS
                </h3>
                <!-- card tools -->
                <div class="card-tools">
                  
                </div>
                <!-- /.card-tools -->
              </div>
              <div class="card-body">
                <!-- <div id="world-map" style="height: 250px; width: 100%;"></div> -->
                <div class="box_section">
                  <a href="#" class="box_1">
                    <span> <!--<i class="icon-calender"></i> -->User Subscribe: <span id="subToday">559</span></span>
                  </a>
                  <a href="#" class="box_2">
                    <span>Email alerts send: <span id="emailToday">987</span></span>
                  </a>
                  <a href="#" class="box_3">
                    <span>user un-Subsribe: <span id="unsubToday">89</span></span>
                  </a>
                </div>
                <div class="img_section text-center">
                  <img src="{!! asset('theme/dist/img/Graphic_Elements.svg') !!}" >
                </div>
              </div>
              
            </div>
          </section>
        </div>  
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <div class="row two_col__section_2">
          <section class="col-lg-7 connectedSortable calender_box">
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="far fa-calendar-alt"></i>
                  CALENDAR
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body pt-0">
                <!--The calendar -->
                <div id="calendar" class="calenderViewWrap"></div>
              </div>
              <!-- /.card-body -->
            </div>
          </section>
          <section class="col-lg-5 connectedSortable emailAlert__graph">
            <!-- Map card -->
            
            <!-- /.card -->

            <!-- solid sales graph -->
            <div class="card bg-gradient-white">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-envelope-open-text mr-1"></i>
                  EMAIL ALERT GRAPH
                </h3>
                <?php
                  // echo "<pre>";print_r($emailChart);

                  function weekOfMonth($date) {
                      //Get the first day of the month.
                      $firstOfMonth = strtotime(date("Y-m-01", $date));
                      //Apply above formula.
                      return weekOfYear($date) - weekOfYear($firstOfMonth) + 1;
                  }
                  
                  function weekOfYear($date) {
                      $weekOfYear = intval(date("W", $date));
                      if (date('n', $date) == "1" && $weekOfYear > 51) {
                          // It's the last week of the previos year.
                          return 0;
                      }
                      else if (date('n', $date) == "12" && $weekOfYear == 1) {
                          // It's the first week of the next year.
                          return 53;
                      }
                      else {
                          // It's a "normal" week.
                          return $weekOfYear;
                      }
                  }
                  
                  // A few test cases.
                  // echo weekOfMonth(strtotime("2020-04-12")) . " "; // 2
                  // Week of the month = Week of the year - Week of the year of first day of month + 1
                $newArr = [];
                  foreach ($emailChart as $value) {
                    
                    if(strlen($value['week']) < 2) $value['week'] = "0".$value['week'];
                    // $newArr[$value['week']." ".$value['month']." ".$value['year']] = $value['count'];
                    $firstOfMonth = strtotime(date("Y-m-01", strtotime($value['year']."-".$value['month']."-01")));
                    $wm = $value['week'] - weekOfYear($firstOfMonth);
                    $newArr[$wm."week of ".$value['month']." ".$value['year']] = $value['count'];
                  }
                  
                ?>
                <?php 
                  $firstOfMonth = strtotime(date("Y-m-01"));
                  $wm = date("W") - weekOfYear($firstOfMonth);
                  $lab = $wm."week of ".date("F")." ".date("Y");
                  for ($i = 1; $i < 6; $i++) {
                    $l = date("Y-m-d", strtotime("-$i week"));
                    $firstOfMonth = strtotime(date("Y-m-01", strtotime("-$i week")));
                    $wm = date("W",strtotime($l)) - weekOfYear($firstOfMonth);
                    $lab .= ",".$wm."week of ".date("F",strtotime($l))." ".date("Y",strtotime($l));
                  }
                  
                  $fArr = array_reverse(explode(",", $lab));
                  $dataArr =  [];
                  foreach ($fArr as $value) {
                    if (array_key_exists($value,$newArr))
                    {
                      array_push($dataArr, $newArr[$value]);
                    }
                    else{
                      array_push($dataArr, 0);
                    }
                  }
                 ?>
                <div class="card-tools">
                
                </div>
              </div>
              <div class="card-body">
                <canvas class="chart" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->

            
          </section>
        </div>
          <!-- right col -->

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    
    <div class="modal fade" id="emailModalLong" tabindex="-1" role="dialog" aria-labelledby="emailModalLongTitle" aria-hidden="true">
      <div class="modal-dialog modal-sm  modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="emailModalLongTitle"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div>Subscribed: <span id="c_sub">0</span></div>
            <div>Unsubscribed: <span id="c_unsub">0</span></div>
            <div>Email Alerts: <span id="c_email">0</span></div>
          </div>
          <!-- <div class="modal-footer">
          </div> -->
        </div>
      </div>
    </div>
    
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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />

<!-- jQuery -->
<script src="{!! asset('theme/plugins/jquery/jquery.min.js') !!}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{!! asset('theme/plugins/jquery-ui/jquery-ui.min.js') !!}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{!! asset('theme/plugins/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
<!-- ChartJS -->
<script src="{!! asset('theme/plugins/chart.js/Chart.min.js') !!}"></script>
<!-- Sparkline -->
<script src="{!! asset('theme/plugins/sparklines/sparkline.js') !!}"></script>
<!-- JQVMap -->
<script src="{!! asset('theme/plugins/jqvmap/jquery.vmap.min.js') !!}"></script>
<script src="{!! asset('theme/plugins/jqvmap/maps/jquery.vmap.usa.js') !!}"></script>
<!-- jQuery Knob Chart -->
<script src="{!! asset('theme/plugins/jquery-knob/jquery.knob.min.js') !!}"></script>
<!-- daterangepicker -->
<script src="{!! asset('theme/plugins/moment/moment.min.js') !!}"></script>
<script src="{!! asset('theme/plugins/daterangepicker/daterangepicker.js') !!}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{!! asset('theme/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') !!}"></script>
<!-- Summernote -->
<script src="{!! asset('theme/plugins/summernote/summernote-bs4.min.js') !!}"></script>
<!-- overlayScrollbars -->
<script src="{!! asset('theme/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') !!}"></script>
<!-- AdminLTE App -->
<script src="{!! asset('theme/dist/js/adminlte.js') !!}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>

<script>

  var ctx = document.getElementById('line-chart').getContext('2d');
  var lab = '<?php $firstOfMonth = strtotime(date("Y-m-01")); $wm = date("W") - weekOfYear($firstOfMonth);echo $lab = $wm."week of ".date("F")." ".date("Y"); for ($i = 1; $i < 6; $i++) {$l = date("Y-m-d", strtotime("-$i week"));$firstOfMonth = strtotime(date("Y-m-01", strtotime("-$i week")));$wm = date("W",strtotime($l)) - weekOfYear($firstOfMonth);echo ",".$wm."week of ".date("F",strtotime($l))." ".date("Y",strtotime($l));}?>';

  var numbersArray = lab.split(',');
  const dataStr = '<?php echo json_encode($dataArr) ?>';
  const newdataStr = dataStr.replace(/[\])}[{(]/g, '');
  const dataStrs = newdataStr.split(',');

  var salesGraphChartData = {
    labels: numbersArray.reverse(),
    datasets: [
      {
        label: 'Email Alerts',
        fill: false,
        borderWidth: 2,
        lineTension: 0,
        spanGaps: true,
        borderColor: '#23334a',
        pointRadius: 3,
        pointHoverRadius: 7,
        pointColor: '#23334a',
        pointBackgroundColor: '#23334a',
        data: dataStrs
      }
    ]
  }

  // This will get the first returned node in the jQuery collection.
  // eslint-disable-next-line no-unused-vars
  var salesGraphChart = new Chart(ctx, { // lgtm[js/unused-local-variable]
    type: 'line',
    data: salesGraphChartData
    // ,
    // options: salesGraphChartOptions
  });



  // Sales chart
  var salesChartCanvas = document.getElementById('revenue-chart-canvas').getContext('2d');
  
  var labeldata = [];
  var subdata = [];
  var unsubdata = [];
  
  $.ajax({
      headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
      url: "{{ route('getravchartdata') }}",
      method: "GET",
      success: function(data) {
        console.log(data);
        for (var i = 0; i < data.length; i++){ 
          labeldata = data[i].month;
          subdata = data[i].subcount;
          unsubdata = data[i].unsubcount;
          
        }

        console.log(labeldata);
        console.log(subdata);
        console.log(unsubdata);

        var salesChartData = {
          labels: labeldata,
          datasets: [
            {
              label: 'Subscribed',
              backgroundColor: 'rgba(60,141,188,0.9)',
              borderColor: 'rgba(60,141,188,0.8)',
              pointRadius: false,
              pointColor: '#3b8bba',
              pointStrokeColor: 'rgba(60,141,188,1)',
              pointHighlightFill: '#fff',
              pointHighlightStroke: 'rgba(60,141,188,1)',
              // data: ['<?php echo $subsstr ?>']
              data: subdata
            },
            {
              label: 'Unsubscribed',
              backgroundColor: 'rgba(210, 214, 222, 1)',
              borderColor: 'rgba(210, 214, 222, 1)',
              pointRadius: false,
              pointColor: 'rgba(210, 214, 222, 1)',
              pointStrokeColor: '#c1c7d1',
              pointHighlightFill: '#fff',
              pointHighlightStroke: 'rgba(220,220,220,1)',
              // data: ['<?php echo $unstr ?>']
              data: unsubdata
            }
          ]
        }

        var salesChartOptions = {
          maintainAspectRatio: false,
          responsive: true,
          legend: {
            display: false
          },
          scales: {
            xAxes: [{
              gridLines: {
                display: false
              }
            }],
            yAxes: [{
              gridLines: {
                display: false
              }
            }]
          }
        }

        // This will get the first returned node in the jQuery collection.
        // eslint-disable-next-line no-unused-vars
        var salesChart = new Chart(salesChartCanvas, { // lgtm[js/unused-local-variable]
          type: 'line',
          data: salesChartData,
          options: salesChartOptions
        })

      }
  });


    $('#calendar').datepicker({
    format:'Y-m-d',
    inline:true,
    lang:'en',
    nextText: '>',
    prevText: '<'
  }).on('change', function(e) {  
    console.log(e, e.target.value);  
    
    $('.modal').modal('show');

    $.ajax({
      headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
      url: "<?php echo url('getcalendardata?sdate="+e.target.value+"') ?>",
      method: "GET",
      success: function(data) {
        console.log(data);
        
        $("#emailModalLongTitle").html('<b>Date: '+e.target.value+'</b>');
        $("#c_sub").text(data[0].c_sub);
        $("#c_unsub").text(data[0].c_unsub);
        $("#c_email").text(data[0].c_email);
      }
    });
});

</script>
<script type="text/javascript">

  $(document).ready(function(){
    loadToday();
    setInterval(
      function(){
        loadToday();
      }, 60000);

    function loadToday(){
      $.ajax({
          headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
          url: "{{ route('gettodaysdata') }}",
          method: "GET",
          success: function(data) {
            console.log(data);
            $("#subToday").text(data[0].subToday);
            $("#emailToday").text(data[0].emailToday);
            $("#unsubToday").text(data[0].unsubToday);
           
          }
        });
    }

  });
</script>
@endsection
