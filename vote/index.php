<?php
$con = mysqli_connect('localhost', 'root', '', '28aug');

$res = mysqli_query($con, "SELECT * from vote");
if (isset($_POST['vote'])) {
     $id = $_POST['id'];
     $vote = $_POST['vote'];
     $finalMsg = "msg$id";

     if (isset($_COOKIE["vote$id"])) {

          $$finalMsg = "Already Voted";
     } else {


          $data = mysqli_fetch_assoc(mysqli_query($con, "SELECT * from vote WHERE id = '$id'"));


          if ($data['vote1'] == $vote) {
               $updateSql = "UPDATE vote SET vote1_count = vote1_count+1 WHERE id='$id'";
          } else {
               $updateSql = "UPDATE vote SET vote2_count = vote2_count+1 WHERE id='$id'";
          }
          mysqli_query($con, $updateSql);
          setcookie("vote$id", $id, time() + 10);
          $$finalMsg = "Thanks for voting";
     }
}
// echo $msg1;
// echo $msg2;


while ($rows = mysqli_fetch_assoc($res)) {
     $id  = $rows['id'];


?>

     <form method="post">

          <input type="submit" name="vote" value="<?php echo $rows['vote1']; ?>"> <span>(<?php echo $rows['vote1_count']; ?>)</span> <input name="id" value="<?php echo $id; ?>" hidden type="text"> V/s

          <input type="submit" name="vote" value="<?php echo $rows['vote2']; ?>"> <span>(<?php echo $rows['vote2_count']; ?>)</span> <input name="id" value="<?php echo $id; ?>" hidden type="text"> <br> <br>
          <?php
          if (isset($msg1) && $msg1 != "") {
               echo $msg1;
               $msg1 = "";
          }
          if (isset($msg2) && $msg2 != "") {
               echo $msg2;
               $msg2 = "";
          }
          ?>
     </form>
<?php } ?>