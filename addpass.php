<?php
function addAccount(){
    $description = $_POST["desc"]
    $username = $_POST["username"];
    $password = $_POST["password"]
  
    $conn=getPDO();
    try{
      $sql=$conn->prepare("SELECT username FROM users where username like ?");
      $sql->execute([$username]);
      $row=$sql->fetch(PDO::FETCH_ASSOC);
      if($row!=NULL){
        echo("user already in DB");
        exit;
      }
  
      else{
        $sql=$conn->prepare("INSERT INTO users(username,password) values (?,?)");
        $sql->execute([$username,$saltedPass]);
        //$conn->exec($sql);
        header("Location: index.html");
      }
    }catch(PDOException $ex){
    }
  }
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
  