<?php
include('top.php');
if (!$_SESSION['user_id']) {
     header('location:loginSignup.php');
}

if (isset($_POST['submit'])) {
     $from_id = $_SESSION['user_id'];
     $subject = $_POST['subject'];
     $msg = $_POST['msg'];
     $to_user = $_POST['to_user'];


     // extracting to_id
     $row_id = mysqli_query($con, "SELECT id from users where username = '$to_user'");
     $to_id = mysqli_fetch_assoc($row_id)['id'];

     mysqli_query($con, "INSERT INTO messages(from_id,to_id, subject, message) VALUES('$from_id','$to_id', '$subject', '$msg')");
}



$res = mysqli_query($con, "SELECT * from users ");

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
          <form method="POST"">
               <div class=" form-group">

               <div class="form-group">
                    <label for="exampleFormControlSelect1">Write a New message</label>
                    <select name="to_user" class="form-control" id="exampleFormControlSelect1">
                         <?php
                         while ($data = mysqli_fetch_assoc($res)) {
                              echo "<option>" . $data['username'] . "</option> ";
                         }
                         ?>

                    </select>
               </div>
               <input type="text" name="subject" class="form-control" id="exampleFormControlInput1" placeholder="Subject">


               <div class="form-group">
                    <label for="exampleFormControlTextarea1">Example textarea</label>
                    <textarea name="msg" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
               </div>
     </div>
     <input name="submit" type="submit">
     </form>
</div>
</div>

<?php
include('footer.php');
?>