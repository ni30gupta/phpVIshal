<?php
include('function.php');
include('db.php');



$username = $_POST['username'];
$name = $_POST['name'];
$password = $_POST['password'];
$isRegister = false;
$query = "SELECT username from users";
$data = fetchData($query);
foreach ($data as $key => $value) {
     if ($value['username'] == $username) {
          $isRegister = true;
          $status = false;
          $msg = "Username Already Taken";
     }
}

if (!$isRegister) {
     $now = date('Y-m-d h:i:s');

     mysqli_query($con, "INSERT INTO users(name, username, password,inserted_on) VALUES('$name', '$username', '$password','$now')");
     $status = true;
     $msg = "Welcome";
     $id = mysqli_insert_id($con);
     $_SESSION['is_login'] = true;
     $_SESSION['UID'] = $id;
}

echo json_encode(['status' => $status, 'msg' => $msg]);
