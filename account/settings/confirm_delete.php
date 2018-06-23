<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    session_start();
    if (!isset($_POST['valid'])) {
        header("Location: index.php");
    }

    require_once ('../../connect.php');
    $user_id = mysqli_real_escape_string($link,$_SESSION['id']);    

    if($_POST['valid']){
        $query = "DELETE  users, account_details FROM account_details INNER JOIN users ON account_details.user_id = users.id  WHERE account_details.user_id = '$user_id';";
        $result = mysqli_query($link,$query) OR die(mysqli_error($link));
        if($result){
            echo "Successful query";
            session_destroy();
            setcookie("id","", time() - (86400 * 30), "/" );
            $_COOKIE["id"] = "";
        }else{
            echo "Error in  update";
        }
    }
?>