<?php
    class MyDB extends SQLite3{
        function __invoke(string $DBName){
            $this->open($DBName);
        }
    }
// DELETE FROM Accounts;
// https://www.viralpatel.net/dynamic-add-textbox-input-button-radio-element-html-javascript/
// for adding buttons 
    $action = $_POST['action'];

    try{
        $db = new MyDB('Main.db');
        if($action === 'addAccount'){
            registerAccount($db,$_POST['Description'], $_POST['username'], ($_POST['password']),$_POST['Folder']);
        }
        elseif($action === 'login'){
            login($db, $_POST['username'], $_POST['password']);
        }
    } catch(Exception $ex){
        echo $db->lastErrorMsg();
    } finally{
        $db->close();
    }

        function registerAccount($db,string $descript, string $username, string $password, string $folder){  
            $stmt = $db->prepare('INSERT INTO Accounts values (?, ?, ?, ?)');
            $stmt->bindParam(1, $descript);
            $stmt->bindParam(2, $username);
             $stmt->bindParam(3, $password);
             $stmt->bindParam(4, $folder);
            $stmt->execute();
   
           if($stmt){
            header("Location: tableGui.html");
            echo '<script>alert("Account added")</script>';
            } else{
               echo $stmt->lastErrorMsg();
           }
       }
    
?>