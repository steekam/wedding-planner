<?php
    session_start();

    require_once ('../../connect.php');
    $user_id = mysqli_real_escape_string($link,$_SESSION['id']);

    if($_POST['valid']){
        $query = "UPDATE checklist SET completed=? WHERE userId = ? AND taskId = ?;";

        $stmt = mysqli_prepare($link,$query);
        $stmt->bind_param("sii", $taskStatus, $userId, $taskId);
        
        $taskStatus = mysqli_real_escape_string($link,$_POST['taskStatus']);
        $userId = $user_id;
        $taskId = (int) filter_var(mysqli_real_escape_string($link,$_POST['taskDone']), FILTER_SANITIZE_NUMBER_INT);

        if($stmt->execute()){
            echo "Success";
        }else{
            echo "Error";
        }
    }
?>