<?php

    session_start();
    if (!isset($_POST['valid'])) {
        header("Location: index.php");
    }

    require_once ('../../connect.php');
    $user_id = mysqli_real_escape_string($link,$_SESSION['id']);
    $engagement = mysqli_real_escape_string($link,$_POST['engagementDate']);
    $wedding = mysqli_real_escape_string($link,$_POST['weddingDate']);
    $guests = mysqli_real_escape_string($link,$_POST['guests']);
    $budget = mysqli_real_escape_string($link,$_POST['budget']);
    
    if ($_POST['valid']) {
        $query_details = "UPDATE `account_details` SET 
                    proposal_date = '$engagement', wedding_date = '$wedding',
                    budget_range = '$budget', guest_range = '$guests'
                     WHERE user_id = '$user_id'; ";
        $result_details = mysqli_query($link,$query_details) OR die(mysqli_error($link));

        if ($result_details) {
            echo "Successful update";
        }else{
            echo "Error in update";
        }
    }
?>