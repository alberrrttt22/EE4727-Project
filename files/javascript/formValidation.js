function validateName(){
    var name = document.getElementById("name").value.trim();
    var nameError = document.getElementById("name-error");
    var nameRegex = /^[A-Za-z]+(?:\s+[A-Za-z]+)*$/;
    if (!nameRegex.test(name)){
        nameError.textContent = "Please input a valid name.";
        return false;
    }
    else {
        nameError.textContent =""
        return true;
    }
}

function validateEmail(){
    var email = document.getElementById("email").value.trim();
    var emailError = document.getElementById("email-error");
    var emailRegex = /^[\w.-]+@[a-zA-Z\d]+\.[a-zA-Z]{2,3}(?:\.[a-zA-Z]{2,3}){0,2}$/i;
    if (!emailRegex.test(email)){
        emailError.textContent = "Please input a valid email.";
        return false;
    }
    else {
        emailError.textContent =""
        return true;
    }
}

function validatePhone(){
    var phone = document.getElementById("phone").value.trim();
    var phoneError = document.getElementById("phone-error");
    var phoneRegex = /^[89]\d{7}$/;
    if (!phoneRegex.test(phone)){
        phoneError.textContent = "Please input a valid number.";
        return false;
    }
    else {
        phoneError.textContent =""
        return true;
    }
}

function validatePassword(){
    var password = document.getElementById("password").value.trim();
    var passwordError = document.getElementById("password-error");
    // Check if password has at least 8 characters, one uppercase letter, and one special character
    const minLength = /.{8,}/;
    const hasUpperCase = /[A-Z]/;
    const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/;

    if (minLength.test(password) && hasUpperCase.test(password) && hasSpecialChar.test(password)){
        passwordError.textContent = "";
        return true;
    }

    else{
        passwordError.textContent="Password does not meet the requirements.";
        return false;
    }
}

function validateConfirmPW() {
    var cfmpw = document.getElementById("confirm-password").value.trim();
    var password = document.getElementById("password").value.trim();
    var cfmpwError = document.getElementById("cfm-pw-error")
    if (cfmpw == password){
        cfmpwError.textContent = "";
        return true;
    }
    else{
        cfmpwError.textContent = "Passwords do not match."
        return false;
    }
}


document.getElementById("name").addEventListener("input", validateName);
document.getElementById("email").addEventListener("input", validateEmail);
document.getElementById("phone").addEventListener("input", validatePhone);
document.getElementById("password").addEventListener("input", validatePassword);
document.getElementById("password").addEventListener("input", validateConfirmPW);
document.getElementById("confirm-password").addEventListener("input", validateConfirmPW);

document.getElementById("signup-form").addEventListener("submit", function(event){
    var isNameValid = validateName();
    var isEmailValid = validateEmail();
    var isPhoneValid = validatePhone();
    var isPasswordValid = validatePassword();
    var isConfirmPWValid = validateConfirmPW();

    //Prevent form submission if any validation fails

    if (!isNameValid || !isEmailValid || !isPhoneValid || !isPasswordValid || !isConfirmPWValid) {
        event.preventDefault();  // Stop form submission
        alert("Please fix the error message(s)")
    }
})

const passwordInput = document.getElementById('password');
const requirementsDiv = document.getElementById('requirements');

passwordInput.addEventListener('focus', function() {
    requirementsDiv.style.display = 'block';
});

passwordInput.addEventListener('blur', function() {
    requirementsDiv.style.display = 'none';
});

