  # **Goals**
  This Project aims to be a easy to use, locally hosted, password mangager
   - Primary
     - Use an open source encryption to keep passwords safe
     - Easy to use and understand user interface
     - Suggest strong passwords on demandA
   - Stretch Goals
     -  Uploading files to be encrypted
     - Check passwords if they have been apart of a data breach

 
 
 
 # **Requirements and Links**
 - [XAMPP INSTALLER](https://www.apachefriends.org/index.html) 
     We use XAMPP to host our php on an Apache local sever
     -  [Download PHP 7.4](https://www.php.net/downloads) 
    With XAMPP you do not need to download any version of php since XAMPP has it by default
   
     
# **Starting Guide**
  ### Cloning the Repository
  - To clone the Repository use `git clone https://github.com/Ehmannr/Vaulted [Your Folder here]` 
  ###### Note: do not keep the [] in your command
   
   ## **Configuration**
   - Config XAMMP
   Once Installed open XAMPP and go to Apache config and edit your __httpd.conf__ file
   - Search for DocumentRoot and change the DocumentRoot and Directory point to your clone as shown below.
    ![text](https://cdn.discordapp.com/attachments/446683114958356481/836023576892407808/unknown.png)
    
   Once that is done
   - Still inside of XAMPP Control Panel go back to Apache config and edit your __php.ini__ file
   -  Search for sqlite and make sure that the two highlighted lines are uncommented
    ![text](https://cdn.discordapp.com/attachments/446683114958356481/836043049158836285/unknown.png)
    
   ## Local Host
   When finished with both files and cloned the repository
   If you go and start the sever inside of XAMMP Apache go to any web browser and type in localhost and it should take you to the login page of Vaulted
   
