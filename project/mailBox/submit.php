<?php
include('top.php');

if (isset($_POST['submit'])) {
     $username = $_POST['username'];
     $password = $_POST['password'];
}
$res = mysqli_query($con, "SELECT * from users WHERE username='$username'");

// $rows = mysqli_fetch_assoc($res);
while ($rows = mysqli_fetch_assoc($res)) {
     echo $rows['username'];
}
