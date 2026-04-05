// clicking on sign up 
const signupBtn = document.getElementById("signupBtn");

signupBtn.addEventListener("click", function () {
    const newUser = document.getElementById("newusername").value.trim();
    const newEmail = document.getElementById("newemail").value.trim();
    const newPassword = document.getElementById("newpassword").value.trim();
    const signupMsg = document.getElementById("signupmsg");

    // Check empty fields
    if (newUser === "" || newEmail === "" || newPassword === "") {
        signupMsg.textContent = "Please fill all fields!";
        signupMsg.style.color = "red";
        return;
    }

    // Show signup complete message
    signupMsg.textContent = "Sign Up Complete! Welcome, " + newUser;
    signupMsg.style.color = "green";

    
});