<?php
$con = mysqli_connect('localhost', 'root', 'root', '28aug');

$msg = "";
$count = "";
if (isset($_POST['id']) && isset($_POST['type'])) {
     $id = $_POST['id'];
     $type = $_POST['type'];
}


if (isset($_COOKIE["voted$id"])) {
     $msg = "Already Voted";
     $status = "fail";
} else {
     $field = $type . "_count";
     mysqli_query($con, "UPDATE vote SET $field = $field+1 WHERE id = '$id'");
     setcookie("voted$id", true, time() + 8);
     $msg = "Thank you";
     $status = "success";
}

$result = array('status' => $status, 'msg' => $msg);

echo json_encode($result);
