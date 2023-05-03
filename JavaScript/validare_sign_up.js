const form=document.getElementById("signup-form")
const email = document.getElementById("email")
const password = document.getElementById("password")
const phone=document.getElementById("phone")
const confirmPassword = document.getElementById("confirm-password")
const validationIcon = document.getElementById("email-validation-icon");
const city = document.getElementById("city-dropdown");
const postal_code = document.getElementById("postal-code-dropdown");
const phoneValidationIcon = document.getElementById("phone-validation-icon");
const confirmValidationIcon = document.getElementById("confirm-password-validation-icon");

const emailRegex =/^\S+@\S+\.\S+$/
const phoneRegex=/^(07)[0-9]{8}$/

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

form.addEventListener("submit", (e) =>{
    let messages=[]
    if(phoneRegex.test(phone.value) ===false){
        messages.push("Phone number does not exist :)")
    }
    if(messages.length >0){
        e.preventDefault()
        alert(messages.join(", "));
    }
    e.preventDefault()
})

phone.addEventListener("input", () => {
    if (phoneRegex.test(phone.value)) {
        phoneValidationIcon.classList.add("valid-email");
        phoneValidationIcon.classList.remove("invalid-email");
    } else {
        phoneValidationIcon.classList.add("invalid-email");
        phoneValidationIcon.classList.remove("valid-email");
    }
});

form.addEventListener("submit", (e) =>{
    let messages=[]
    if(password.value !==  confirmPassword.value){
        messages.push("Passwords are not the same")
    }
    if(messages.length >0){
        e.preventDefault()
        alert(messages.join(", "));
    }
    else{
        create_user(email.value,phone.value, password.value,city.value , postal_code.value)
    }
    e.preventDefault()


})

confirmPassword.addEventListener("input", () => {
    if(password.value ===  confirmPassword.value) {
        confirmValidationIcon.classList.add("valid-email");
        confirmValidationIcon.classList.remove("invalid-email");
    } else {
        confirmValidationIcon.classList.add("invalid-email");
        confirmValidationIcon.classList.remove("valid-email");
    }
});

function create_user(param1, param2, param3,param4,param5) {
    $.ajax({
        type: "POST",
        url: "http://localhost:63342/PROIECT_FILM_FINAL/php/sign_up.php",
        data: {param1: param1, param2: param2, param3: param3, param4: param4, param5: param5},
        success: function(response) {
            if (response === '1') {
                window.location.href = "Image_upload_management/upload.php";
            } else {
                alert("Invalid credentials!")
            }
        }
    })
}

