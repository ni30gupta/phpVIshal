<?php
include('function.php');
// if (!$_SESSION['is_login']) {
//      header('location:loginSignup.php');
// }
$status = 'Error';
$msg = "Not Allowed";



if (isset($_POST['id']) && $_POST['id'] > 0 && $_POST['type']) {

     $id = $_POST['id'];

     if ($_POST['type'] == 'inbox') {
          mysqli_query($con, "UPDATE messages SET inbox_status = 'Inactive' WHERE id = '$id'");
          $status = 'Success';
          $msg = 'Message sent to Trash succesfully';
     } elseif ($_POST['type'] == 'sent') {
          mysqli_query($con, "UPDATE messages SET sent_status = 'Inactive' WHERE id = '$id'");
          $status = 'Success';
          $msg = 'Message sent to Trash succesfully';
     } elseif ($_POST['type'] == 'restore') {
          mysqli_query($con, "UPDATE messages SET sent_status = 'Active' WHERE id = '$id'");
          mysqli_query($con, "UPDATE messages SET inbox_status = 'Active' WHERE id = '$id'");
          $status = 'Success';
          $msg = 'Message restored succesfully';
     } elseif ($_POST['type'] == 'delete') {
          mysqli_query($con, "DELETE FROM messages WHERE id = '$id'");
          $status = 'Success';
          $msg = 'Message deleted succesfully';
     }
}

echo json_encode(['status' => $status, 'msg' => $msg]);
