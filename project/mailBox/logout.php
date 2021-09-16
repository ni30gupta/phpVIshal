<?php
include('db.php');
unset($_SESSION['user_id']);
header('location:loginSignup.php');
