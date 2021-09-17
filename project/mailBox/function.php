<?php
include('db.php');

function prx($data)
{
     echo "<pre>";
     print_r($data);
}
$fetchedData = [];

function fetchData($query)
{
     global $con;
     $res = mysqli_query($con, $query);
     while ($rows = mysqli_fetch_assoc($res)) {
          $fetchedData[] = $rows;
     }
     return $fetchedData;
}
