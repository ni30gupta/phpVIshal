<?php
$con = mysqli_connect('localhost', 'root', '', '28aug');

$res = mysqli_query($con, "SELECT * from vote");


while ($rows = mysqli_fetch_assoc($res)) {
     $id  = $rows['id'];
?>

     <form method="post">
          <div id="<?php echo $id; ?>"></div>
          <input type="button" onclick="voteSubmit(<?php echo $rows['id'] ?>, 'vote1' )" name="vote1" value="<?php echo $rows['vote1']; ?>"> (<span id="vote1_<?php echo $rows['id']; ?>"><?php echo $rows['vote1_count']; ?></span>) V/s

          <input type="button" onclick="voteSubmit(<?php echo $rows['id'] ?>, 'vote2' )" name="vote2" value="<?php echo $rows['vote2']; ?>"> (<span id="vote2_<?php echo $rows['id']; ?>"><?php echo $rows['vote2_count']; ?></span>)<br> <br>

     </form>

     <script src="https://code.jquery.com/jquery-3.6.0.min.js">

     </script>
     <script>
          function voteSubmit(id, type) {
               console.log(id, type)
               $.ajax({
                    url: 'submit.php',
                    type: 'post',
                    data: "id=" + id + '&type=' + type,
                    success: function(result) {
                         v = $('#' + type + '_' + id).html();
                         v = parseInt(v) + 1;
                         // $('#' + type + '_' + id).html(v);
                         // console.log(result);

                         newRes = $.parseJSON(result)
                         $(`#${id}`).html(newRes.msg);
                         // console.log(newRes.vote)
                         if (newRes.vote) {

                              $(`#${type}_${id}`).html(newRes.vote)
                         }

                    }
               })
          }
     </script>
<?php } ?>