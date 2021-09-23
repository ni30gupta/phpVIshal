<?php
include('db.php');
unset($_SESSION['is_login']);
unset($_SESSION['UID']);
header('location:loginSignup.php');
