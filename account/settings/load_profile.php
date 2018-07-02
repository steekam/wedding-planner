<?php
    session_start();

    if (!isset($_POST['valid'])) {
        header("Location: ../../index.php");
    }

    require_once ('../../connect.php');
    $user_id = mysqli_real_escape_string($link,$_SESSION['id']);

    if($_POST['valid']){
        $query = "SELECT users.email, users.password, users.username, account_details.* FROM `users` INNER JOIN `account_details`
             ON users.id = account_details.user_id WHERE id = '$user_id';";

        $result = mysqli_query($link, $query) OR die(mysqli_error($link));

        $row = mysqli_fetch_assoc($result);
        
        //Store password for changes confirmation
        $_SESSION['pass'] = $row['password'];

        echo json_encode($row);
    }
?>