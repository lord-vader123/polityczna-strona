/** 
 * @returns (boolean)
 */
function allSelected(array) {
    let all = true;
    array.forEach(element => {
        element = element.trim();
        if (element === NULL && element === "") {
            all = false;
        }
    });

    return all;
}

function password(password) {
    password = String(password);
    passwordLenght = password.length();
    
    


}


