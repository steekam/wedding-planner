<?php

    session_start();
    if (!isset($_POST['valid'])) {
        header("Location: index.php");
    }

    require_once ('../../connect.php');
    $user_id = mysqli_real_escape_string($link,$_SESSION['id']);
    $newEmail = mysqli_real_escape_string($link,$_POST['newEmail']);
    $password = mysqli_real_escape_string($link,$_POST['password']);

    //Ensure passwords match
    $doMatch = password_verify($password,$_SESSION['pass']);
    if($doMatch){
        $query = "UPDATE users SET email = '$newEmail' WHERE id = '$user_id';";
        $result = mysqli_query($link,$query);
        if($result){
            echo "Successful email update";
        }else{
            echo "Error in email update";
        }
    }else{
        echo "Entered wrong password";
    }
?>