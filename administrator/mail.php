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
        header ("Location: ../index.php");
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

    <title>WEDDING WIRE | ADMIN </title>
    <link rel="icon" type="image/ico" href="../favicon.ico">    

    <!-- Bootstrap -->
    <link href="../lib/gentella/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../lib/gentella/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../lib/gentella/vendors/nprogress/nprogress.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../lib/gentella/build/css/custom.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/animate.css"> 
    <link rel="stylesheet" href="../css/responsive.css">
    
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
                  <li>
                      <a href="index.php"><i class="fa fa-home"></i> Dashboard </a>                    
                  </li>
                  <li class="active">
                      <a href="#"><i class="fa fa-inbox"></i> Mail</a>
                  </li>
                              
                </ul>
              </div>           
            </div>
            <!-- /sidebar menu -->
            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">              
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="../index.php?logout=1">
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
                  <li><a  href="../index.php?logout=1"><button class="btn btn-info">LOG OUT</button></a></li>
                </ul>
              
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <!-- For to send the email -->
          <div class="page-title">
            <div class="title_left">
              <h3>Send an email to one of the users</h3>
            </div>

            <div class="title_right">
                <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span><i class="fa fa-bell"></i>Notifications</span>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    
                  </ul>
                </li>
               
              </ul>
            </div>
                
        </div>
          <div class="col-md-6 col-xs-12">
              <form id="compose" method="post">
                  <div id="response" class="alert alert-success alert-dismissible">
                      <button class="close" data-dismiss="alert" type="button"><span>&times;</span></button>
                  </div>
                  <div class="form-group">
                      <label for="sendTo">To</label> <br>
                      <input type="email" name="sendTo" id="sendTo" placeholder="Receipient" required>
                  </div>
                  <div class="form-group">
                      <label for="subject">Subject</label> <br>
                      <input type="text" name="subject" id="subject" placeholder="Subject" required>
                  </div>
                  <div class="form-group">
                      <label for="message">Message</label> <br>
                      <textarea name="message" id="message" placeholder="Message"></textarea>
                  </div>
                  <div class="form-group">
                      <input type="reset" class="btn btn-warning" value="CANCEL">
                      <input type="submit" name="send" class="btn btn-success" id="send" value="SEND">
                  </div>
              </form>

          </div>
        <!-- /page content -->

        
      </div>
    </div>

    <!-- jQuery -->
    <script src="../lib/gentella/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../lib/gentella/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../lib/gentella/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../lib/gentella/vendors/nprogress/nprogress.js"></script>
    <!-- jQuery Knob -->
    <script src="../lib/gentella/vendors/jquery-knob/dist/jquery.knob.min.js"></script>
    <!-- Typehead -->
    <script src="../lib/typeahead.js"></script>
    
    
    <!-- Custom Theme Scripts -->
    <script src="../lib/gentella//build/js/custom.min.js"></script>
    <!-- Local script -->
    <script src="../lib/admin.js"></script>
  </body>
</html>
