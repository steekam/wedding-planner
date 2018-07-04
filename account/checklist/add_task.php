<?php

    session_start();

    if (!isset($_POST['valid'])) {
        header("Location: index.php");
    }

    require_once ('../../connect.php');
    $user_id = mysqli_real_escape_string($link,$_SESSION['id']);

    if($_POST['valid']){
        $query ="INSERT INTO `checklist` (`taskContent`, `dueDate`, `taskNotes`, `completed`, `userId`)
         VALUES (?, ?, ?, ?, ?)";
         $stmt = mysqli_prepare($link,$query);
         $stmt->bind_param("ssssi", $taskContent, $dueDate, $taskNotes, $taskStatus, $userId);

         $taskContent = mysqli_real_escape_string($link,$_POST['summary']);
         $dueDate = mysqli_real_escape_string($link,$_POST['dueDate']);
         $taskNotes = mysqli_real_escape_string($link,$_POST['taskNotes']);
         $taskStatus = mysqli_real_escape_string($link,$_POST['taskStatus']);
         $userId = $user_id;

         if($stmt->execute()){
             echo "Success";
         }else{
             echo "Error";
         }

        
    }
?>