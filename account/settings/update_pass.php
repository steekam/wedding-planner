<?php

    session_start();
    if (!isset($_POST['valid'])) {
        header("Location: index.php");
    }

    require_once ('../../connect.php');
    $user_id = mysqli_real_escape_string($link,$_SESSION['id']);
    $newPassword = mysqli_real_escape_string($link,$_POST['newPassword']);
    $currentPassword = mysqli_real_escape_string($link,$_POST['currentPassword']);
    

    //Ensure passwords match
    $doMatch = password_verify($currentPassword,$_SESSION['pass']);
    if($doMatch){
        $hash = password_hash($newPassword,PASSWORD_BCRYPT);
        $query = "UPDATE users SET password = '$hash' WHERE id = '$user_id';";
        $result = mysqli_query($link,$query);
        if($result){
            echo "Successful password update";
        }else{
            echo "Error in password update";
        }
    }else{
        echo "Entered wrong password";
    }
?>