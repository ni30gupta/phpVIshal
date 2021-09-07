<?php
$con = mysqli_connect('localhost', 'root', 'root', '28aug');
session_start();

if (isset($_POST['submit'])) {
     $username = mysqli_real_escape_string($con, $_POST['username']);
     $password = mysqli_real_escape_string($con, $_POST['password']);

     $res = mysqli_query($con, "select * from admin where username='$username' and password='$password'");

     if (mysqli_num_rows($res) > 0) {
          $row = mysqli_fetch_assoc($res);
          $_SESSION['CRUD_UNAME'] = $row['name'];
          $_SESSION['CRUD_UID'] = $row['id'];
          $_SESSION['CRUD_UROLE'] = $row['role'];
          $_SESSION['CRUD_LOGIN'] = true;
          header('location:index.php');
     } else {
          echo "Please Enter correct Details";
     }
}

?>

<h1>Login</h1>
<form method="post">
     <input type="text" autofocus name="username" placeholder="UserName">
     <input type="password" name="password" placeholder="Password">
     <input type="submit" name="submit">
</form>