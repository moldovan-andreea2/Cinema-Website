const email = document.getElementById("email")
const password= document.getElementById("password")
const form=document.getElementById("login-form")
const errorElement=document.getElementById("error")
const emailRegex =/^\S+@\S+\.\S+$/
const validationIcon = document.getElementById("email-validation-icon");

form.addEventListener("submit", (e) =>{
    let messages=[]
    if(emailRegex.test(email.value) ===false){
        messages.push("A valid email is required :)")
    }
    if(messages.length >0){
        e.preventDefault()
        alert(messages.join(", "));
    }
    e.preventDefault()
})

email.addEventListener("input", () => {
    if (emailRegex.test(email.value)) {
        validationIcon.classList.add("valid-email");
        validationIcon.classList.remove("invalid-email");
    } else {
        validationIcon.classList.add("invalid-email");
        validationIcon.classList.remove("valid-email");
    }
});


document.getElementById("submit-button").addEventListener("click", function() {
    if (document.getElementById("password").value !== "" && document.getElementById("email").value !== ""){
        const p = document.getElementById("password").value
        const u = document.getElementById("email").value
        document.getElementById("password").value="";
        document.getElementById("email").value="";
        check_user(u, p)
    }
    return 0;
});
function check_user(param1, param2) {
    $.ajax({
        type: "POST",
        url: "http://localhost:63342/PROIECT_FILM_FINAL/php/login.php",
        data: {param1: param1, param2: param2},
        success: function(response) {
            if (response === '1') {
                window.location.href = "Image_upload_management/upload.php";
            }
            else if(response === '2'){
                window.location.href = "see_users/see_users.php";
            }
            else {
                alert("Invalid credentials!")
            }
        }
    })
}

