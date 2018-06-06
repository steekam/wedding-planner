<?php
    require 'PHPMailer/PHPMailerAutoload.php';
    $mail = new PHPMailer;
    $mail->isSMTP();                            // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                     // Enable SMTP authentication
    $mail->Username = 'stepwany8@gmail.com';   // SMTP username
    $mail->Password = 'REStaTiOnsCuSeB';        // SMTP password
    $mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                          // TCP port to connect to
?>