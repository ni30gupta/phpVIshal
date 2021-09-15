<?php
include('top.php');

if (isset($_POST['submit'])) {
     echo "<pre>";
     print_r($_POST);
     print_r($_SESSION);
}
$res = mysqli_query($con, "SELECT * from users ");
// while ($data = mysqli_fetch_assoc($res)) {
//      echo "<pre>";
//      print_r($data['name']);
// }
?>

<div class="main container d-flex rows ">
     <div class="sidebar col-lg-2">
          <nav class="nav flex-column">
               <a class="nav-link active" href="#">Compose</a>
               <a class="nav-link" href="#">Inbox</a>
               <a class="nav-link" href="#">Sent</a>
               <a class="nav-link" href="#">Trash</a>
          </nav>
     </div>
     <div class="body col-lg-8">
          <form method="POST"">
               <div class=" form-group">

               <div class="form-group">
                    <label for="exampleFormControlSelect1">Example select</label>
                    <select sendto="opt" class="form-control" id="exampleFormControlSelect1">
                         <?php
                         while ($data = mysqli_fetch_assoc($res)) {
                              echo "<option>" . $data['name'] . "</option> ";
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