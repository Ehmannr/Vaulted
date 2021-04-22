function swap_to_loginform(){
    document.getElementById("registerform").style.display = "none";
    document.getElementById("loginform").style.display = "block";
}
function swap_to_deleteform() {
    document.getElementById("deleteform").style.display = "block";
    document.getElementById("registerform").style.display = "none";
}
function swap_to_registrationform() {
    document.getElementById("registerform").style.display = "block";
    document.getElementById("loginform").style.display = "none";

}
function swap_to_registrationform2() {
    document.getElementById("registerform").style.display = "block";
    document.getElementById("deleteform").style.display = "none";

}
