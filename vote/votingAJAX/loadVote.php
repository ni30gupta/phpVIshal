<?php
$con = mysqli_connect('localhost', 'root', '', '28aug');

$res = mysqli_query($con, "SELECT * from vote");


while ($rows = mysqli_fetch_assoc($res)) {
     $id  = $rows['id'];
?>
     <script src="https://code.jquery.com/jquery-3.6.0.min.js">

     </script>


     <form method="post">
          <div id="<?php echo $id; ?>"></div>
          <input type="button" onclick="voteSubmit(<?php echo $rows['id'] ?>, 'vote1' )" name="vote1" value="<?php echo $rows['vote1']; ?>"> (<span id="vote1_<?php echo $rows['id']; ?>"><?php echo $rows['vote1_count']; ?></span>) V/s

          <input type="button" onclick="voteSubmit(<?php echo $rows['id'] ?>, 'vote2' )" name="vote2" value="<?php echo $rows['vote2']; ?>"> (<span id="vote2_<?php echo $rows['id']; ?>"><?php echo $rows['vote2_count']; ?></span>)<br> <br>

     </form>


<?php
}
?>