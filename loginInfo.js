

//func to chk login 
 document.getElementById("loginBtn").addEventListener("click",function(){

 
    // geting input from user
    const inputusername = document.getElementById("username").value.trim();
    const inputpassword = document.getElementById("password").value.trim();
    const message = document.getElementById("message");
    
    // chk empty feilds if
    if(inputusername === "" || inputpassword ===""){
        message.textContent ="Please fill all feilds";
        message.style.color ="red";
        return;
    }
    
    // chk if valu matches 
    document.getElementById("loginForm").submit();

    

})


