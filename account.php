<?php
    class MyDB extends SQLite3{
        function __invoke(string $DBName){
            $this->open($DBName);
        }
    }

    $action = $_POST['action'];

    try{
        $db = new MyDB('Main.db');
        if($action === 'addAccount'){
            registerAccount($db,$_POST['Description'], $_POST['username'], ($_POST['password']),$_POST['Folder']);
        }
        elseif($action === 'deleteAccount'){
            deleteAccount($db, $_POST['username'], $_POST['password'],$_POST["Folder"]);
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
             $stmt->bindParam(4, strtoupper($folder));
            $stmt->execute();
   
           if($stmt){
            header("Location: filteredTable.php");  	
            
            } else{
               echo $stmt->lastErrorMsg();
           }
       }
       function deleteAccount($db, string $username, string $password, string $folder){
        $stmt = $db->prepare('DELETE FROM Accounts WHERE Username like ? and Password like ? and Folder like ?;');
        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $password);
        $stmt->bindParam(3,strtoupper($folder));
        $stmt->execute();

        if($stmt){
            header("Location: filteredTable.php");  	
            } else{
               echo $stmt->lastErrorMsg();
           }
       }
    
?>
