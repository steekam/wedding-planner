<?php
    session_start();  

    if (array_key_exists("id", $_COOKIE) OR array_key_exists("id",$_SESSION)) {
        
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

    <title>WEDDING WIRE | CHECKLIST </title>
    <link rel="icon" type="image/ico" href="../../favicon.ico">    

    <!-- Bootstrap -->
    <link href="../../lib/gentella/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../lib/gentella/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../../lib/gentella/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="../../lib/gentella/vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    

    <!-- Custom Theme Style -->
    <link href="../../lib/gentella/build/css/custom.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/dashboard.css"> 
    <link rel="stylesheet" href="../../css/responsive.css">
    <link rel="stylesheet" href="../../css/animate.css">
    
  </head>

  <body class="nav-md">
    <div class="container body">
          <div class="overlay"></div>

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
                  <li class="active">
                      <a href="#"><i class="fa fa-check-circle-o"></i> Checklist </a>                    
                  </li>
                  <li>
                      <a><i class="fa fa-money"></i> Budgeter </a>
                  </li>
                  <li>
                      <a><i class="fa fa-user-plus"></i> Guest list </a>
                  </li>
                  <li>
                      <a><i class="fa fa-clock-o"></i> Wedding Day Timeline </a>
                  </li>
                  <li>
                      <a>
                        <i class="fa fa-gift"></i>
                        <span>Registry</span> 
                        <span class="label label-success pull-right">ComingSoon</span>
                      </a>
                  </li>
                  <li>
                      <a>
                        <i class="fa fa-desktop"></i> 
                        <span>Wedding Website</span> 
                        <span class="label label-success pull-right">ComingSoon</span>
                      </a>
                  </li>
                  <li>
                      <a>
                        <i class="fa fa-truck"></i> 
                        <span>Vendors</span>
                        <span class="label label-success pull-right">ComingSoon</span>
                      </a>
                  </li>                  
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
                    <li><a href="../settings/profile.php"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
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
          <div class="page-title">
            <div class="title_left">
              <div class="">
              <div class="">Show completed tasks</div>
                <label>
                  <input type="checkbox" class="js-switch" checked />
                </label>
              </div>
            </div>

            <div class="title_right">
                <div class="form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control search" placeholder="Search">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                    </span>
                  </div>
                </div>
              </div>
          </div>
          
          <!-- Add task -->
          <div>
            <button data-toggle="tooltip" data-placement="top" title="Add New Task" class="addTask btn btn-info"><i class="fa fa-plus"></i></button>
          </div>

          <div class="taskDetails">
            <button type="button" class="dismissIcon"><i class="fa fa-close"></i></span>
            </button>

            <label class="label col-md-6">
              <input  class="label__checkbox taskStatus" type="checkbox" />
              <span class="label__text">
                <span class="label__check">
                  <i class="fa fa-check icon"></i>
                </span>
              </span>
            </label>

            <button class="btn btn-danger removeTask"><i class="fa fa-trash"></i></button>

            <form method="post" class="form-horizontal form-label-left">
              <div class="form-group ">
                <label for="summary">Task</label>
                <input type="text" name="summary" id="summary" class="col-md-6 form-control">
              </div>
              <div class="form-group has-feedback">
                <label for="dueDate">Due date</label>
                <input type="text" name="dueDate" id="dueDate" class="form-control">
                <span class="fa fa-calendar form-control-feedback right changeDate" aria-hidden="true"></span>
              </div>
              <div class="form-group">
                <label for="taskNotes">Notes</label><br>
                <textarea name="taskNotes" id="taskNotes" class="form-control" placeholder="Your notes"></textarea>
              </div>

              <input type="submit" value="ADD NEW TASK" class="btn btn-success">

            </form>
          </div>
          <!-- /Add task -->

          <div class="checklist-wrapper ">
            <div class="row">
              <label class="col-md-12 col-xs-12 col-sm-12">JULY 2018</label>
            </div>
              <table class="checklist ">
                <tbody>
                  <tr>
                    <th class="row col-md-10" style="padding:8px 0 0 0;">
                      <label class="label col-md-1">
                        <input  class="label__checkbox taskStatus" type="checkbox" />
                        <span class="label__text">
                          <span class="label__check">
                            <i class="fa fa-check icon"></i>
                          </span>
                        </span>
                      </label>
                      <div class="col-md-11 task">
                        <span class="task-content">Check venues</span><br>
                        <small>Due <span class="due-date">July 8</span></small>
                        <span style="display: none" class="taskNotes">Make sure the Indian engraves it.</span>
                      </div>
                    </th>
                    <div class="col-md-2">
                      <td class="options edit"><i class="fa fa-pencil"></i></td>
                      <td class="options remove"><i class="fa fa-trash-o"></i></td>
                    </div>                                    
                  </tr>
                  <tr>
                    <th class="row col-md-10" style="padding:8px 0 0 0;">
                      <label class="label col-md-1">
                        <input  class="label__checkbox taskStatus" type="checkbox" />
                        <span class="label__text">
                          <span class="label__check">
                            <i class="fa fa-check icon"></i>
                          </span>
                        </span>
                      </label>
                      <div class="col-md-11 task">
                        <span class="task-content">Insure rings</span><br>
                        <small>Due <span class="due-date">July 8</span></small>
                        <span style="display: none" class="taskNotes">Make sure the Indian engraves it.</span>
                      </div>
                    </th>
                    <div class="col-md-2">
                      <td class="options edit"><i class="fa fa-pencil"></i></td>
                      <td class="options remove"><i class="fa fa-trash-o"></i></td>
                    </div>                                    
                  </tr>
                </tbody>
              </table>            
          </div>
        </div>
        <!-- /page content -->

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
    <!-- Switchery -->
    <script src="../../lib/gentella/vendors/switchery/dist/switchery.min.js"></script>
    
    <!-- Local javascript -->
    <script src="checklist.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="../../lib/gentella//build/js/custom.min.js"></script>
  </body>
</html>