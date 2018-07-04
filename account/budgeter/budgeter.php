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

    <title>WEDDING WIRE | BUDGETER </title>
    <link rel="icon" type="image/ico" href="../../favicon.ico">    

    <!-- Bootstrap -->
    <link href="../../lib/gentella/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../lib/gentella/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../../lib/gentella/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="../../lib/gentella/vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- Datatables -->
    
    

    <!-- Custom Theme Style -->
    <link href="../../lib/gentella/build/css/custom.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/budgeter.css"> 
    <link rel="stylesheet" href="../../css/responsive.css">
    <link rel="stylesheet" href="../../css/animate.css">
    
  </head>

  <body class="nav-md">
      <div class="overlay"></div>
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col" id="side_menu">
          <div class="left_col scroll-view">
            <br>

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
                  <li class="active">
                      <a href="#"><i class="fa fa-money"></i> Budgeter </a>
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
                    <li><a href="../settings/profile.php"> Profile</a></li>
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
            <!-- Page title -->
            
            <div class="row topTitle">
              <div class="col-md-6" id="intro-text">
                <h1>Welcome to your budgeter</h1>
                <p>Keep track of your spending and stay on budget</p>
                <p>
                  <small>Total budget:</small> KSH <b><span id="budget"></span> <i class="editBudget glyphicon glyphicon-pencil"></i></b>
                </p>
                <p style="font-size: 12px;">
                  <small>Total remaining:</small> KSH <b id="budget_rem"></b>
                </p>
                <div class="col-md-4 updateBudget">
                  <form method="post" id="updateBudget">
                    <div class="form-group">
                      <input type="number" class="form-control" name="newBudget" id="newBudget" placeholder="New budget" required>
                    </div>
                    <div class="form-group">
                      <button type="button" id="cancelEdit" class="btn btn-danger"><i class="fa fa-times"></i></button>
                      <button type="button" id="confirmEdit" class="btn btn-success"><i class="fa fa-check"></i></button>
                    </div>
                  </form>
                </div>
              </div>
              
              <div class="col-md-6 wrapIcons">
                <div class="topIcon" id="coins">
                  <img src="../../assets/image/icons/coins.png" alt="">
                </div>
                <div class="topIcon" id="piggyBank">
                  <img src="../../assets/image/icons/piggy-bank.png" alt="">
                </div>
              </div>
            </div>
            <!-- /Page title -->

            <!-- budget table -->
            <div class="budgeter-wrapper row">
              <div class="row">
                <!-- <div class="col-md-6" style="padding-top: 24px;">
                  <div class="">Show completed payments</div>
                  <label>
                    <input type="checkbox" class="js-switch" id="paidToggle" checked />
                  </label>
                </div> -->

                <div class="col-md-6 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control search" placeholder="Search">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                    </span>
                  </div>
                </div>
              </div>
              <table class="budgeter table col-md-12 col-xs-12">
                <thead>
                  <th>Expense</th>
                  <th>amount spent</th>
                </thead>
                <tbody>
                  
                </tbody>
              </table>
            </div>            
            <!-- /budget table -->

            <!-- Add new expense -->
            <div>
              <button data-toggle="tooltip" data-placement="top" title="Add New Expense" class="addExpense btn btn-info"><i class="fa fa-plus"></i></button>
            </div>

            <div class="expenseDetails">
              <button type="button" class="dismissIcon"><i class="fa fa-close"></i></span></button>
              
              <form method="post" class="form-horizontal form-label-left">
                <div style="display:flex">
                  <label class="label">
                    <input  class="label__checkbox expenseStatus" type="checkbox" />
                    <span class="label__text">
                      <span class="label__check">
                        <i class="fa fa-check icon"></i>
                      </span>
                    </span>
                  </label>

                  <div class="">
                    <button class="btn btn-danger removeExpense"><i class="fa fa-trash"></i></button>
                  </div>
                </div>
                  <div class="form-group ">
                    <!-- Hidden field to store expenseId -->
                    <input type="text" name="expenseId" id="expenseId">

                    <label for="summary">Expense</label>
                    <input type="text" name="summary" id="summary" class="col-md-6 form-control" required>
                  </div>
                  <div class="form-group has-feedback">
                    <label for="dueDate">Due date</label>
                    <input type="text" name="dueDate" id="dueDate" class="form-control" autocomplete="off" required>
                    <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
                  </div>
                  <div class="form-group has-feedback">
                    <label for="amount_spent">AMOUNT SPENT</label>
                    <input type="number" name="amount" id="amount_spent" class="form-control" required>
                    <span class="fa fa-money form-control-feedback right" aria-hidden="true"></span>
                  </div>
                  <div class="form-group has-feedback">
                    <label for="vendor">Vendor</label>
                    <input type="text" name="vendor" id="vendor" class="form-control" required>
                    <span class="fa fa-truck form-control-feedback right" aria-hidden="true"></span>
                  </div>
                  <div class="form-group has-feedback">
                    <label for="contact">Vendor Contact</label>
                    <input type="number" name="contact" id="contact" class="form-control" required>
                    <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                  </div>
                  
                  <div class="form-group">
                    <label for="expenseNotes">Notes</label><br>
                    <textarea name="expenseNotes" id="expenseNotes" class="form-control" placeholder="Your notes"></textarea>
                  </div>

                  <div>
                    <input type="button" value="Add New Expense" id="addExpense" class="btn btn-success">
                    <input type="button" value="Update Expense" id="updateExpense" class="btn btn-success">
                  </div>              

              </form>
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
    <script src="budgeter.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="../../lib/gentella//build/js/custom.min.js"></script>
  </body>
</html>