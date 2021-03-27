<?php
include "test.php";
session_start();
login();
/*
if(isset($_POST["action"])){
  if($_POST["action"] === "login") login();
  elseif($_POST["action"] === "register") registerAccount();
  else process_error("HTTP/1.1 422 Unprocessable Entity", "Invalid action parameter.");
}
else
  process_error("HTTP/1.1 400 Bad Request","Missing action parameter.");
  */

function login(){
  $user = $_POST["username"];
  $password = $_POST["password"];

  $conn = getPDO();
  try{
    $passwordQuery = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $passwordQuery->execute([$user]);
    $row = $passwordQuery->fetch(PDO::FETCH_ASSOC);
    
    if($row["password"]==="test"){
      header("Location: testing.html");  				
    }
    else{
        echo( "im here two");
      header("Location: index.html");
    }
  }catch(PDOException $ex){
    echo( "im here three");
    header("Location: index.html");    
  }
}

function registerAccount(){
  $username = $_POST["username"];
  $fname = $_POST["fname"];
  $lname = $_POST["lname"];
  $saltedPass = password_hash($_POST["password"], PASSWORD_BCRYPT);

  $conn=getPDO();
  try{
    $sql=$conn->prepare("SELECT userID FROM users where username like ?");
    $sql->execute([$username]);
    $row=$sql->fetch(PDO::FETCH_ASSOC);
    if($row!=NULL){
      header("Location: http://divinanacua.com/errors/duplicateUsername.html");
      exit;
    }

    $sql=$conn->prepare("SELECT userID from users where email like ?");
    $sql->execute([$email]);
    $row=$sql->fetch(PDO::FETCH_ASSOC);
    if($row!=NULL){
      header("Location: http://divinanacua.com/errors/duplicateEmail.html");
      exit;
    }
		
    else{
      $sql=$conn->prepare("INSERT INTO users(username,fname,lname,password,familyMember,email) values (?,?,?,?,?,?)");
      $sql->execute([$username,$fname,$lname,$saltedPass,0,$email]);
      //$conn->exec($sql);
      echo "Account successfully registered.";
    }
  }catch(PDOException $ex){
    handleDBError("Cannot connect to database. Try again later.", $ex);
  }
}
?>
