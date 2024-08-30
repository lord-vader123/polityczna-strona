const noneSelectedError = "Wszystkie pola muszą być wypełnione";
const tooLittleLettersError = "Hasło musi mieć co najmniej 8 znaków";
const weakPasswordError = "Hasło musi mieć przynajmniej jedną dużą, małą literę i znak specjalny";
const diffrentPasswordError = "Hasła się nie zgadzają";

function isAllSelected(array) {
    const error = document.getElementById('error');
    let all = true;
    array.forEach(element => {
        element = element.value.trim();
        if (element === null || element === "") {
            error.innerHTML = noneSelectedError;
            all = false;
        }
    });

    return all;
}

function isValidPassword(password) {
    const error = document.getElementById('error');
    password = String(password);
    
    if (password.length < 8) {
        error.innerHTML = tooLittleLettersError;
        return false;
    }

    const hasLowerCase = /[a-z]/.test(password);
    const hasUpperCase = /[A-Z]/.test(password);
    const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password);

    if (hasLowerCase && hasUpperCase && hasSpecialChar) {
        return true;
    } else {
        error.innerHTML = weakPasswordError;
        return false;
    }
}

function isEqual(password1, password2) {
    if (password1.trim() !== password2.trim()) {
        error.innerHTML = diffrentPasswordError;
        return false;
    }
    return true;
}

function isValid() {
    const inputs = document.querySelectorAll('input');
    const passwordField = document.getElementById('passphrase').value;
    const passwordField2 = document.getElementById('passphrase2').value;
    console.log("Hasło 1: ", passwordField, " | Hasło 2: ", passwordField2);

    return isAllSelected(inputs) && isValidPassword(passwordField) && isEqual(passwordField, passwordField2);
}

isValid();

document.getElementById('form').addEventListener('submit', (event) => {
    if (!isValid()) {
        event.preventDefault();
    }
})