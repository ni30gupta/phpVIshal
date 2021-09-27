<?php
include('top.php');
if (!$_SESSION['is_login']) {
     header('location:loginSignup.php');
}

$from_id = $_SESSION['UID'];
$res = mysqli_query($con, "SELECT * from messages where to_id = '$from_id' and status ='inactive'");
$count = 1;

?>

<div class="main container d-flex rows ">
     <div class="sidebar col-lg-2">
          <nav class="nav flex-column">
               <a class="nav-link active" href="compose.php">Compose</a>
               <a class="nav-link" href="inbox.php">Inbox</a>
               <a class="nav-link" href="sent.php">Sent</a>
               <a class="nav-link" href="trash.php">Trash</a>
               <a class="nav-link" href="logout.php">Logout</a>
          </nav>
     </div>
     <div class="body col-lg-8">
          <table class="table">
               <thead>
                    <tr>
                         <th scope="col">#</th>
                         <th scope="col">From</th>
                         <th scope="col">Subject</th>
                         <!-- <th scope="col">Message</th> -->
                         <th scope="col">Restore</th>
                    </tr>
               </thead>
               <tbody>
                    <?php
                    while ($rows = mysqli_fetch_assoc($res)) {


                         $getid = $rows['from_id'];
                         $id = $rows['id'];
                         $data = mysqli_query($con, "SELECT name from users WHERE id = '$getid' ");
                         $name = mysqli_fetch_assoc($data)['name'];
                    ?>
                         <tr>
                              <th scope='row'> <?php $count ?> </th>
                              <td> <?php echo $name ?> </td>
                              <td><?php echo $rows['subject'] ?></td>
                              <td> <a href="javascript:void(0)" onclick="restore(<?php echo $id ?>, 'restore')">Restore</a> </td>
                              <td> <a href="javascript:void(0)" onclick="restore(<?php echo $id ?>, 'delete')">Delete</a> </td>
                         </tr>
                    <?php

                         $count++;
                    }
                    ?>

               </tbody>
          </table>
     </div>
</div>

<?php
include('footer.php');
?>

<script>
     function restore(id, type) {
          $.ajax({
               url: 'delete.php',
               method: 'post',
               data: `id=${id}&type=${type}`,
               success: function(result) {
                    console.log(result)

               }
          })
     }
</script>


<style>
     .unread {
          font-weight: bolder;
     }

     #2 {
          font-weight: 100;
     }
</style>