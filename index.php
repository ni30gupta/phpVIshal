<?php
$con = mysqli_connect('localhost', 'root', 'root', '28aug');

session_start();
if (!isset($_SESSION['CRUD_LOGIN'])) {
     header('location:login.php');
}

if ($_SESSION['CRUD_UROLE'] == 0) {
     $sql = "select * from students ";
} else {
     $addedBy = ($_SESSION['CRUD_UID']);
     $sql = "select * from students where added_by='$addedBy'";
}

$res = mysqli_query($con, $sql);

include('top.php');
?>

<h1>Student Table</h1>

<h3>
     <a href="manage.php">Add Data</a> &nbsp;
</h3>

<table border="1px solid black">
     <thead>
          <tr>
               <th>Id</th>
               <th>name</th>
               <th>City</th>
               <th>Marks</th>
               <th>Edit / Delete</th>
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
                         <?php echo $row['city']; ?>
                    </td>
                    <td>
                         <?php echo $row['marks']; ?>
                    </td>
                    <td> <a href="manage.php?id=<?php echo $row['id'] ?>&type=edit">Edit</a>
                         <a href="manage.php?id=<?php echo $row['id'] ?>&type=delete">Delete</a>
                    </td>
               </tr>
          <?php } ?>
     </tbody>
</table>