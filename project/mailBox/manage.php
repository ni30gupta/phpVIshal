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

     mysqli_query($con, "INSERT INTO users(name, username, password,inserted_on,verified) VALUES('$name', '$username', '$password','$now','0')");
     $status = true;
     $msg = "Welcome";
     $id = mysqli_insert_id($con);
     $_SESSION['is_login'] = true;
     $_SESSION['UID'] = $id;
     $activate_key = rand(1000, 9999);
     $_SESSION['AUTH_TEMP_KEY'] = $activate_key;

     $link = "http://localhost:8012/phpVishal/mysql/day2/project/mailBox/activateAccount.php?activate_key=$activate_key&user_id=$id";
     $msg = "Thank You <br/> Please click the link to verify the account " . $link;

     mailShoot("Register", $msg, $username);
}

echo json_encode(['status' => $status, 'msg' => $msg]);
