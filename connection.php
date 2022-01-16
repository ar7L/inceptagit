<?php
   $host = "localhost";
   $user = "root";
   $password = "";
   $table = "incepta";
   // $conn = mysqli_connect("localhost","root","","lazzpharma");
   $conn = mysqli_connect($host,$user,$password,$table);
   if($conn){
      echo "Hurrah!!";
   }else{
      echo "Oh no!!";
   }
   ob_start();

?>