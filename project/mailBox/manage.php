<?php
// include('top.php');
include('function.php');

prx($_POST);
$query = "select * from users";
fetchData($query);
