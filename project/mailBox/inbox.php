<?php
include('top.php');
include('function.php');
if (!$_SESSION['is_login']) {
     header('location:loginSignup.php');
}


// date_format($now,'y-m-d');


$from_id = $_SESSION['UID'];
$res = mysqli_query($con, "SELECT * from messages where to_id = '$from_id' and inbox_status ='active'");
$count = 1;

$uName = fetchData("SELECT name from users where id = '$from_id'");
echo "Welcome " . strtoupper($uName[0]['name']);

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
          <table class="table">
               <thead>
                    <tr>
                         <!-- <th scope="col"> </th> -->
                         <th scope="col"> <input type='checkbox'> #</th>
                         <th scope="col">From</th>
                         <th scope="col">Subject</th>
                         <th scope="col"><a href="javascript:void(0)">Delete</a></th>
                    </tr>
               </thead>
               <tbody>
                    <?php
                    while ($rows = mysqli_fetch_assoc($res)) {
                         $id = $rows['id'];
                         $getid = $rows['from_id'];
                         $readClass = "";
                         $data = mysqli_query($con, "SELECT name from users WHERE id = '$getid'");
                         $name = mysqli_fetch_assoc($data)['name'];
                         if ($rows['is_read'] == '0') {
                              $readClass = 'unread';
                         }
                         echo "
                               <tr id ='row" . $id . "' > 
                         <th scope='row'> <input id = " . $id . " name = 'selected[]' onclick = 'selectMsg(" . $id . ")' type='checkbox'> " . $count . " </th>
                         <td>" . $name . "</td>
                         <td> <a id='$id' class= " . $readClass . "   href = 'message.php?id=" . $id . "'> " . $rows['subject'] . " </a> </td>";
                         echo "<td> <a href = 'javascript:void(0)' onclick = 'trashMsg(" . $id . " )' > Delete </a> </td>
                         </tr>
                              ";
                         $count++;
                    }
                    ?>

               </tbody>
          </table>
     </div>
</div>

<?php
include('footer.php');
?>

<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

<script>
     function trashMsg(id, type = 'inbox') {
          console.log("object")
          $.ajax({
               url: 'delete.php',
               method: 'post',
               data: `id=${id}&type=${type}`,
               success: function(result) {
                    result = $.parseJSON(result);
                    if (result.status == 'Success') {
                         $(`#row${id}`).remove()
                    }

               }
          })
     }

     function selectMsg(id) {
          let data = document.getElementsByName('selected')
          console.log(data)
     }
</script>

<style>
     .unread {
          font-weight: bolder;
          background-color: yellow;
     }
</style>