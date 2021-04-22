<?php
    class MyDB extends SQLite3{
        function __invoke(string $DBName){
            $this->open($DBName);
        }
    }

    $action = $_POST['action'];

    try{
        $db = new MyDB('test.db');
        if($action === 'register'){
            registerAccount($db, $_POST['username'], $_POST['password']);
        }
    } catch(Exception $ex){
        echo $db->lastErrorMsg();
    } finally{
        $db->close();
    }
   
    function registerAccount($db, string $username, string $password){        
        $stmt = $db->prepare('INSERT INTO users values (?, ?)');
        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $password);
        $stmt->execute();

        if($stmt){
            echo "Table updated successfully";
        } else{
            echo $stmt->lastErrorMsg();
        }
    }
?>