<?php
    session_start();  

    if (array_key_exists("id", $_COOKIE) OR array_key_exists("id",$_SESSION)) {
        include("../../connect.php");

        $username = "";

        $user_id = mysqli_real_escape_string($link, $_SESSION['id']);
        $query = "SELECT * FROM users WHERE id = '$user_id';";
        $result = mysqli_query($link, $query);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            $username = $row['username'];
        }
    } else {
        header ("Location: ../../index.php");
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

    <title>WEDDING WIRE | PROFILE </title>
    <link rel="icon" type="image/ico" href="../../favicon.ico">    

    <!-- Bootstrap -->
    <link href="../../lib/gentella/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../lib/gentella/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../../lib/gentella/vendors/nprogress/nprogress.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../../lib/gentella/build/css/custom.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/dashboard.css"> 
    
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
                      <a href="../../dashboard.php"><i class="fa fa-home"></i> Dashboard </a>                    
                  </li>
                  <li>
                      <a href="../checklist/checklist.php"><i class="fa fa-check-circle-o"></i> Checklist </a>                    
                  </li>
                  <li>
                      <a href="../budgeter/budgeter.php"><i class="fa fa-money"></i> Budgeter </a>
                  </li>
                  <!-- <li>
                      <a href="../guest-list/guestlist.php"><i class="fa fa-user-plus"></i> Guest list </a>
                  </li> -->
                </ul>
              </div>           
            </div>
            <!-- /sidebar menu --> 
            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">              
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="../../index.php?logout=1">
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
                  <li><a class = "site_title" href="../../dashboard.php">WEDDING WIRE</a></li>
                </ul>
              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    ACCOUNT
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="#"> Profile</a></li>
                    <li><a href="../../index.php?logout=1"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
               
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>User Profile</h3>
              </div>              
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <!-- First panel -->
              <div class="x_panel">
                  <div class="x_title">
                    <h2>Personal Details</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li>
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-10">

                      <div class="message">                        
                      </div>

                      <form class="form-horizontal form-label-left" method="post">                       
                        <div class="row">
                          <div class="col-md-6">
                            <div class="item form-group">
                              <label>First Name</label>
                              <input type="text" class="form-control" name="ufirst_name" id="ufirst_name" required>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Last Name</label>
                              <input type="text" class="form-control" name="ulast_name" id="ulast_name" required>
                            </div>
                          </div>
                        </div>
                        
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Username</label>
                              <input type="text" class="form-control" name="username" id="username" required>
                            </div>
                          </div>                          
                        </div>

                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Partner's First Name</label>
                              <input type="text" class="form-control" name="pfirst_name" id="pfirst_name" required>
                            </div>
                          </div>
                          <div class="col-md-6">
                             <div class="form-group">
                              <label>Partner's Last Name</label>
                              <input type="text" class="form-control" name="plast_name" id="plast_name" required>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Your role</label>
                              <input type="text" class="form-control" name="urole" id="urole" required>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Partner's role</label>
                              <input type="text" class="form-control" name="prole" id="prole" required>
                            </div>
                          </div>
                        </div>

                        <button type ="submit" class="btn btn-primary" id="personalSave">SAVE CHANGES</button>
                      </form>
                    </div>
                  </div>
              </div>
              <!-- End of first panel -->
              <!-- Second panel -->
              <div class="x_panel">
                  <div class="x_title">
                    <h2>Wedding Details</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li>
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="message"></div>                  
                    <form class="form-horizontal form-label-left" method="post">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Engagement Date</label>
                              <div class='input-group date' >
                                  <input type='date' class="form-control" id='engagementDate' name="engagementDate" requied>
                                  <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                  </span>
                              </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label>Wedding Date</label>
                                <div class='input-group date'>
                                    <input type='date' class="form-control" id="weddingDate" name="weddingDate" required>
                                    <span class="input-group-addon">
                                      <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Number of Guests</label>
                            <select class="form-control" name="guests" id="guests">
                              <option value=""></option>
                              <option value="below 200">below 200</option>
                              <option value="200-300">200-300</option>
                              <option value="400-500">400-500</option>
                              <option value="above 500">above 500</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Wedding Budget</label>
                            <select class="form-control" name="budget" id="budget">
                              <option value=""></option>
                              <option value="below 500K">below 500K</option>
                              <option value="500K-800K">500K-800K</option>
                              <option value="800K-1M">800K-1M</option>
                              <option value="above 1M">above 1M</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <button type ="submit" class="btn btn-primary" id="weddingSave">SAVE CHANGES</button>
                    </form>
                    
                  </div>
              </div>
              <!-- End of second panel -->
              <!-- Third panel -->
              <div class="x_panel">
                  <div class="x_title">
                    <h2>Account Management</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li>
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">
                        <h3>Update Your Email</h3> <hr>
                      
                      <div class="message"></div>  

                        <div class="form-group col-md-4 curr">
                          <label>Current Email</label>
                          <input class="form-control" type="text" name="currentEmail" id="currentEmail" disabled>
                        </div>

                        <div class="col-md-3 curr" style="margin-top: 23px;">
                          <button class="btn btn-dark" id="editEmail">Edit email</button>
                        </div>

                        <!-- Hidden form to appear on edit email -->
                        <div class="changeEmail">
                          <form method="post" class="form-horizontal form-label-left">
                            <div class="row">
                              <div class="form-group col-md-5">
                                <label>New Email</label>
                                <input class="form-control" type="email" name="newEmail" id="newEmail" required>
                              </div>
                              <div class="form-group col-md-5">
                                <label>Confirm Password</label>
                                <input class="form-control" type="password" name="password" id="password" required>
                              </div>

                              <div class="form-group col-md-5" style="float:right;margin-top:23px;">
                                <button class="btn btn-dark" id="cancelChange">CANCEL</button>
                                <button class="btn btn-success" id="saveEmail">SAVE CHANGES</button>
                              </div>                              
                            </div>
                          </form>
                        </div>
                        <!-- end of change email form -->
                    </div>

                    <div class="row">
                      <h3>Change Your Password</h3> <hr>
                      <div class="changePassword">
                      <div class="message"></div>
                        <form class="form-horizontal form-label-left" method="post" novalidate>
                          <div class="col-md-12" style="padding-left:0px;">
                            <div class="form-group item col-md-5" style="padding-left:0px;">
                              <label>Current Password</label>
                              <input class="form-control" type="password" name="currentPassword" id="currentPassword" required="requied">
                            </div>
                          </div>
                            
                          <div class="row">
                            <div class="form-group item col-md-5">
                              <label>New Password</label>
                              <input class="form-control" type="password" name="newPassword" id="newPassord" data-validate-length-range="8,100" required="required">
                            </div>
                            <div class="form-group item col-md-5">
                              <label>Confirm New Password</label>
                              <input class="form-control" type="password" name="confirmPassword" id="confirmPasssword" data-validate-linked="newPassword" required="required">
                            </div>
                          </div>
                          <button type="subimt" id="savePassword" class="btn btn-primary">SAVE CHANGES</button>
                        </form>
                      </div>
                    </div>

                    <div class="row">
                      <h3>Delete Your Account</h3> <hr>
                      <div class="col-md-3">
                        <p style="font-size: 130%;">Decided to change your plans?</p>
                      </div>
                      <div class="col-md-6">
                        <button class="btn btn-danger" id="deleteAccount" data-toggle="modal" data-target="#deleteModal">DELETE ACCOUNT</button>
                      </div>

                      <!-- Delete Modal -->
                      <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body" style="font-size: 120%;">
                              Are you sure you want to delete your account ? <br>
                              Please don't, we will miss you 
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">No, I'm not leaving</button>
                              <button type="button" class="btn btn-danger" id="confirmDelete">Yes, Delete My Account</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- End of delete modal -->

                    </div>
                  </div>
              </div>
              <!-- end of third panel -->
            </div>
          </div>
        </div>
        <!-- /page content -->

        
      </div>
    </div>

    <!-- jQuery -->
    <script src="../../lib/gentella/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../../lib/gentella/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../../lib/gentella/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../../lib/gentella/vendors/nprogress/nprogress.js"></script>
    <!-- validator -->
    <script src="../../lib/gentella/vendors/validator/validator.js"></script>
    
    <!-- Local javascript -->
    <script src="profile.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="../../lib/gentella//build/js/custom.min.js"></script>
  </body>
</html>