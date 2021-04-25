<?php
    class MyDB extends SQLite3{
        function __invoke(string $DBName){
            $this->open($DBName);
        }
    }
    //gets what button is pushed and goes into try - catch 
    $action = $_POST['action'];

    try{
        $db = new MyDB('Main.db');
        if($action === 'register'){
            registerAccount($db, $_POST['username'], hashPass($_POST['password']));
        }
        elseif($action === 'login'){
            login($db, $_POST['username'], $_POST['password']);
        }

    } catch(Exception $ex){
        echo $db->lastErrorMsg();
    } finally{
        $db->close();
    }
   
    //uses hash to encrypt user passwords for storeage within DB
    function hashPass(string $password){
        return password_hash($_POST["password"], PASSWORD_BCRYPT);
    }


    // registers accoutn into db Users table
    function registerAccount($db, string $username, string $password){  
         $stmt = $db->prepare('INSERT INTO Users values (?, ?)');
         $stmt->bindParam(1, $username);
         $stmt->bindParam(2, $password);
         $stmt->execute();

        if($stmt){
            header("Location: index.html");
         } else{
            echo $stmt->lastErrorMsg();
        }
    }
     //get username and password and compare from db
    function login($db, string $username, string $password){
        try{
          $passwordQuery = $db->prepare("SELECT Passwords FROM Users WHERE Usernames = ?");
          $passwordQuery->bindParam(1, $username);
          $data =$passwordQuery->execute();
          $row = $data->fetchArray(SQLITE3_ASSOC);
            //built in verify function
           if(password_verify($password,$row["Passwords"])){
             header("Location: filteredTable.php");  				
           }
            else{ 
              echo("Username or password is incorrect");        
            }
        }catch(PDOException $ex){
            echo("Username or password is incorrect 123");    
        }
      }
      
?>