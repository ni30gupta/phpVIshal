<?php
include('function.php');
class database
{
     function __construct()
     {
          $this->con = mysqli_connect('localhost', 'root', 'root', '28aug');
     }
     function insert($table, $data)
     {
          foreach ($data as $key => $value) {

               $sql = "INSERT INTO $table($key)  VALUES($val)";
          }
     }
     function __destruct()
     {

          mysqli_close($this->con);
     }
}
$obj1 = new database();
$form_data = [
     'vote1' => 'PHP',
     'vote2' => 'NODE',
     'vote1_count' => '5',
     'vote2_count' => '8'
];
$obj1->insert('vote', $form_data);
