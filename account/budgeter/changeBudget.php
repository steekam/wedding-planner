<?php
    session_start();

    if($_POST['valid']){
        require_once ('../../connect.php');

        $query = "UPDATE budgets SET total_budget = ? WHERE userId=?;";
        $stmt = mysqli_prepare($link,$query);
        $stmt->bind_param("ii",$newbudget,$userId);

        $newbudget = $_POST['newBudget'];
        $userId = $_SESSION['id'];

        if($stmt->execute()){
            echo "Success";
        }else{
            echo "Error";
        }
    }else{
        header("Location: ../../index.php");
    }
?>