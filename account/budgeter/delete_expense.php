<?php
    session_start();
    require_once ('../../connect.php');
    $user_id = $_SESSION['id'];

    if($_POST['valid']){
        $query = "DELETE FROM `budget_details` WHERE `budget_details`.`expenseId` = ? AND `budget_details`.`userId` = ?;";

        $stmt = mysqli_prepare($link,$query);
        $stmt->bind_param("ii",$expenseId, $userId);

        $userId = $user_id;
        $expenseId = (int) filter_var(mysqli_real_escape_string($link,$_POST['expense']), FILTER_SANITIZE_NUMBER_INT);

        if($stmt->execute()){
            echo "Success";
        }else{
            echo "Error";
        }
    }
?>