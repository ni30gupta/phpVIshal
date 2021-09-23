<?php
include('top.php');
include('function.php');


if (!$_SESSION['is_login']) {
     header('location:loginSignup.php');
}
if (isset($_GET['id'])) {
     $id = $_GET['id'];
     $message = fetchData("SELECT * from messages where id = '$id'");
}

$from_id = $_SESSION['UID'];
$res = mysqli_query($con, "SELECT * from messages where from_id = '$from_id'");
$count = 1;
$msgId = $message[0]['from_id'];
mysqli_query($con, "UPDATE messages SET is_read='1' WHERE id = '$id'")

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
          <h3> From : <?php echo getName($msgId); ?> </h3> <span>
               <p><?php echo $message[0]['inserted_on']; ?> </p>
          </span>
          <hr>
          <h4> <?php echo $message[0]['subject']; ?> </h4>
          <p><?php echo $message[0]['message']; ?> </p>
     </div>
</div>

<?php
include('footer.php');
?>