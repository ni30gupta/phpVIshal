<?php
include('db.php');
if (isset($_GET['activate_key'])) {
     $key = $_GET['activate_key'];
     $id = $_GET['user_id'];
     if ($key == $_SESSION['AUTH_TEMP_KEY']) {
          mysqli_query($con, "UPDATE users SET verified = '1' WHERE id =  '$id'");
     }
}
