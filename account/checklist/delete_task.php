<?php
  
    session_start();
    require_once ('../../connect.php');
    $user_id = mysqli_real_escape_string($link,$_SESSION['id']);

    if($_POST['valid']){
        $query = "DELETE FROM `checklist` WHERE `checklist`.`taskId` = ? AND `checklist`.`userId` = ?;";

        $stmt = mysqli_prepare($link,$query);
        $stmt->bind_param("ii",$taskId, $userId);

        $userId = $user_id;
        $taskId = (int) filter_var(mysqli_real_escape_string($link,$_POST['task']), FILTER_SANITIZE_NUMBER_INT);

        if($stmt->execute()){
            echo "Success";
        }else{
            echo "Error";
        }
    }
?>