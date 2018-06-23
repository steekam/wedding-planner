<?php
session_start();


    /* Ensuring cookies and sessions are destroyed once user logs out */

    if (array_key_exists("logout",$_GET)) { 
        
         $helper = array_keys($_SESSION);
        foreach ($helper as $key){
            unset($_SESSION[$key]);
        }               
        setcookie("id","", time() - (86400 * 30), "/" );
        $_COOKIE["id"] = "";            
              
    }
    else if ( array_key_exists("id", $_SESSION) || (array_key_exists("id",$_COOKIE) AND $_COOKIE ) ) {
        header("Location: dashboard.php");
    }

    include("connect.php");

    $email = "";
    $password = ""; 
    $username = "";
    $error = "";
    $alert="";

    if (array_key_exists("button",$_POST) && isset($_POST["button"])) {
            
        $email = mysqli_real_escape_string($link, $_POST["email"]);
        $username = mysqli_real_escape_string($link, $_POST["username"]);
        $password = mysqli_real_escape_string($link, $_POST["password"]);
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        if ($_POST["password"] != $_POST["confirm-password"]) {
            $error = "<p>Passwords do not match</p>";
        }

        $query = "SELECT `id` FROM `users` WHERE email = '".$email."';";
        $result = mysqli_query($link, $query);
        $query2 = "SELECT `id` FROM `users` WHERE username = '".$username."';";
        $result2 = mysqli_query($link, $query2);

        if (mysqli_num_rows($result) > 0) {
            $error = "<p>The email address has already been registered</p>";
        }else if (mysqli_num_rows($result2) > 0) {
            $error = "<p>The username entered is unavailable</p>";
        }
        else{
            $query = "INSERT INTO `users` (`email`,`password`,`username`) VALUES ('".$email."','".$password_hash."','".$username."');";
            if(mysqli_query($link, $query)){              
                
                
                /* 
                ***************SENDING A VERIFICATION EMAIL TO USERS TO ACTIVATE ACCOUNT*****************************
                *****************************************************************************************************                            
                */
                include ("sendemail.php");
                
                $mail-> setFrom("noreply@weddingwire.com", "WEDDING WIRE"); 

                $mail->addAddress($email);   
                $mail->Subject = "ACCOUNT ACTIVATION";
                $mail->Body    = '
                Thanks for signing up!
                Your account has been created, you can login with your credentials after you have activated your account 
                by following the url below.
                
                                            
                Please click this link to activate your account:
                http://localhost/~steekam/wedding-planner/steekam-patch-1/verifyemail.php?email='.$email.'&hash='.$password_hash.'';
                
                    
                
                if(!$mail->send()) {
                    $error = '<p>Verifiation email could not be sent Try again later</p>';                                
                    
                } else {
                    
                    $alert="<p>An activation link for your account has been sent to your email address for verifiation.<br>You won't be able to login without the activation</p>";
                }                
            }
            else{
                $error = "<p>There was a problem with the sign up.Please try again later!</p>";
            }
        }
        
    }

?>

<?php include('header.php')?>

<body id="signup-page">
    <div class="row">
		<div id="title" style="height: 50px; padding: 12px; font-size: 80%; margin-top: 15px;">        
            <a href="index.php">WEDDING WIRE</a>
        </div>
        <button id="btn-login" class="mr-5 mybtn mybtn-primary">Login</button>
    </div>
    
    <div class="form-wrapper">
        <img src="assets/image/logo.png" class="logo">

        <div id="error">
            <?php 
                if ($error) {
                    $error = '<div class="alert alert-danger alert-dismissible container">'.$error.'<button type="button" class="close" data-dismiss="alert" >
                        <span>&times;</span></button> </div>';
                    echo $error;
                }else if($alert){
                    $alert = '<div class="alert alert-success alert-dismissible container">'.$alert.'<button type="button" class="close" data-dismiss="alert">
                        <span>&times;</span></button> </div>';
                    echo $alert;
                }
            ?>
        </div>

        <form method="post" id="signup">
            <label for="username-sign" class="hidden">Username</label>
            <input type="text" name="username" id="username-sign" placeholder="Username" required>
            <label for="email" class="hidden">Email</label>
            <input type="email" name="email" id="email" placeholder="Email" required>
            <label for="password-sign" class="hidden">Password</label>
            <input type="password" name="password" id="password-sign" placeholder="Password" required>
            <label for="confirm-password" class="hidden">Confirm Password</label>
            <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirm password" required>
            <input type="submit" name="button" class="mybtn mybtn-primary" id="signup-submit" value="SIGN UP">
        </form>
    </div>
</body>
</html>