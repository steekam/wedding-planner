<?php
    session_start();  

    if (array_key_exists("id", $_COOKIE) AND isset($_COOKIE['id']) ){
      $_SESSION['id'] = $_COOKIE['id'];
    }

    if (array_key_exists("id",$_SESSION) AND isset($_SESSION['id'])) {
        include("connect.php");

        $username = "";

        $user_id = mysqli_real_escape_string($link, $_SESSION['id']);
        $query = "SELECT * FROM users WHERE id = '$user_id';";
        $result = mysqli_query($link, $query);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            $username = $row['username'];
        }
    } else {
        header ("Location: index.php");
    }

    
    
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>WEDDING WIRE | DASHBOARD </title>
    <link rel="icon" type="image/ico" href="favicon.ico">    

    <!-- Bootstrap -->
    <link href="lib/gentella/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="lib/gentella/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="lib/gentella/vendors/nprogress/nprogress.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="lib/gentella/build/css/custom.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/animate.css"> 
    <link rel="stylesheet" href="css/responsive.css">
    
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col" id="side_menu">
          <div class="left_col scroll-view">
            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
              <ul class="nav side-menu">
                  <li class="active">
                      <a href="#"><i class="fa fa-home"></i> Dashboard </a>                    
                  </li>
                  <li>
                      <a href="account/checklist/checklist.php"><i class="fa fa-check-circle-o"></i> Checklist </a>                    
                  </li>
                  <li>
                      <a href="account/budgeter/budgeter.php"><i class="fa fa-money"></i> Budgeter </a>
                  </li>
                  <!-- <li>
                      <a href="account/guest-list/guestlist.php"><i class="fa fa-user-plus"></i> Guest list </a>
                  </li> -->
                </ul>
              </div>           
            </div>
            <!-- /sidebar menu -->
            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">              
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="index.php?logout=1">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->           
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

                <ul class="nav navbar-nav navbar-left">
                  <li><a class = "site_title" href="dashboard.php">WEDDING WIRE</a></li>
                </ul>
              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    ACCOUNT
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="account/settings/profile.php"> Profile</a></li>
                    <li><a href="index.php?logout=1"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
               
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="row">
            <!-- Wedding details tile -->
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Your Wedding Details</h2>

                  <ul class="nav navbar-right panel_toolbox">
                    <li>
                      <button class="btn btn-info"><a  style="color: white;" href="account/settings/profile.php">Update</a></button>
                    </li>                  
                  </ul>
                  <div class="clearfix"></div>
                </div>

                <div class="x_content">
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 wedding-image">
                      <img src="assets/image/user_cover/beachfront.jpg" alt="">
                      <form  method="post" enctype="multipart/form-data">
                        <input type="file" name="cover_image" id="cover_image" style="display: none;">
                      </form>
                    </div>
                  </div>

                  <div class="row" style="margin-top: 30px;">
                    <div class="sentiment">
                      <img src="assets/image/icons/wedding.png" alt="">
                      <span id="user_lastname"></span>  &  <span id="partner_lastname"></span>
                    </div>                
                  </div>
                </div>
                
                <div class="row sentiment"  style="font-size:17px;">
                  <i class="fa fa-calendar col-md-1"></i> <div id="wedding_date" class="col-md-6"></div>
                </div>

              </div>
            </div>
            <!-- End of wedding details tile -->
            <!-- Planning progress tile -->
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Planning progress</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <a href="account/budgeter/budgeter.php">
                    <div class="row progress-card">
                      <div class="theProgress col-md-5 col-xs-5 col-sm-5">
                        <div class="progress_content">
                          <span><sup>ksh</sup><span id="used_budget"></span> </span><br>
                          <small>of <b id="total_budget"></b></small>
                        </div>
                      </div>

                      <div class="pg_description col-md-7 col-xs-7 col-sm-7">
                        Budgeter <br>
                        <div class="pg_byline">
                          Manage your expesnses and keep your day on the budget
                        </div>
                      </div>
                    </div>
                  </a>

                  <a href="account/checklist/checklist.php">
                    <div class="row progress-card">
                      <div class="theProgress col-md-5 col-xs-5 col-sm-5">
                        <div class="progress_content">
                          <b id="perc_completed"></b> <br>completed
                        </div>
                      </div>

                      <div class="pg_description col-md-7 col-xs-7 col-sm-7">
                        Checklist <br>
                        <div class="pg_byline">
                          Manage your actvities making sure you don't miss a thing
                        </div>
                      </div>
                    </div>
                  </a>

                  <a href="account/guest-list/guestlist.php">
                    <div class="row progress-card">
                      <div class="theProgress col-md-5 col-xs-5 col-sm-5">
                        <div class="progress_content" style="font-size: 80%">
                          <b id="invited">100</b> <br>invited <br>
                          <b id="RSVP">20</b>  <br> RSVP
                        </div>
                      </div>

                      <div class="pg_description col-md-7 col-xs-7 col-sm-7">
                        Guests <br>
                        <div class="pg_byline">
                          Manage your guest lists and RSVPs all in one place
                        </div>                      
                      </div>
                    </div>
                  </a>

                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- /page content -->

        
      </div>
    </div>

    <!-- jQuery -->
    <script src="lib/gentella/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="lib/gentella/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="lib/gentella/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="lib/gentella/vendors/nprogress/nprogress.js"></script>
    <!-- jQuery Knob -->
    <script src="lib/gentella/vendors/jquery-knob/dist/jquery.knob.min.js"></script>
    <!-- Cropper -->
    <!-- <script src="lib/gentella/vendors/cropper/dist/cropper.min.js"></script> -->
    
    <!-- Custom Theme Scripts -->
    <script src="lib/gentella//build/js/custom.min.js"></script>
    <!-- Local script -->
    <script src="lib/dashboard.js"></script>
  </body>
</html>
