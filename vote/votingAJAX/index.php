<?php
$con = mysqli_connect('localhost', 'root', '', '28aug');

$res = mysqli_query($con, "SELECT * from vote");


while ($rows = mysqli_fetch_assoc($res)) {
     $id  = $rows['id'];
     echo $id;


?>

     <form id="vote" method="post">

          <input type="button" onclick="voteSubmit()" name="vote1" value="<?php echo $rows['vote1']; ?>"> <span>(<?php echo $rows['vote1_count']; ?>)</span> <input name="id" value="<?php echo $id; ?>" hidden type="text"> V/s

          <input type="button" onclick="voteSubmit()" name="vote2" value="<?php echo $rows['vote2']; ?>"> <span>(<?php echo $rows['vote2_count']; ?>)</span> <input name="id" value="<?php echo $id; ?>" hidden type="text"> <br> <br>

     </form>

     <script src="https://code.jquery.com/jquery-3.6.0.min.js">

     </script>
     <script>
          function voteSubmit() {

               $.ajax({
                    url: 'submit.php',
                    type: 'post',
                    data: $('#vote').serialize(),
                    success: function(object) {
                         console.log(object)
                    }
               })
          }
     </script>
<?php } ?>