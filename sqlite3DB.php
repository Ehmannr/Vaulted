<?php
    class MyDB extends SQLite3{
        function __invoke(string $DBName){
            $this->open($DBName);
        }
    }
// DELETE FROM Users WHERE Usernames like "_";
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
   

    function hashPass(string $password){
        return password_hash($_POST["password"], PASSWORD_BCRYPT);
    }



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
    function login($db, string $username, string $password){
        //get username and password and compare from db
        try{
          $passwordQuery = $db->prepare("SELECT Passwords FROM Users WHERE Usernames = ?");
          $passwordQuery->bindParam(1, $username);
          $data =$passwordQuery->execute();
          $row = $data->fetchArray(SQLITE3_ASSOC);
         // echo($row."hello");
         // echo($row["Passwords"]." ".$password);
          
           if(password_verify($password,$row["Passwords"])){
            header("Location: tableGui.html");  				
           }
           else{ 
             echo("Username or password is incorrect");        
           }
        }catch(PDOException $ex){
            echo("Username or password is incorrect 123");    
        }
      }
      
?>