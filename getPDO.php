<?php
function getPDO(){
  $host="localhost";
 $user="ehmannr";
 $password="Roccatkone5";
 $dbname="testDB"; 
 $ds="mysql:host={$host};dbname={$dbname};";
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