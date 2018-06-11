<?php
   
    $alert = "";
    $error = "";

   if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
        // Verify data
        include ("connect.php");
        $email = mysqli_real_escape_string($link, $_GET["email"]);
        $password_hash = mysqli_real_escape_string($link, $_GET["hash"]);
        
        $query = "SELECT * FROM users WHERE email = '".$email."' AND password = '".$password_hash."' AND active='0';";
        $result = mysqli_query($link,$query) ;
        $match = mysqli_num_rows($result);

        if($match > 0){
            // We have a match, activate the account
            mysqli_query($link,"UPDATE users SET active='1' WHERE email='".$email."' AND password='".$password_hash."' AND active='0'") or die(mysqli_error($link));
            
            $alert = '<div class="alert alert-success"><p>Successful activation  <strong><a href="login.php?button=login">Log in</a></strong></p></p></div>';
            
        }else{
            // No match -> invalid url or account has already been activated.
            $error =  '<div class="alert alert-danger"><p>The url is invalid or you have already ativated your account.</p></div>';
        }
        
    }else{
        // Invalid approach

        $error =  '<div class="alert alert-danger"><p>Invalid approach, please use the link that has been send to your email.</p></div>';
        
        
    }

    
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Email Verified</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    
  
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
     
    <style type="text/css">
        .container {
            margin: 100px auto;
            width: 50%;
            height:400px;
            background-color: #cfdef7;
            border-radius: 20px;
        }
        #message {
            padding-top:100px;
        }
        .alert {
            text-align: center;
        }
    </style>
    
</head>
<body>
    
    <div class="container">
        <div id="message">
            <?php
            if($error){
                echo $error;
            }
            else {
                echo $alert;
            }
        ?>
        </div>    
        
    </div>
    
</body>
</html>
    
