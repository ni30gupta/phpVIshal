<?php
$con = mysqli_connect('localhost', 'root', '', 'mailbox');
$res = mysqli_query($con, "SELECT * FROM message WHERE id='1'");
echo "<pre>";
print_r($res);
if (isset($_POST)) {
     echo "<pre>";
     print_r($_POST);
}
