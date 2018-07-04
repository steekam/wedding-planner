<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
    session_start();

    if($_POST['valid']){
        require_once ('../../connect.php');

        $userId = mysqli_real_escape_string($link,$_SESSION['id']);
        $query = "SELECT * FROM budgets WHERE userId = '$userId';";
        $result  = mysqli_query($link,$query);
        $row = array();
        $query3 = "SELECT SUM(budget_details.amount_spent) AS used_budget , budget_details.userId, budgets.total_budget 
                    FROM budget_details
                        INNER JOIN
                    budgets ON budget_details.userId = budgets.userId WHERE budget_details.userId = '$userId'";

        if($result->num_rows == 0){
            $query2 = "INSERT INTO budgets (`userId`, `total_budget`, `rem_budget`, `used_budget`) VALUES ('$userId',0,0,0); ";
            if(mysqli_query($link,$query2)){
                $result  = mysqli_query($link,$query3);
                $row = mysqli_fetch_assoc($result);
            }
        }
        else{
            $result  = mysqli_query($link,$query3);
            $row = mysqli_fetch_assoc($result);
        }
        echo json_encode($row);
    }
?>