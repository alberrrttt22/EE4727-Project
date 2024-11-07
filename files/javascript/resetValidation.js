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

document.getElementById("password").addEventListener("input", validatePassword);
document.getElementById("password").addEventListener("input", validateConfirmPW);
document.getElementById("confirm-password").addEventListener("input", validateConfirmPW);

document.getElementById("reset-form").addEventListener("submit", function(event){
    var isPasswordValid = validatePassword();
    var isConfirmPWValid = validateConfirmPW();

    //Prevent form submission if any validation fails

    if (!isPasswordValid || !isConfirmPWValid) {
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