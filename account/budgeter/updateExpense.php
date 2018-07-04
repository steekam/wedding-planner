<?php
    session_start();

    if($_POST['valid']){
        require_once ('../../connect.php');

        $query = "UPDATE budget_details SET
        expense=?, dueDate=?, amount_spent=?, vendor=?, vendor_contact=?, notes=?,  paid=? WHERE userId=? AND expenseId=?;";
        $stmt = mysqli_prepare($link,$query);
        $stmt->bind_param("ssisissii",$expense,$dueDate,$amount_spent,$vendor,$vendor_contact,$notes,$paid,$userId,$expenseId);
        
        $expense = mysqli_real_escape_string($link,$_POST['summary']);
        $dueDate = mysqli_real_escape_string($link,$_POST['dueDate']);
        $amount_spent = mysqli_real_escape_string($link,$_POST['amount']);
        $vendor = mysqli_real_escape_string($link,$_POST['vendor']);
        $vendor_contact = mysqli_real_escape_string($link,$_POST['contact']);
        $notes = mysqli_real_escape_string($link,$_POST['expenseNotes']);
        $paid = mysqli_real_escape_string($link,$_POST['expenseStatus']);
        $userId = mysqli_real_escape_string($link,$_SESSION['id']);
        $expenseId = (int) filter_var(mysqli_real_escape_string($link,$_POST['expenseId']), FILTER_SANITIZE_NUMBER_INT);

        if($stmt->execute()){
             echo "Success";
         }else{
             echo "Error";
         }
    }
?>