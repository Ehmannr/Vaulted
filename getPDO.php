<?php
function getPDO(){
  $host="localhost";
 $user="root";
 $password="password";
 $ds="mysql:host={$host};dbname={test};";
  try{
    $db=new PDO($ds,$user,$password);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    return $db;
  }catch(PDOException $ex){
    print_r($ex);
    handeDBError("Cannot connect to database. Try again later.");
  }
}
?>