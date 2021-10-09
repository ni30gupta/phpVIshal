<?php
include('function.php');
class database
{
     function __construct()
     {
          echo "constructor called ";
          $this->x = 10;
          br();
     }
     function getData()
     {
          $this->x++;
          echo $this->x;
          br();
     }
     function __destruct()
     {

          echo "removing connection";
     }
}
$obj1 = new database();
$obj1->getData();
$obj1->getData();
$obj1->getData();
$obj1->getData();
