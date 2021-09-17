<?php
include('top.php');
include('function.php');
$query = "select * from users";

prx(fetchData($query));




// if (isset($_POST['login'])) {
//      $username = $_POST['username'];
//      $password = $_POST['password'];

//      $res = mysqli_query($con, "SELECT * from users WHERE username='$username' and password='$password' ");
//      if (mysqli_num_rows($res) > 0) {
//           $data = mysqli_fetch_assoc($res);
//           $_SESSION['username'] = $username;
//           $_SESSION['user_id'] = $data['id'];

//           header('location:inbox.php');
//      }
// }

// if (isset($_POST['signup'])) {
//      $username = $_POST['username'];
//      $password = $_POST['password'];
//      $name = $_POST['name'];

//      $res = mysqli_query($con, "SELECT * from users WHERE username='$username' ");
//      $time = time();
//      if (mysqli_num_rows($res) == 0) {
//           $res = mysqli_query($con, "INSERT INTO users(name,username, password, inserted_on) values('$name', '$username', '$password', '$time') ");
//      } else {
//           echo "UserName Already taken";
//      }
// }
?>
<h1>Login</h1>
<form id="frmLogin" method="post">
     <input type="text" name="username" autofocus placeholder="USERNAME"> <br> <br>
     <input type="password" name="password" placeholder="PASSWORD"> <br> <br>
     <input type="submit" name="login"> <br> <br>
</form>

<hr>
<h1>SignUp</h1>
<form id="frmRegister" method="post">
     <input required type="text" name="name" placeholder="ENTER NAME"> <br> <br>
     <input required type="text" name="username" placeholder="USERNAME"> <br> <br>
     <input required type="password" name="password" placeholder="PASSWORD"> <br> <br>
     <input type="submit" name="signup"> <br> <br>
</form>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
     $('#frmRegister').submit(function(e) {
          e.preventDefault();
          jQuery.ajax({
               url: 'manage.php',
               method: 'post',
               data: $('#frmRegister').serialize(),
               success: function(result) {
                    console.log(result)
               }
          });
     });
</script>
<?php
include('footer.php');
?>