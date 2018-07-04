<?php

    session_start();

    if($_POST['valid']){
        require_once ('../../connect.php');

        $query = "INSERT INTO `budget_details`(`expense`, `dueDate`, `amount_spent`, `vendor`, `vendor_contact`, `notes`,`userId`,`paid`) 
                VALUES(?,?,?,?,?,?,?,?);";
        $stmt = mysqli_prepare($link,$query);
        $stmt->bind_param("ssisssis",$expense,$dueDate,$amount_spent,$vendor,$vendor_contact,$notes,$userId,$paid);
        
        $expense = mysqli_real_escape_string($link,$_POST['summary']);
        $dueDate = mysqli_real_escape_string($link,$_POST['dueDate']);
        $amount_spent = mysqli_real_escape_string($link,$_POST['amount']);
        $vendor = mysqli_real_escape_string($link,$_POST['vendor']);
        $vendor_contact = mysqli_real_escape_string($link,$_POST['contact']);
        $notes = mysqli_real_escape_string($link,$_POST['expenseNotes']);
        $userId = mysqli_real_escape_string($link,$_SESSION['id']);
        $paid = mysqli_real_escape_string($link,$_POST['expenseStatus']);

        if($stmt->execute()){
             echo "Success";
         }else{
             echo "Error";
         }
    }
?>