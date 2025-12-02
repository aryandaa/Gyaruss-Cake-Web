// JavaScript  to toggle password visibility
function showHide() {
      var inputan = document.getElementById("password");
      if (inputan.type === "password") {
        inputan.type = "text";
    } else {
        inputan.type = "password";
    }
} 
// End of JavaScript to toggle password visibility
