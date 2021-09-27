<?php
include('function.php');
// if (!$_SESSION['is_login']) {
//      header('location:loginSignup.php');
// }
$status = 'Error';
$msg = "Not Allowed";



if (isset($_POST['id']) && $_POST['id'] > 0 && $_POST['type']) {

     $id = $_POST['id'];

     if ($_POST['type'] == 'delete') {
          mysqli_query($con, "DELETE  message FROM messages WHERE id = '$id'");
     } elseif ($_POST['type'] == 'restore') {
          mysqli_query($con, "UPDATE messages SET status = 'Active' WHERE id = '$id'");
     }
     mysqli_query($con, "UPDATE messages SET status = 'Inactive' WHERE id = '$id'");

     $status = 'Success';
     $msg = 'Message sent to Trash succesfully';
}

echo json_encode(['status' => $status, 'msg' => $msg]);
