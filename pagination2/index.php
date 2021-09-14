<?php
$con = mysqli_connect('localhost', 'root', 'root', '28aug');

$rows = mysqli_num_rows(mysqli_query($con, "SELECT * FROM students"));

$start = 1;
$per_page = 10;
if (isset($_GET['start'])) {
     $start = $_GET['start'];
}
if (isset($_GET['per_page'])) {
     $per_page = $_GET['per_page'];
}

$pagi = ceil($rows / $per_page);
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
<br>


<?php

if ($pagi < 5) {
     $range = $pagi - (5 - $pagi);
} else {
     $range = 5;
}

echo "<div class='pagination'>";
if ($start == 1) {
     echo "<a class = 'active' href='?start=1&per_page=$per_page'>First </a>";
} else {

     echo "<a href='?start=1&per_page=$per_page'>First </a>";
}
$next = $start + 1;
if ($next < $pagi + 1) {
     echo "<a href='?start=$next&per_page=$per_page'>Next </a>";
}
if ($start + $range > $pagi) {
     $startPage = $pagi - $range;
} elseif ($start == 1) {
     $startPage = 2;
} else {
     $startPage = $start;
}

for ($i = $startPage; $i < $startPage + $range; $i++) {
     if ($start == $i) {
          echo  "<a class='active' href='?start=$i&per_page=$per_page'>$i &nbsp </a>";
     } else {
          echo  "<a href='?start=$i&per_page=$per_page'>$i &nbsp </a>";
     }
}


$previous = $start - 1;
if ($start != 1) {
     echo "<a href='?start=$previous&per_page=$per_page'>Previous </a>";
}
if ($start == $pagi) {
     echo "<a class='active' href='?start=$pagi&per_page=$per_page'>Last </a>";
} else {

     echo "<a href='?start=$pagi&per_page=$per_page'>Last </a>";
}

?>

<select onchange="range(value)">
     <?php
     if ($per_page == 10) {
          echo "<option selected>10</option>
			<option >15</option>
			<option>25</option>
			<option>50</option>";
     } elseif ($per_page == 15) {
          echo "<option>10</option>
			<option selected>15</option>
               <option>25</option>
			<option>50</option>";
     } elseif ($per_page == 25) {
          echo "<option>10</option>
			<option >15</option>
			<option selected>25</option>
			<option>50</option>";
     } elseif ($per_page == 50) {
          echo "<option>10</option>
			<option >15</option>
			<option>25</option>
			<option selected>50</option>";
     } else {
          echo "<option>10</option>
			<option >15</option>
			<option>25</option>
			<option>50</option>";
     }
     ?>

</select>

<script>
     function range(value) {
          console.log(value)
          window.location.href = `?start=<?php echo $start; ?>&per_page=${value}`;
     }
</script>

<style>
     .pagination a {
          text-decoration: none;
     }

     .pagination .active {
          text-decoration: underline;
          font-size: larger;
          font-weight: bold;
     }
</style>