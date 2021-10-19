<?php
include('smtp/PHPMailerAutoload.php');

function mailShoot($subject, $msg)
{
     $mail = new PHPMailer();
     $mail->isSMTP();
     $mail->SMTPAuth = true;
     $mail->SMTPSecure = 'tls';
     $mail->Host = 'smtp.gmail.com';
     $mail->Port = '587';
     $mail->isHTML(true);
     $mail->CharSet = 'UTF-8';
     $mail->Username = 'ledbulbrepair@gmail.com';
     $mail->Password = 'Ni30@1993tiri';
     $mail->setFrom('ledbulbrepair@gmail.com', 'Php Class');
     $mail->Subject = $subject;
     $mail->Body = $msg;
     $mail->addAddress("nguptani30@gmail.com");
     $mail->SMTPOptions = array('ssl' => array(
          'verify_peer' => false,
          'verify_peer_name' => false,
          'allow_self_signed' => false
     ));

     if (!$mail->Send()) {
          echo $mail->ErrorInfo;
     } else {
          echo "Mail Sent";
     }
}

mailShoot("Test3", "<h1 style = 'color='red'>is this big</h1>");
