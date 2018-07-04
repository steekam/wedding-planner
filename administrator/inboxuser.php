<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
    session_start();

    if (!isset($_POST['send'])) {
        header("Location: ../index.php");
        exit();
    }

    require_once ("../sendemail.php");
                
                $mail-> setFrom("noreply@weddingwire.com", "WEDDING WIRE"); 

                $mail->addAddress($_POST['sendTo']);   
                $mail->Subject = $_POST['subject'];
                $mail->Body    = $_POST['message'];

                if(!$mail->send()) {
                    $error = '<p>Message could not be sent</p>'; 
                    echo $error;                               
                    
                } else {
                    $alert="<p>Message sent</p>";
                    echo $alert;
                }    
?>