<?php
include('top.php');
include('function.php');
if (!$_SESSION['is_login']) {
     header('location:loginSignup.php');
}


$from_id = $_SESSION['UID'];
$res = mysqli_query($con, "SELECT * from messages where to_id = '$from_id' and inbox_status ='active'");
$count = 1;

$res_verify = mysqli_query($con, "SELECT verified from users WHERE id = '$from_id'");
$isVerified = mysqli_fetch_assoc($res_verify);
if ($isVerified['verified'] == '0') {
     echo "<script>alert('Please verify the link sent on mail') ; window.location.href= 'loginSignup.php'</script>";
     // header('location:loginSignup.php');

}



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
          <form method="POST" id="frm">
               <table class="table">
                    <thead>
                         <tr>
                              <th scope="col"> <input id='select_all' type='checkbox' onclick="selectAll()"> #</th>
                              <th scope="col">From</th>
                              <th scope="col">Subject</th>
                              <th id="delete_btn" scope="col"><a href="javascript:void(0)" onclick="deleteAll()">Delete</a></th>
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

                         ?>
                              <tr id="row<?php echo $id ?>">
                                   <th scope="row">
                                        <input type="checkbox" value="<?php echo $id ?>" id="<?php echo $id ?>" name="msg[]" onclick="enable_delete()">
                                        <?php echo $count ?>
                                   </th>
                                   <td><?php echo $name ?></td>
                                   <td>
                                        <a href="message.php?id=<?php echo $id ?>" class="<?php echo $readClass ?>"> <?php echo $rows['subject'] ?> </a>
                                   </td>
                                   <td>
                                        <a href="javascript:void(0)" onclick="trashMsg('<?php echo $id ?>')">Delete</a>
                                   </td>
                              </tr>
                         <?php
                              $count++;
                         }
                         ?>

                    </tbody>
               </table>
          </form>
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

     function enable_delete() {
          $('#delete_btn').hide();
          var items = document.getElementsByName('msg[]')
          var is_selected = false;
          for (let index = 0; index < items.length; index++) {
               if (items[index].checked === true) {
                    is_selected = true;
                    break
               } else {
                    $('#select_all').prop('checked', false);
               }
          }
          if (is_selected === true) {
               $('#delete_btn').show();
          }
     }


     var select_all = false;

     function selectAll() {

          var items = document.getElementsByName('msg[]')

          if (!select_all) {
               items.forEach(element => {
                    element.checked = true;
               });
               select_all = true;
               $('#delete_btn').show();
          } else {
               items.forEach(element => {
                    element.checked = false;
               });
               select_all = false;
               $('#delete_btn').hide();
          }


     }

     function deleteAll() {
          $.ajax({
               url: 'delet_all.php',
               method: 'post',
               data: $('#frm').serialize(),
               success: function(result) {
                    var items = document.getElementsByName('msg[]');
                    for (let index = 0; index < items.length; index++) {
                         if (items[index].checked === true) {
                              $('#row' + (index + 3)).hide()
                         }

                    }
               }
          })
     }
</script>

<style>
     .unread {
          font-weight: bolder;
          background-color: yellow;
     }

     #delete_btn {
          display: none;
     }
</style>