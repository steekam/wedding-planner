<?php
    session_start();

    require_once ('../../connect.php');
    $user_id = $_SESSION['id'];

    if($_POST['valid']){
        $query = "UPDATE budget_details SET paid=? WHERE userId = ? AND expenseId = ?;";

        $stmt = mysqli_prepare($link,$query);
        $stmt->bind_param("sii", $expenseStatus, $userId, $expenseId);
        
        $expenseStatus = mysqli_real_escape_string($link,$_POST['expenseStatus']);
        $userId = $user_id;
        $expenseId = (int) filter_var($_POST['expensePaid'], FILTER_SANITIZE_NUMBER_INT);

        if($stmt->execute()){
            echo "Success";
        }else{
            echo "Error";
        }
    }
?>