<?php
include('function.php');
include('db.php');


foreach ($_POST as $key => $value) {
     foreach ($value as $k => $id) {
          mysqli_query($con, "UPDATE messages SET inbox_status = 'Inactive' WHERE id = '$id'");
     }
}
