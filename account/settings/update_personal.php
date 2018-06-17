<?php
    session_start();
    if (!isset($_POST['valid'])) {
        header("Location: index.php");
    }

    require_once ('../../connect.php');
    $user_id = mysqli_real_escape_string($link,$_SESSION['id']);
    $username = mysqli_real_escape_string($link,$_POST['username']);
    $ufirst_name = mysqli_real_escape_string($link,$_POST['ufirst_name']);
    $ulast_name = mysqli_real_escape_string($link,$_POST['ulast_name']);
    $pfirst_name = mysqli_real_escape_string($link,$_POST['pfirst_name']);
    $plast_name = mysqli_real_escape_string($link,$_POST['plast_name']);
    $urole = mysqli_real_escape_string($link,$_POST['urole']);
    $prole = mysqli_real_escape_string($link,$_POST['prole']);

    if ($_POST['valid']) {
        $query = "UPDATE `users` SET username = '$username' WHERE id = '$user_id'; ";
        $result = mysqli_query($link,$query) OR die(mysqli_error($link));
        $query_details = "UPDATE `account_details` SET 
                    first_name = '$ufirst_name', last_name = '$ulast_name',
                    partner_firstname = '$pfirst_name', partner_lastname = '$plast_name',
                    user_role = '$urole', partner_role = '$prole'
                     WHERE user_id = '$user_id'; ";
        $result_details = mysqli_query($link,$query_details) OR die(mysqli_error($link));

        if ($result AND $result_details) {
            echo "Successful update";
        }else{
            echo "Error in update";
        }
    }
?>