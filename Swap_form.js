//swaps forms inside of filteredTable.php
function swap_to_registrationform2() {
    document.getElementById("registerform").style.display = "block";
    document.getElementById("deleteform").style.display = "none";

}
function swap_to_deleteform() {
    document.getElementById("deleteform").style.display = "block";
    document.getElementById("registerform").style.display = "none";
} 
