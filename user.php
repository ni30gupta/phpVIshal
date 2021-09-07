<?php
$con = mysqli_connect('localhost', 'root', 'root', '28aug');

session_start();
if (!isset($_SESSION['CRUD_LOGIN'])) {
     header('location:login.php');
}
if ($_SESSION['CRUD_UROLE'] != 0) {
     header('location:index.php');
}
$sql = "SELECT * FROM admin where role = '1'";

$res = mysqli_query($con, $sql);
// print_r($res);
include('top.php');
?>

<h1>Student Table</h1>

<h3>
     <a href="manage_user.php">Add Data</a> &nbsp;
</h3>

<table border="1px solid black">
     <thead>
          <tr>
               <th>Id</th>
               <th>Name</th>
               <th>Username</th>
               <th>Password</th>
               <th>Manage</th>
          </tr>
     </thead>
     <tbody>
          <?php


          while ($row = mysqli_fetch_assoc($res)) {
          ?> <tr>
                    <td>
                         <?php echo $row['id']; ?>
                    </td>
                    <td>
                         <?php echo $row['name']; ?>
                    </td>
                    <td>
                         <?php echo $row['username']; ?>
                    </td>
                    <td>
                         <?php echo $row['password']; ?>
                    </td>
                    <td> <a href="manage_user.php?id=<?php echo $row['id'] ?>&type=edit">Edit</a>
                         <a href="manage_user.php?id=<?php echo $row['id'] ?>&type=delete">Delete</a>
                    </td>
               </tr>
          <?php } ?>
     </tbody>
</table>