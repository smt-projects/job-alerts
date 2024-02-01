<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Job Alert</title>

        <!-- Fonts -->
        <!-- <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet"> -->

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito';
            }
        </style>

        <!-- Google Font: Source Sans Pro -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
  <!-- Font Awesome -->
  <link href="{!! asset('theme/vendor/bootstrap/bootstrap.min.css') !!}" rel="stylesheet">
  <link rel="stylesheet" href="{!! asset('theme/plugins/fontawesome-free/css/fontawesome.min.css') !!}">
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
  <!-- Header Css -->
  <!-- <link href="{{ asset('assets/css/onlyHeader.css') }}" rel="stylesheet"> -->

  <?php
$hostwithHttp = request()->getSchemeAndHttpHost();
 ?>
 <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-28422152-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-28422152-1');
</script>
    </head>
    <body class="antialiased wellCome__page">

    <section class="headGroupWrap">
	    <header class="siteHeader">
        <div class="headerTop">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <ul class="float-right">
                            <li><a href="<?php echo $hostwithHttp; ?>/salary-guides/"><i class="fas fa-dollar-sign"></i>Salary Guide</a></li>
                            <li><a href="<?php echo $hostwithHttp; ?>/job-alerts/public/"><i class="fas fa-bell"></i>Job Alerts</a></li>
                        </ul>
                    </div> 
                </div>
            </div>
        </div> 
          <section class="middleHeader">
            <div class="container"> 
                <div class="row">
                    <div class="col-lg-3 col-md-12 d-flex align-items-center logo__sec"> 
                        <a href="<?php echo $hostwithHttp; ?>"> 
                            <img src="{!! asset('theme/dist/img/main-logo.png') !!}" width="" height="" alt="VanderHouwen Logo"> 
                        </a> 
                        <!-- Nav button -->
                        <a class="navbar-toggler collapsed border-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"> <!-- these spans become the three lines --> <span> </span> <span> </span> <span> </span> </a>
                    </div>                     
                    <div class="col-lg-9 col-md-12 d-flex justify-content-end main__nav__section"> 
                    <!-- <a class="navbar-toggler collapsed border-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">                         -->
                        <nav class="navbar navbar-expand-md main_nav_sec">
                            <div class="collapse navbar-collapse" id="navbarSupportedContent" wp-nav-menu="header" wp-register-menu="header" wp-register-menu-description="Header Area" wp-nav-menu-type="smart" wp-nav-menu-id="navbarSupportedContent" wp-nav-menu-class="menu" wp-nav-menu-theme-location="header" wp-if-has-nav-menu="header">
                              <ul class="navbar-nav mr-auto">
                                  <li class="active"><a href="<?php echo $hostwithHttp; ?>/employers/">Find Talent</a></li>                                 
                                  <li><a href="<?php echo $hostwithHttp; ?>/job-seekers/">Get Hired</a></li>                                 
                                  <li><a href="<?php echo $hostwithHttp; ?>/resources/">Resources</a></li>                                 
                                  <li><a href="<?php echo $hostwithHttp; ?>/about-us/">About Us</a></li>                                 
                                  <li class="lastchild"><a href="<?php echo $hostwithHttp; ?>/contact-us/"> Contact Us</a></li>   
                              </ul>
                            </div>
                        </nav>
                    </div>                         
                </div>                 
            </div>  
          </section>           
        </header>

    <!-- Banner Start --> 
        <section class="siteBanner">
          <div class="container">
            <div class="row">
              <div class="col-lg-6 d-flex align-items-center">
                <div class="bannerText__box">
                  <h1>THE BEST JOBS <br> DELIVERED<br> TO YOUR INBOX</h1>
                  <p>Subscribe to our weekly custom job alerts to  stay informed on the latest jobs in your industry. </p>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="bannerForm">
                  <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                          <!-- general form elements -->
                          <div class="card">
                            <div class="card-header">
                              <h4>Select All That Apply</h4>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('job-alert.store') }}" method="POST">
                              @csrf
                              @method('POST')
                              <div class="card-body">
                                <?php 
                                  $fname = '';
                                  $lname = '';
                                  $email = '';
                                  $opted_for = [];
                                  
                                  if(isset($subscriber)){
                                    $fname = $subscriber[0]->fname;
                                    $lname = $subscriber[0]->lname;
                                    $email = $subscriber[0]->email;
                                    $opted_for = explode(',', $subscriber[0]->opted_for);
                                  } 
                                ?>

                                <div class="form-group">
                                  <input type="text" class="form-control" id="fname" name="fname" placeholder="First name*" value="<?= $fname; ?>" required="required">
                                  <span class="inputFeild__icons"><i class="far fa-user"></i></span>
                                </div>
                                <div class="form-group">
                                  <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name*" value="<?= $lname; ?>" required="required">
                                  <span class="inputFeild__icons"><i class="far fa-user"></i></span>
                                </div>
                                <div class="form-group">
                                  <input type="email" class="form-control" id="email" name="email" placeholder="Email*" value="<?= $email; ?>" required="required">
                                  <span class="inputFeild__icons"><i class="far fa-envelope"></i></span>
                                </div>

                                @foreach ($categories as $category)
                                      <div class="form-check">
                                          <input type="checkbox" class="form-check-input" id="categoryCheck_{{ $category->id }}" name="opted_for[]" value="{{ $category->id }}" <?= in_array($category->id, $opted_for)? "checked" : ""; ?>>
                                          <label class="form-check-label" for="categoryCheck_{{ $category->id }}">{{ $category->title }}</label>
                                      </div>
                                  @endforeach
                                
                              </div>
                              <!-- /.card-body -->

                              <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                              </div>
                            </form>
                          </div>
                          <!-- /.card -->
              </div>
                </div>
              </div>
            </div> 
                            
          </div>                     
        </section>             
    <!-- Banner End --> 
    </section>

    <section class="jobAlert__section">
      <div class="container">
        <h2 class="text-center">Job Alert Details</h2>
        <div class="row d-flex justify-content-center">
          <div class="col-md-4 col-sm-6">
            <div class="card text-center">
              <img class="img-fluid" src="{!! asset('theme/dist/img/systemAndDatabase_icon.png') !!}" alt="Card image cap">
              <div class="card-body">
                <h5>Systems and Database Operations</h5>
                <p>Network Engineering, Systems Administration, Security, Technical Support, and more.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-6">
            <div class="card text-center">
              <img class="img-fluid" src="{!! asset('theme/dist/img/AccountingAndFinance_icon.png') !!}" alt="Card image cap">
              <div class="card-body">
                <h5>Accounting and Finance</h5>
                <p>Accounting, Tax/Audit, Payroll, Executive/Management, Accounts Payable/Accounts Receivable (AP/AR), and more.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-6">
            <div class="card text-center">
              <img class="img-fluid" src="{!! asset('theme/dist/img/SoftwareDevelopment_icon.png') !!}" alt="Card image cap">
              <div class="card-body">
                <h5>Software Development</h5>
                <p>Java, JavaScript, .NET Development, Mobile Development, General Software Development, Quality Assurance (QA), and more.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-6">
            <div class="card text-center">
              <img class="img-fluid" src="{!! asset('theme/dist/img/Engineering_icon.png') !!}" alt="Card image cap">
              <div class="card-body">
                <h5>Engineering</h5>
                <p>Mechanical, Electrical, Embedded Software, Project/Program Engineering Management, Hardware Engineering, Manufacturing, Engineering Management, 
                  and more.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-6">
            <div class="card text-center">
              <img class="img-fluid" src="{!! asset('theme/dist/img/BusinessAnalysis_icon.png') !!}" alt="Card image cap">
              <div class="card-body">
                <h5>Business Analysis and Project Management</h5>
                <p>Project Management, Product Management, Business Analysis, and more.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-6">
            <div class="card text-center">
              <img class="img-fluid" src="{!! asset('theme/dist/img/BusinessServices_icon.png') !!}" alt="Card image cap">
              <div class="card-body">
                <h5>Business Services</h5>
                <p>Sales, Marketing, Human Resources, Supply Chain, Creative, Management, Administrative, and more.</p>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </section>

    <section class="one_col__section">
      <div class="container oneCol__section_inner">
          <div class="row">
              <div class="col-lg-7 col-md-9 offset-lg-1 d-sm-flex justify-content-end align-items-center text_section">
                  <img src="{!! asset('theme/dist/img/get-employment-icons.png') !!}" class="img-fluid" >
                  <p class="pl-3">Get employment trends, career advice, and job search tips sent to your inbox monthly.</p>
              </div>
              <div class="col-lg-3 col-md-3 d-flex justify-content-md-end justify-content-center align-items-md-center">
                  <!-- <a href="#">Sign Up</a> -->
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#signUpModal">
                    Sign Up
                  </button>
              </div>
          </div>
      </div>
    </section>

    <section id="VanderJobs" class="two_col__section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 d-flex justify-content-center align-items-center text__box">
                    <div>
                        <h2>DOWNLOAD THE<br>VANDERHOUWEN<br>JOB APP</h2>
                        <p>Stay connected with VanderJobs. Search, view, and apply to jobs while on the go. Receive job alerts when jobs match your keywords. VanderJobs keeps you in the loop wherever you are.
                        </p>
                        <div class="row">
                            <div class="col-lg-5 col-md-6 col-6">
                                  <a href="https://apps.apple.com/us/app/vanderhouwen-jobs/id1623738971">
                                    <img src="{!! asset('theme/dist/img/app-store.png') !!}" class="img-fluid text-right" >
                                  </a>
                               
                            </div>
                            <div class="col-lg-5 col-md-6 col-6">
                                <a href="https://play.google.com/store/apps/details?id=com.staffup.vanderjobs&gl=US">
                                  <img src="{!! asset('theme/dist/img/google-store.png') !!}" class="img-fluid" >
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 imgBox">
                    <img src="{!! asset('theme/dist/img/vander-ph-img.png') !!}" class="img-fluid" >
                </div>
            </div>
        </div>
    </section>

    <footer class="siteFooter"> 
        <section class="siteFooter__top"> 
            <div class="container"> 
                <div class="row">
                	<div class="col-md-3 text-md-left text-sm-center">
                		<a class="footer-logo" href="#">
                			<img src="{!! asset('theme/dist/img/footer-logo.png') !!}" class="img-fluid">
                    </a>
                		<p>VanderHouwen is a premier staffing provider of Technology, Accounting & Finance, and Engineering professionals.</p>
                		<div class="footer-wbenc-certified">
                      <a href="https://www.wbenc.org/certification/">
                        <img src="{!! asset('theme/dist/img/wbenc-certified.png') !!}" class="img-fluid">
                      </a>             			
                		</div>
                	</div>
                	<div class="col-md-3 col-sm-4">
                		<h5>Quick Links</h5>
                		<ul>
                			<li><a href="<?php echo $hostwithHttp; ?>/employers/">Find Talent</a></li>
                			<li><a href="<?php echo $hostwithHttp; ?>/job-seekers/">Get Hired</a></li>
                      <li><a href="<?php echo $hostwithHttp; ?>/job-alerts/public/">Job Alerts</a></li>
                			<li><a href="<?php echo $hostwithHttp; ?>/about-us/">About VanderHouwen</a></li>
                			<li><a href="<?php echo $hostwithHttp; ?>/diversity-commitment/">Diversity Commitment</a></li>
                			<li><a href="<?php echo $hostwithHttp; ?>/join-our-team/">Join Our Team</a></li>
                			<li><a href="<?php echo $hostwithHttp; ?>/about-us/frequently-asked-questions/">FAQs</a></li>
                		</ul>
                	</div>
                	<div class="col-md-3 col-sm-4">
                		<h5>TOP RESOURCES</h5>
                		<ul>
                			<li><a href="<?php echo $hostwithHttp; ?>/salary-guides/">Salary Guides</a></li>
                			<li><a href="<?php echo $hostwithHttp; ?>/job-postings/">Search Jobs</a></li>
                			<li><a href="<?php echo $hostwithHttp; ?>/resources/#job-seeker-resources">Job Seeker Resources</a></li>
                			<li><a href="<?php echo $hostwithHttp; ?>/resources/#hiring-manager-resources">Hiring Resources</a></li>
                      <li><a href="<?php echo $hostwithHttp; ?>/consultant-portal/">Consultant Portal</a></li>
                			<li><a href="<?php echo $hostwithHttp; ?>/networking-groups/">Networking Groups</a></li>
                		</ul>
                	</div>
                	<div class="col-md-3 col-sm-4 location-social-icons">
                		<h5>Connect With Us</h5>
                		<ul class="location">
                			<li class="d-flex"><i class="far fa-map-marker-alt"></i><p><a href="https://g.page/VanderHouwen?share" target="_blank" rel="noopener noreferrer">6342 S Macadam Ave. <br>Portland, OR 97239</a></p></li>
                			<li class="ph-no"><a href="tel:503-299-6811"><i class="far fa-phone"></i>503-299-6811</a></li>
                		</ul>
                		<ul class="d-flex social-icons">
                			<li><a href="https://www.facebook.com/VanderHouwen/" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                			<li><a href="https://twitter.com/vandertweet" target="_blank"><i class="fab fa-twitter"></i></a></li>
                			<li><a href="https://www.linkedin.com/company/vanderhouwen/" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                			<li><a href="https://www.instagram.com/vanderhouwen.recruits/" target="_blank"><i class="fab fa-instagram"></i></a></li>
                		</ul>
                	</div>
                </div>                
            </div>                 
        </section>      
        <section class="siteFooter__copytxt"> 
            <p class="text-center">© Copyright 2022 <a href="<?php echo $hostwithHttp; ?>/">VanderHouwen</a> - All Rights Reserved | <a href="<?php echo $hostwithHttp; ?>/privacy-policy">Privacy policy</a></p> 
        </section>             
    </footer>  

        <!-- Sign Up Popup For mailchimp Start -->
          <div class="modal fade" id="signUpModal" tabindex="-1" role="dialog" aria-labelledby="signUpModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="signupModalLabel">Newsletter Signup</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <!-- <span aria-hidden="true">&times;</span> --> <i class="far fa-times"></i>
                      </button>
                  </div>
                    <div class="modal-body">
                      <iframe src="<?php echo $hostwithHttp; ?>/signup-form/" title="description" style="width: 100%; height: 308px;"></iframe>
                    </div>
                    <div class="modal-footer" Style="display:none;">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                  </div>
                </div>
              </div>
      <!-- ##END -->



        <script src="{!! asset('assets/js/jquery.min.js') !!}"></script>
        <script src="{!! asset('assets/js/bootstrap.min.js') !!}"></script>
        <script src="{!! asset('assets/js/popper.js') !!}"></script>
    </body>
</html>
