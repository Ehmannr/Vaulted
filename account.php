<?php
include "getPDO.php";
session_start();


if(isset($_POST["action"])){
  if($_POST["action"] === "login") login();
  elseif($_POST["action"] === "register") registerAccount();
}
 

function login(){
  $user = $_POST["username"];
  $password = $_POST["password"];

  $conn = getPDO();
  try{
    $passwordQuery = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $passwordQuery->execute([$user]);
    $row = $passwordQuery->fetch(PDO::FETCH_ASSOC);
    
    if(password_verify($password,$row["password"])){
      header("Location: tableGui.html");  				
    }
    else{   
      header("Location: index.html");
    }
  }catch(PDOException $ex){
    header("Location: index.html");    
  }
}

function registerAccount(){
  $username = $_POST["username"];
  $saltedPass = password_hash($_POST["password"], PASSWORD_BCRYPT);

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
?>
