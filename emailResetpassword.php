<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
        include ("connect.php");
        include ("guid.php");
        include ("expiry_time.php");

    
    $error = "";
    $alert="";
    if (isset($_POST["button"]) && $_POST["button"] == "send_email") {
        $email = mysqli_real_escape_string($link, $_POST["email"]);
      
        $reset_code = mysqli_real_escape_string($link, GUIDv4());
        $reset_expiry= mysqli_real_escape_string($link, expire());


        
        $query = "SELECT * FROM users WHERE email='".$email."' AND active='1'";
        $result = mysqli_query($link, $query);
        if (!mysqli_num_rows($result) > 0) {
            $error = "<p>Email address does not belong to any account</p>";
        }
        else {
            /* 
            ***************INSERTING THE reset_code AND reset_expiry into the databse**************
            ***************************************************************************************                            
            */
            $query= "UPDATE users SET reset_code='".$reset_code."',reset_expiry='".$reset_expiry."' 
            WHERE email='".$email."' AND active='1';";
            mysqli_query($link,$query) or die(mysqli_error($link));

            /* 
            ***************SENDING A PASSWORD RESET EMAIL TO USERS TO*****************************
            ***************************************************************************************                            
            */
            include ("sendemail.php");
            
            $mail-> setFrom("noreply@weddingwire.com", "Wedding Wire"); 

            $mail->addAddress($email);   
            $mail->Subject = "PASSWORD RESET";
            $mail->Body    = '
            You have requested a password reset for your Secret Diary account.
            Reset your password by clicking the url below.This link will be valid for 2 hours after which you will have to request
            for another password reset.    
            
                                        
            Please click this link to reset your account password:
            http://localhost/~steekam/wedding-planner/steekam-patch-1/password-reset.php?email='.$email.'&reset_code='.$reset_code.'';
            
                
            
            if(!$mail->send()) {
                $error = '<p>There seems to be a problem, please try again later</p>';                                
                
            } else {
                $alert="<p>A reset link for your account has been sent to your email address</p>";
            }

        }  

    }

?>

<?php include("header.php")?>

<body class="resetBody">
    
<div class="container" id="resetPasswordContainer">
    <form method = "post">
            <h3>A password reset link will be sent to your email address.</h3>

             <div id="error"><?php 
                if ($error) {
                    $error = '<div class="alert alert-danger container">'.$error.' </div>';
                    echo $error;
                }else if($alert){
                    $alert = '<div class="alert alert-success container">'.$alert.' </div>';
                    echo $alert;
                }

        ?></div>

            <div class="form-group input-group">
                <input class="form-control" type="email" name="email"  placeholder="Your Email" required>
                 <div class="input-group-append">
                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                </div> 
            </div>            
            
           <button class="btn btn-success" type="submit" name="button" value = "send_email">Submit</button>        

           
        </form>
</div>
</body>