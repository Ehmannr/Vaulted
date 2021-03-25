/*this is for testing purposes*/
const username = admin;
const password = password;
const username_input = document.getElementById("username").value;;
const password_input= document.getElementById("pwd").value;;

function attemp_login() {
    if (username_input == username && password_input == password) {
        alert("Login successfully");
    }
}