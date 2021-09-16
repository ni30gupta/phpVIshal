<?php
include('top.php');
if (!$_SESSION['user_id']) {
     header('location:loginSignup.php');
}

$from_id = $_SESSION['user_id'];
$res = mysqli_query($con, "SELECT * from messages where from_id = '$from_id'");
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
                         <th scope="col">To</th>
                         <th scope="col">Subject</th>
                         <th scope="col">Message</th>
                    </tr>
               </thead>
               <tbody>
                    <?php
                    while ($rows = mysqli_fetch_assoc($res)) {
                         $getid = $rows['to_id'];
                         $data = mysqli_query($con, "SELECT name from users WHERE id = '$getid'");
                         $name = mysqli_fetch_assoc($data)['name'];
                         echo "   
                               <tr>
                         <th scope='row'>" . $count . " </th>
                         <td>" . $name . "</td>
                         <td>" . $rows['subject'] . "</td>
                        <td>  <a   href='message.php'>" . $rows['message'] . " </a></td> </a>
                    </tr> 
                             ";
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