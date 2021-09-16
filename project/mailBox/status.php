<?php
include('top.php');
if (!$_SESSION['user_id']) {
     header('location:loginSignup.php');
}

$id = $_GET['id'];

mysqli_query($con, "UPDATE messages set status='inactive' where id = '$id'");
