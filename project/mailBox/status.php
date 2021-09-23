<?php
include('top.php');
if (!$_SESSION['is_login']) {
     header('location:loginSignup.php');
}
if ($_GET['del_id']) {
     $id = $_GET['del_id'];
     $qry = mysqli_query($con, "UPDATE messages set status='active' where id = '$id'");
}
if ($_GET['id']) {

     $id = $_GET['id'];

     $qry = mysqli_query($con, "UPDATE messages set status='inactive' where id = '$id'");
}

?>
<script>
     window.history.back();
</script>