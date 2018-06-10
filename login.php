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

    $password = ""; 
    $username = "";
    $error = "";
    $alert="";

	if (array_key_exists("button",$_POST) && isset($_POST["button"])) {
		$username = mysqli_real_escape_string($link, $_POST["username"]);
		$password = mysqli_real_escape_string($link, $_POST["password"]);

		$query = "SELECT `id`,`password`, `account_setup` FROM `users` WHERE username = '".$username."' AND active = '1';";
		$result = mysqli_query($link, $query);

		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_array($result);
					
			if  (password_verify($password, $row["password"])){

				if (isset($_POST["stay"])){
					setcookie("id",$row["id"], time() + (86400 * 30), "/" );
				}
				$_SESSION["id"] = $row["id"];
				//The first login to be directed to account setup
				if($row['account_setup']=="0"){
					$_SESSION['valid'] = "1";
					header("Location: account-setup.php");
				}else{
					header("Location: dashboard.php");
				}				
			}
			else {
				$error = "<p>You entered a wrong password.Try again!</p>";
			}
		}
		else{
			$error =  "<p>The username could not be found!</p>";
		}
	}
?>

<?php include('header.php')?>

<body id="login-page">
		
	<div class="row">
		<div id="title" style="height: 50px; padding: 12px; font-size: 80%; margin-top: 15px;">
			<a href="index.php">WEDDING WIRE</a>
		</div>				
		<button href="signup.html" id="btn-signUp" class=" mr-5 mybtn mybtn-primary">Sign Up</button>
	</div>

	<div class ="form-wrapper">
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

		<form method="post" id="login">
			<label for="username" class="hidden">Username</label>
			<input type = "text" name ="username" id = "username" placeholder ="Username" required>
			<label for="password" class="hidden">Password</label>
			<input type = "password" name ="password" id = "password" placeholder ="Password" required>
			<input type = "submit" name="button" class="mybtn mybtn-primary" value = "LOGIN">
		   	<div class="ml-5">
				<input class="form-check-input" type="checkbox" name="stay" value="yes"><p>Remember me</p>
			</div>
			<a href ="emailResetpassword.php" >Forgot your password?</a><br>			
		</form>		
	</div>


</body>
</html>