<?php
$con = mysqli_connect('localhost', 'root', 'root', '28aug');
session_start();
if (!isset($_SESSION['CRUD_LOGIN'])) {
     header('location:login.php');
}

if ($_SESSION['CRUD_UROLE'] != 0) {
     header('location:index.php');
}

if (isset($_GET['id']) && $_GET['id'] > 0) {
     $id = $_GET['id'];
     if ($_GET['type'] === 'delete') {
          mysqli_query($con, "delete from admin where id= '$id'");
          header('location:index.php');
     }
     $res = mysqli_query($con, "select * from admin where id= '$id'");

     if (mysqli_num_rows($res) == 0) {
          header('location:index.php');
     } else {
          $row = mysqli_fetch_assoc($res);
          $name = $row['name'];
          $username = $row['username'];
          $password = $row['password'];
     }
} else {
     $id = "";
     $name = "";
     $username = "";
     $password = "";
}

if (isset($_POST['submit'])) {
     $name = $_POST['name'];
     $username = $_POST['username'];
     $password = $_POST['password'];
     var_dump($id);

     if ($id > 0) {
          mysqli_query($con, "UPDATE admin SET name='$name',username='$username',password='$password' WHERE id='$id'");
          header('location:index.php');
     } else {
          echo "Insert";
          mysqli_query($con, "INSERT INTO admin (name,username,password) values('$name','$usernmae','$password')");
          var_dump($id);

          header('location:index.php');
     }
}
include('top.php');


?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
</head>

<body>
     <br>
     <h3>
          <a href="index.php">Back </a> <br>

     </h3>
     <form id="frm" method="post">
          <input type="text" value="<?php echo $name; ?>" id="name" placeholder="Name" name="name"> <br><br>
          <input type="text" value="<?php echo $username; ?>" name="username" id="city" placeholder="Username"> <br><br>
          <input type="text" value="<?php echo $password; ?>" name="password" id="marks" placeholder="Password"><br><br>
          <input type="submit" name="submit">
     </form>
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script>
          // $('#frm').submit(function(e) {
          //      e.preventDefault()

          //      $.ajax({
          //           url: 'manage.php',
          //           type: 'post',
          //           data: $('#frm').serialize(),
          //           success: function() {
          //                // window.location.href = "index.php";

          //           }
          //      })
          // })
     </script>
</body>

</html>