<?php
include('top.php');
include('function.php');
if (!$_SESSION['is_login']) {
     header('location:loginSignup.php');
}
$status = 'Error';
$msg = "Not Allowed";

if (isset($_POST['id']) && $_POST['id'] > 0) {
     $id = $_POST['id'];
     mysqli_query($con, "UPDATE messages SET status = 'Inactive' WHERE id = '$id'");

     $status = 'Success';
     $msg = 'Message sent to Trash succesfully';
}

echo json_encode(['status' => $status, 'msg' => $msg]);
