<?php


    $error = "";
    $alert = "";
    include ("connect.php");
    if (isset($_GET["email"]) AND isset($_GET["reset_code"])) {
        $email = mysqli_real_escape_string($link, $_GET["email"]);
        $reset_code= mysqli_real_escape_string($link, $_GET["reset_code"]);

        
        $query="SELECT * FROM users WHERE email='".$email."' AND reset_code='".$reset_code."';";
        $result = mysqli_query($link,$query); 
        $id = "";       
        
        
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
                $id = $row["id"];
                $reset_expiry= $row["reset_expiry"];

                $now = new DateTime();
                $now = $now->format('Y-m-d H:i:s');
                

                if ($now > $reset_expiry) {
                    $error = "<p>Your password reset link has expired.
                    <strong><a href='emailResetpassword'>Renew link</a></strong></p>";                    
                }
                else {
                    if (isset($_POST["button"]) AND $_POST["button"] == "reset_password") {

                        if ($_POST["password"] != $_POST["confirmpassword"]) {
                        $error = "<p>Passwords do not match</p>";
                        }

                        $password = mysqli_real_escape_string($link, $_POST["password"]);
                        $password_hash = password_hash($password, PASSWORD_BCRYPT);
                        
                        $query = "UPDATE users SET password='".$password_hash."' WHERE id='".$id."' AND active='1';";
                        if (mysqli_query($link, $query)) {
                            $alert = "<p>Password changed successfully. <strong><a href = 'login.php'>Log in</a></strong></p>";
                        }
                        else {
                            $error = "<p>There was an issue with the reset. Try again later.</p>";
                        }
                        
                    } 
                    
                }
            } else {
                $error = "<p>Invalid approach</p>";
                die($error);
            }
    }

?>
<?php include("header.php")?>

<body class="resetBody">

    <div class="container" id="resetPasswordContainer">
        <form method = "post">
                <h3>Type your new password</h3>

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
                    <input class="form-control password-field" type="password" name="password"  placeholder="Password" required>
                    
                </div>

                <div class="form-group input-group">
                    <input class="form-control password-field" type="password" name="confirmpassword"  placeholder="Confirm Password" required>
                    
                </div>            
                
            <button class="btn btn-success" type="submit" name="button" value = "reset_password">Submit</button>        

            
            </form>
    </div>
</body>