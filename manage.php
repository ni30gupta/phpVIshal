<?php
$con = mysqli_connect('localhost', 'root', 'root', '28aug');
session_start();
if (!isset($_SESSION['CRUD_LOGIN'])) {
     header('location:login.php');
}

$subQuery = "";
if ($_SESSION['CRUD_UROLE'] != 0) {
     $subQuery = "and added_by = '" . $_SESSION['CRUD_UID'] . "'";
}

if (isset($_GET['id']) && $_GET['id'] > 0) {
     $id = $_GET['id'];
     if ($_GET['type'] === 'delete') {
          mysqli_query($con, "delete from students where id= '$id'");
          header('location:index.php');
     }
     $res = mysqli_query($con, "select * from students where id= '$id' $subQuery");

     if (mysqli_num_rows($res) == 0) {
          header('location:index.php');
     } else {
          $row = mysqli_fetch_assoc($res);
          $name = $row['name'];
          $city = $row['city'];
          $marks = $row['marks'];
     }
} else {
     $id = "";
     $name = "";
     $city = "";
     $marks = "";
}

if (isset($_POST['submit'])) {
     $name = $_POST['name'];
     $city = $_POST['city'];
     $marks = $_POST['marks'];
     var_dump($id);

     if ($id > 0) {
          mysqli_query($con, "UPDATE students SET name='$name',city='$city',marks='$marks' WHERE id='$id'");
          header('location:index.php');
     } else {
          $user = $_SESSION['CRUD_UID'];
          mysqli_query($con, "INSERT INTO students (name,city,marks,added_by) values('$name','$city','$marks','$user')");
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
          <input type="text" value="<?php echo $city; ?>" name="city" id="city" placeholder="City"> <br><br>
          <input type="number" value="<?php echo $marks; ?>" name="marks" id="marks" placeholder="Marks"><br><br>
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