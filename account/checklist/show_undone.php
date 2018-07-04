<?php

    session_start();

    if (!isset($_POST['valid'])) {
        header("Location: ../../index.php");
    }

    require_once ('../../connect.php');
    $user_id = mysqli_real_escape_string($link,$_SESSION['id']);

    if($_POST['valid']){
        $query ="SELECT * FROM checklist WHERE userId = '$user_id' AND completed = 'false';";

        $result = mysqli_query($link, $query) OR die(mysqli_error($link));
        
        while($row = mysqli_fetch_assoc($result)){
            
            $task = 'task'.$row['taskId'];
            
            echo '<tr id="'.$task.'">
            <th class="row col-md-10">
                      <label class="label col-md-1">
                        <input  class="label__checkbox taskStatus" type="checkbox" completed="'.$row["completed"].'">
                        <span class="label__text">
                          <span class="label__check">
                            <i class="fa fa-check icon"></i>
                          </span>
                        </span>
                      </label>
                      <div class="col-md-11 task">
                        <span class="task-content">'.$row["taskContent"].'</span><br>
                        <small>Due <span class="due-date">'.$row["dueDate"].'</span></small>
                        <span class="taskNotes">'.$row["taskNotes"].'</span>
                      </div>
                    </th>
                      <td class="options edit"><i class="fa fa-pencil"></i></td>
                      <td class="options remove"><i class="fa fa-trash-o"></i></td>
            </tr>';
        }
        
        
    }
?>