<?php 
   $db = mysqli_connect("localhost", "root", "", "php_blog");
   if(!$db){
      die("Could not connect to database". mysqli_error($db));
   }else{
      // echo "Database connected";
   }
?>