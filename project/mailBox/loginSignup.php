<?php
include('top.php');
include('function.php');
$query = "select * from users";

echo "<h5 id='loginMsg' class='authMsg'></h5>";

if (isset($_POST['login'])) {
     $username  = $_POST['username'];
     $password  = $_POST['password'];
     $query = "SELECT * from users where username = '$username' and password = '$password'";
     $data = fetchData($query);
     if (isset($data[0])) {
          $_SESSION['is_login'] = true;
          $_SESSION['UID'] = $data[0]['id'];
          header('location:inbox.php');
     } else {
          echo "<script> document.querySelector('#loginMsg').innerHTML = 'Login Failed'</script>";
     }
}

?>

<h1>Login</h1>
<form id="frmLogin" method="post">
     <input type="text" name="username" autofocus placeholder="USERNAME"> <br> <br>
     <input type="password" name="password" placeholder="PASSWORD"> <br> <br>
     <input type="submit" name="login"> <br> <br>
</form>

<hr>
<h5 id="signupMsg" class="authMsg"></h5>
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
          $('#authMsg').html("")
          jQuery.ajax({
               url: 'manage.php',
               method: 'post',
               data: $('#frmRegister').serialize(),
               success: function(result) {
                    let res = $.parseJSON(result);
                    console.log(res)
                    if (res.status === true) {
                         window.location.href = "inbox.php";
                    } else {
                         $('#loginMsg').html(res.msg)
                    }
               }
          });
     });
</script>
<?php
include('footer.php');
?>