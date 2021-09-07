<?php
$con = mysqli_connect('localhost', 'root', 'root', '28aug');

$res = mysqli_query($con, "SELECT * from vote");

if (isset($_POST['submit'])) {
     echo "<pre>";
     print_r($_POST);
}

while ($rows = mysqli_fetch_assoc($res)) {
     $id  = $rows['id'];
?>

     <form method="post">
          <input type="submit" name="submit" value="<?php echo $rows['vote1']; ?>"> <input name="id" value="<?php echo $id; ?>" hidden type="text"> V/s
          <input type="submit" name="submit" value="<?php echo $rows['vote2']; ?>"> <input name="id" value="<?php echo $id; ?>" hidden type="text"> <br> <br>
     </form>
<?php } ?>