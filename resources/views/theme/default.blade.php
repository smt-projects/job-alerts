<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Job Alert | Admin</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link href="{!! asset('theme/plugins/bootstrap/bootstrap.min.css') !!}" rel="stylesheet">
  <link rel="stylesheet" href="{!! asset('theme/plugins/fontawesome-free/css/all.min.css') !!}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{!! asset('theme/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') !!}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{!! asset('theme/plugins/icheck-bootstrap/icheck-bootstrap.min.css') !!}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{!! asset('theme/plugins/jqvmap/jqvmap.min.css') !!}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{!! asset('theme/dist/css/adminlte.min.css') !!}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{!! asset('theme/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') !!}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{!! asset('theme/plugins/daterangepicker/daterangepicker.css') !!}">
  <!-- summernote -->
  <link rel="stylesheet" href="{!! asset('theme/plugins/summernote/summernote-bs4.min.css') !!}">


  <!-- Custom Css -->
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/font-icons.css') }}" rel="stylesheet">


  <link href="{!! asset('theme/plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css') !!}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/css/bootstrap-switch-button.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js"></script>



  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">

  <!-- Select2 -->
  <link rel="stylesheet" href="{!! asset('theme/plugins/select2/css/select2.min.css') !!}">
  <link rel="stylesheet" href="{!! asset('theme/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') !!}">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{!! asset('theme/dist/img/VanderHouwenLogo-01.png') !!}" alt="VanderHouwenLogo-01" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    

    @include('theme.header')
    

  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @include('theme.sidebar')
    @yield('content')
  
<script type="text/javascript">

  $(document).ready(function(){
      $('#notiarea').hide();
    loadNotify();
    setInterval(
      function(){
        loadNotify();
      }, 60000);

    function loadNotify(){
      $.ajax({
          headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
          url: "{{ route('getnotifydata') }}",
          method: "GET",
          success: function(data) {
            console.log(data);
            $(".dropdown-item.dropdown-header").text(data[0].notify + " Notifications");
            $(".badge.badge-warning.navbar-badge").text(data[0].notify);
            if(data[0].unsubCount > 0){
                $('#notiarea').show();
              $("#unsubnoti").html('<i class="fas fa-users mr-2"></i><a href="<?php echo url('/subscribers'); ?>">'+data[0].unsubCount + ' New unsubscriptions</a>');
            }
            if(data[0].alertCount > 0){
                $('#notiarea').show();
              $("#alertnoti").html('<i class="fas fa-envelope mr-2"></i><a href="<?php echo url('/emaillogs'); ?>">'+data[0].alertCount + ' Email Alerts Sent</a>');
            }
            // $("#unsubToday").text(data[0].unsubToday);
           
          }
        });
    }

  });
</script>
</body>
</html>
