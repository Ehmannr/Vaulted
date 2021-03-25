/*this is for testing purposes*/
function attemp_login() {
           
    var username = "a";
    var password = "p";
    const username_input = document.getElementById("username").value;
    const password_input = document.getElementById("pwd").value;
        if (username_input == username && password_input == password) {
           
            window.location.replace("../main_Gui/index.html");
        }
        else{
            alert("Invalid username or password");
        }
    }