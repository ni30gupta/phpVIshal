<?php
$user = $_SESSION['CRUD_UNAME'];
echo "<h3>Welcome " . strtoupper($user) . "</h3>";
?>


<a href="index.php">Students</a> &nbsp;
<?php if ($_SESSION['CRUD_UROLE'] == 0) { ?>
     <a href="user.php">User</a> &nbsp;

<?php }; ?>
<a href="logout.php">Logout</a> &nbsp;