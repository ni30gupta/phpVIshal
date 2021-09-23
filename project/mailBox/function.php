<?php
$con = mysqli_connect("localhost", "root", "root", "mailbox");


function prx($data)
{
     echo "<pre>";
     print_r($data);
}
$fetchedData = [];

function fetchData($query)
{
     global $con;
     global $fetchedData;
     $res = mysqli_query($con, $query);
     while ($rows = mysqli_fetch_assoc($res)) {
          $fetchedData[] = $rows;
     }
     return $fetchedData;
}
$name = "test";
function getName($id)
{
     global $con;
     global $name;
     $res = mysqli_query($con, "SELECT name from users where id = '$id' ");

     while ($rows = mysqli_fetch_assoc($res)) {
          $name = $rows['name'];
     }
     return $name;
}
