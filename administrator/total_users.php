<?php

    session_start();

    if (!isset($_POST['valid'])) {
        header("Location: ../index.php");
    }

    require_once ('../connect.php');
    $user_id = mysqli_real_escape_string($link,$_SESSION['id']);

    if($_POST['valid']){
        $query = "SELECT * FROM users WHERE username != 'admin' ;";
        $result = mysqli_query($link, $query);
        $total_users = $result->num_rows;

        echo $total_users;
    }
?>