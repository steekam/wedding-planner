<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

    session_start();

    if (!isset($_POST['valid'])) {
        header("Location: ../index.php");
    }

    require_once ('../connect.php');
    $user_id = mysqli_real_escape_string($link,$_SESSION['id']);

    if($_POST['valid']){
        $query = "SELECT email FROM users WHERE username != 'admin' ;";
        $result = mysqli_query($link, $query);
        
        $emails = array();

        if($result->num_rows > 0){
            while($row = mysqli_fetch_assoc($result)){
                array_push($emails,$row['email']);
            }
        }
        echo json_encode($emails);

    }
?>