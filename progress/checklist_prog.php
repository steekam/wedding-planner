<?php

    session_start();

    if (!isset($_POST['valid'])) {
        header("Location: ../../index.php");
    }

    require_once ('../connect.php');
    $user_id = mysqli_real_escape_string($link,$_SESSION['id']);

    if($_POST['valid']){
        $query ="SELECT * FROM checklist WHERE userId = '$user_id';";
        $all_result = mysqli_query($link, $query) OR die(mysqli_error($link));
        $all_count = $all_result->num_rows;

        $query2 = "SELECT * FROM checklist WHERE userId = '$user_id' AND completed = 'true';";
        $complete_result = mysqli_query($link, $query2) OR die(mysqli_error($link));
        $complete_count = $complete_result->num_rows;

        if($complete_count == 0){
            $complete_perc = 0;
        }else{
            $complete_perc = round(($complete_count/$all_count)*100);
        }        
        echo $complete_perc."%";
        
    }
?>