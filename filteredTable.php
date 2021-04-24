<?php
class MyDB extends SQLite3{
    function __invoke(string $DBName){
        $this->open($DBName);
    }
}
$db = new MyDB('Main.db');
?>


<!DOCTYPE html>
<html>

<head><style>
        .header {
            font-size: 2rem;
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
        }

        .header-small {
            font-size: 1.2rem;
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
        }

        .folder-title {
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
        }
        .gradient-background {
            color: white;
        }
        .row {
            display: flex;
            height: fit-content;
        }
        .column1 {
            display: flex;
            justify-content: center;
            flex-direction: column;
            flex: 15%;
            border-style: solid;
            border-width: 2px;
        }
        .column2 {
            flex: 85%;
            border-style: solid;
            border-width: 1px;
            border-left: 0px;
        }
        table,th,td {
            border-collapse: collapse;
            border: 1px solid white;
            margin-left: auto;
            margin-right: auto;
        }
        table {
            width: 100%;
            height: 100%;
            
        }
        th,td {
            padding: 10px;
        }
        #registerform{
            display:none;
        }
        #deleteform{
            display:none;
        }
       
        input[type=button], input[type=submit], input[type=reset] {
    background-color: #3c4249;
    border: none;
    color: white;
    padding: 16px 32px;
    text-decoration: none;
    margin: 4px 2px;
    cursor: pointer;
}
a[class*=red__button] {
    background-color: #d14a41;
    border: none;
    color: white;
    padding: 16px 32px;
    text-decoration: none;
    margin: 4px 2px;
    cursor: pointer;
        
  }
  #delete_button{
    background-color: #d14a41;
    border: none;
    color: white;
    padding: 16px 32px;
    text-decoration: none;
    margin: 4px 2px;
    cursor: pointer;
  }
    </style>
    <link rel="stylesheet" href="styles.css">
    </head>
    <body>
    <section class="gradient-background">
        <h2 class="header"> Vaulted </h2>
        <div class="row">
            <div class="column1">
                <h2 class="header-small">Folders</h2>
                <form action="filteredTable.php" id="filterform" method="POST" >
                    <input type="hidden" name="action" value="filter">
        
                    <label for="Folder"> Sort by:</label>
            <input type="text" id="Folder" name="Folder">
                
                    <br>
    
                    <input type="submit" value="Search" >
                  </form> 
                  <br>
                <a class="black__button" onclick="swap_to_registrationform2()">Add an account</a>
                <a class="red__button" onclick="swap_to_deleteform()">Delete account</a>

            </div>
            <div class="column2">
                <table id= "genreal">
                    <!--tr = table row-->
                    <tr><!--headers-->
                        <th>Description</th>
                        <th>Username/Email</th>
                        <th>Password</th>
                        <th>Folder</th>
                    </tr>
                    <?php
                        $db = new MyDB('Main.db');
                       $result = $db -> query("SELECT * from Accounts");
                       while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                        echo "<tr><td>". $row["Descript"]."</td><td>". $row["Username"]."</td><td>". $row["Password"]."</td><td>". $row["Folder"]."</td><tr>";
                    }
                    echo"</table>";
                    $db->close();
                    ?>
                </table>
            </div>
        </div>
        <section style = "text-align: Center;">
        <form action="account.php" id="registerform" method="POST" >
            <input type="hidden" name="action" value="addAccount">

            <label for="Description">Description:</label>
            <input type="text" id="Descript" name="Description">
        
            <br>
        
            <label for="username">Username registeration:</label>
            <input type="text" id="username" name="username">
            <br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            <br>

            
            <label for="Folder"> Add to a Folder:</label>
            <input type="text" id="Folder" name="Folder">
            
            <br>
            <input type="submit" value="Add Account">
        </form>

        
            <form action="account.php" id="deleteform" method="POST" >
                <input type="hidden" name="action" value="deleteAccount">
    
                        
                <br>
            
                <label for="username">Username to Delete:</label>
                <input type="text" id="username" name="username">
                <br>
    
                <label for="password">Password:</label>
                <input type="password" id="password" name="password">
                <br>
    
                
                <label for="Folder"> Delete from Folder:</label>
                <input type="text" id="Folder" name="Folder">
                
                <br>
                <input id = "delete_button" type="submit" value="Delete Account">
            </form>
        </section>
    </section>

 <script src = "Swap_form.js"> </script>

</body>