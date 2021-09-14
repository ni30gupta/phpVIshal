<?php
$con = mysqli_connect('localhost', 'root', 'root', '28aug');



$total_count = mysqli_num_rows(mysqli_query($con, "select * from students"));
$per_page = 10;
if (isset($_GET['per_page'])) {
     $per_page = $_GET['per_page'];
}
$pagi = ceil($total_count / $per_page);
$start = 1;
if (isset($_GET['start']) && $_GET['start'] > 0) {
     $start = $_GET['start'];

     if ($start > $pagi) {
          $start = $pagi;
     }
}
$startSql = ($start * $per_page) - $per_page;



$res = mysqli_query($con, "select * from students limit $startSql,$per_page");
?>
<table border="1">
     <tr>
          <td>S.No</td>
          <td>Name</td>
     </tr>
     <?php
     $sno = 1;
     while ($row = mysqli_fetch_assoc($res)) {
     ?>
          <tr>
               <td><?php echo $sno++ ?></td>
               <td><?php echo $row['name'] ?></td>
          </tr>
     <?php
     }
     ?>
</table>

<?php
echo "<div class='pagination'>";
if ($start != 1) {

     echo "<a href='?start=1&per_page=$per_page'>First</a>";
}



if ($start != $pagi) {

     $next = $start + 1;
     echo "<a href='?start= $next&per_page=$per_page'>Next</a>";
}


$lastrow = $pagi - $start;
if ($lastrow < 10) {
     $end = $lastrow + $start;
} else {
     $end = $start + 10;
}





for ($i = $start; $i <= $end; $i++) {


     if ($start == $i) {
          echo "<a href='?start=$i&per_page=$per_page' class='active'>$i</a>&nbsp;";
     } else {
          echo "<a href='?start=$i&per_page=$per_page'>$i</a>&nbsp;";
     }
}

if ($start != 1) {
     $prev = $start - 1;
     echo "<a href='?start= $prev&per_page=$per_page'>Prev</a>";
}





if ($start != $pagi) {

     echo "<a href='?start=$pagi&per_page=$per_page'>Last</a>";
}
echo "</div>";
?>

<select onchange="get_per_page()" id="per_page">
     <?php
     if ($per_page == 10) {
          echo "<option selected>10</option>
			<option>25</option>
			<option>50</option>";
     } elseif ($per_page == 25) {
          echo "<option>10</option>
			<option selected>25</option>
			<option>50</option>";
     } elseif ($per_page == 50) {
          echo "<option>10</option>
			<option>25</option>
			<option selected>50</option>";
     } else {
          echo "<option>10</option>
			<option>25</option>
			<option>50</option>";
     }
     ?>

</select>

<script>
     function get_per_page() {
          per_page = document.getElementById('per_page').value;
          window.location.href = '?per_page=' + per_page;
     }
</script>

<style>
     .pagination a {
          text-decoration: none;
     }

     .pagination .active {
          text-decoration: underline;
     }
</style>