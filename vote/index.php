<?php
$con = mysqli_connect('localhost', 'root', 'root', '28aug');

$res = mysqli_query($con, "SELECT * from vote");
if (isset($_POST['vote'])) {
     $id = $_POST['id'];
     $vote = $_POST['vote'];

     if (isset($_COOKIE["vote$id"])) {
          $msg = "Already Voted";
     } else {


          $data = mysqli_fetch_assoc(mysqli_query($con, "SELECT * from vote WHERE id = '$id'"));


          if ($data['vote1'] == $vote) {
               $updateSql = "UPDATE vote SET vote1_count = vote1_count+1 WHERE id='$id'";
          } else {
               $updateSql = "UPDATE vote SET vote2_count = vote2_count+1 WHERE id='$id'";
          }
          mysqli_query($con, $updateSql);
          $msg = "Thanks for voting";
          setcookie("vote$id", $id, time() + 10);
     }
}


while ($rows = mysqli_fetch_assoc($res)) {
     $id  = $rows['id'];




?>

     <form method="post">
          <p>
               <?php
               if (isset($msg)) {
                    echo $msg;
                    $msg = "";
               }
               ?>
          </p>
          <input type="submit" name="vote" value="<?php echo $rows['vote1']; ?>"> <span>(<?php echo $rows['vote1_count']; ?>)</span> <input name="id" value="<?php echo $id; ?>" hidden type="text"> V/s
          <input type="submit" name="vote" value="<?php echo $rows['vote2']; ?>"> <span>(<?php echo $rows['vote2_count']; ?>)</span> <input name="id" value="<?php echo $id; ?>" hidden type="text"> <br> <br>
     </form>
<?php } ?>