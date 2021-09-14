<?php
$con = mysqli_connect('localhost', 'root', 'root', '28aug');

$rows = mysqli_num_rows(mysqli_query($con, "SELECT * FROM students"));
$per_page = 10;
$pagi = ceil($rows / $per_page);
$start = 1;

if (isset($_GET['start'])) {
     $start = $_GET['start'];
}
$startSql = ($start * $per_page) - $per_page;

$res = mysqli_query($con, "select * from students limit $startSql,$per_page ");
?>

<h1>Student Table</h1>

<table border="1px solid black">
     <thead>
          <tr>
               <th>Id</th>
               <th>name</th>

          </tr>
     </thead>
     <tbody>
          <?php


          while ($row = mysqli_fetch_assoc($res)) {
          ?> <tr>
                    <td>
                         <?php echo $row['id']; ?>
                    </td>
                    <td>
                         <?php echo $row['name']; ?>
                    </td>

               </tr>
          <?php } ?>
     </tbody>
</table>
<?php
echo "<div class = 'pagination'>";

$next = $start + 1;
echo "<a href='?start=1'>First </a>";
if ($next < $pagi + 1) {
     echo "<a href='?start=$next'>Next </a>";
}

$init = $start + 1;
$end = $start + 10;
if ($init < $pagi) {
     for ($i = $init; $i < $end; $i++) {


          if ($init == $i) {
               echo  "<a class= 'active'  href='?start=$i'>$i</a>  &nbsp;";
          } else {
               echo  "<a  href='?start=$i'>$i</a>  &nbsp;";
          }
     }
}
$last = $pagi - 1;
$previous = $start - 1;
if ($previous > 0) {
     echo "<a  href='?start=$previous'> Previous</a>";
}
echo "<a href='?start=$pagi'> Last</a>";
echo "</div>";
?>

<style>
     .pagination a {
          text-decoration: none;
     }

     .pagination .active {
          text-decoration: underline;
          font-weight: bold;
     }
</style>