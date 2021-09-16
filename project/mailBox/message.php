<?php
include('top.php');

if (isset($_COOKIE['status'])) {

     if ($_COOKIE['status'] == 'unread') {
          setcookie('status', 'read', time() + 10);
     }
}
if (!$_SESSION['user_id']) {
     header('location:loginSignup.php');
}
if (isset($_GET['name'])) {
     $name = $_GET['name'];
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
          <h3> <?php echo $name; ?> </h3> <span>
               <p>3:00PM 18/10/2021</p>
          </span>
          <hr>
          <h4>Message</h4>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero eos odit sequi odio sunt id numquam error, facilis architecto, optio facere maxime omnis magni molestiae aliquam in autem, porro culpa.</p>
     </div>
</div>

<?php
include('footer.php');
?>