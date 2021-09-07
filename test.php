<?php
$con = mysqli_connect('localhost', 'root', 'root', '28aug');

for ($i = 0; $i < 150; $i++) {
     mysqli_query($con, "INSERT INTO students (name) values('name$i')");
}
