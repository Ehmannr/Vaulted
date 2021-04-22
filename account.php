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
        elseif($action === 'deleteAccount'){
            deleteAccount($db, $_POST['username'], $_POST['password'],$_POST["Folder"]);
        }
        elseif($action === 'filter'){
            filter($db, $_POST['Folder']);
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
       function deleteAccount($db, string $username, string $password, string $folder){
        $stmt = $db->prepare('DELETE FROM Accounts WHERE Username like ? and Password like ? and Folder like ?;');
        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $password);
        $stmt->bindParam(3, $folder);
        $stmt->execute();

        if($stmt){
            header("Location: tableGui.html");
            } else{
               echo $stmt->lastErrorMsg();
           }
       }
    function filter($db, string $folder){
        $stmt = $db->prepare('SELECT * FROM Accounts where Folder like ?');
        $stmt->bindParam(1, $folder);
        $stmt->execute();

        if($stmt){
            echo("This would update the table inside of the prev page if I finished that html/sql/php code");
            } else{
               echo $stmt->lastErrorMsg();
           }
       }
    
?>