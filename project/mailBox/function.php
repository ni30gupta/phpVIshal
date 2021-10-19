<?php
include('smtp/PHPMailerAutoload.php');
$con = mysqli_connect("localhost", "root", "root", "mailbox");


function prx($data)
{
     echo "<pre>";
     print_r($data);
}
$fetchedData = [];

function fetchData($query)
{
     global $con;
     global $fetchedData;
     $res = mysqli_query($con, $query);
     while ($rows = mysqli_fetch_assoc($res)) {
          $fetchedData[] = $rows;
     }
     return $fetchedData;
}
$name = "test";
function getName($id)
{
     global $con;
     global $name;
     $res = mysqli_query($con, "SELECT name from users where id = '$id' ");

     while ($rows = mysqli_fetch_assoc($res)) {
          $name = $rows['name'];
     }
     return $name;
}



function mailShoot($subject, $msg, $email)
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
     $mail->setFrom('ledbulbrepair@gmail.com', 'Php_Class');
     $mail->Subject = $subject;
     $mail->Body = $msg;
     $mail->addAddress($email);
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
