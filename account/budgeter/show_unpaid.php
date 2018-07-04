<?php
  
    session_start();

    if($_POST['valid']){
        require_once ('../../connect.php');

        $userId = mysqli_real_escape_string($link,$_SESSION['id']);
        $query = "SELECT * FROM budget_details WHERE userId = '$userId' AND paid = 'true';";
        $result  = mysqli_query($link,$query);
        
        while($row = mysqli_fetch_assoc($result)){
            $expense = 'expense'.$row['expenseId'];

            echo '<tr id="'.$expense.'">
                    <td class="col-md-9 main">
                      <label class="label col-md-1" style="padding-left:0;">
                          <input  class="label__checkbox expenseStatus" type="checkbox" paid="'.$row["paid"].'">
                          <span class="label__text">
                            <span class="label__check">
                              <i class="fa fa-check icon"></i>
                            </span>
                          </span>
                      </label>
                      <div class="col-md-10 expense">
                       <span class="expense-content">'.$row['expense'].'</span><br>
                        <small class="bold">Due <span class="due-date">'.$row['dueDate'].'</span></span></small>
                        <span class="expenseNotes">'.$row['notes'].'</span>
                      </div>
                    </td>
                    <td class="hide vendor">'.$row['vendor'].'</td>
                    <td class="hide vendor_contact">'.$row['vendor_contact'].'</td>
                    <td class="amount" >'.$row['amount_spent'].'</td>
                    <td class="options">
                      <span><i class="edit fa fa-pencil"></i></span>
                      <span><i class="remove fa fa-trash-o"></i></span>
                    </td>
                  </tr>';
        }
    }
?>