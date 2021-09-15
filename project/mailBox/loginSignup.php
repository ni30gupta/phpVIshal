<?php
include('top.php');
if (isset($_POST['login'])) {
     $username = $_POST['username'];
     $password = $_POST['password'];

     $res = mysqli_query($con, "SELECT * from users WHERE username='$username' and password='$password' ");
     if (mysqli_num_rows($res) > 0) {
          header('location:dashboard.php');
     }
}

if (isset($_POST['signup'])) {
     $username = $_POST['username'];
     $password = $_POST['password'];
     $name = $_POST['name'];

     $res = mysqli_query($con, "SELECT * from users WHERE username='$username' ");
     $time = time();
     if (mysqli_num_rows($res) == 0) {
          $res = mysqli_query($con, "INSERT INTO users(name,username, password, inserted_on) values('$name', '$username', '$password', '$time') ");
     } else {
          echo "UserName Already taken";
     }
}
?>
<h1>Login</h1>
<form method="post">
     <input type="text" name="username" autofocus placeholder="USERNAME"> <br> <br>
     <input type="password" name="password" placeholder="PASSWORD"> <br> <br>
     <input type="submit" name="login"> <br> <br>
</form>

<hr>
<h1>SignUp</h1>
<form method="post">
     <input required type="text" name="name" placeholder="ENTER NAME"> <br> <br>
     <input required type="text" name="username" placeholder="USERNAME"> <br> <br>
     <input required type="password" name="password" placeholder="PASSWORD"> <br> <br>
     <input type="submit" name="signup"> <br> <br>
</form>


<?php
include('footer.php');
?>