<?php
$con = mysqli_connect('localhost', 'root', 'root', '28aug');
session_start();
unset($_SESSION['CRUD_LOGIN']);
header('location:login.php');
