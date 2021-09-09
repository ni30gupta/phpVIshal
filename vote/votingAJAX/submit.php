<?php
$con = mysqli_connect('localhost', 'root', '', '28aug');

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
     $qry = mysqli_query($con, "SELECT * FROM vote WHERE id = '$id'");
     $countFromDB = mysqli_fetch_assoc($qry);
     $count = $countFromDB[$type . "_count"];
}

$result = array('status' => $status, 'msg' => $msg, 'vote' => $count);

echo json_encode($result);
