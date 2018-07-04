<?php
   ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    session_start();

    require_once ('../../connect.php');
    $user_id = mysqli_real_escape_string($link,$_SESSION['id']);

    if($_POST['valid']){
        $query = "UPDATE checklist SET 
        taskContent=?, dueDate=?, taskNotes=?, completed=? WHERE userId = ? AND taskId = ?;";

        $stmt = mysqli_prepare($link,$query);
        $stmt->bind_param("ssssii", $taskContent, $dueDate, $taskNotes, $taskStatus, $userId, $taskId);

        $taskContent = mysqli_real_escape_string($link,$_POST['summary']);
        $dueDate = mysqli_real_escape_string($link,$_POST['dueDate']);
        $taskNotes = mysqli_real_escape_string($link,$_POST['taskNotes']);
        $taskStatus = mysqli_real_escape_string($link,$_POST['taskStatus']);
        $userId = $user_id;
        $taskId = (int) filter_var(mysqli_real_escape_string($link,$_POST['task']), FILTER_SANITIZE_NUMBER_INT);

        if($stmt->execute()){
            echo "Success";
        }else{
            echo "Error";
        }
    }
?>