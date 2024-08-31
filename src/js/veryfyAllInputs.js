const inputs = document.querySelectorAll("input[type='text']");

document.querySelector("form").addEventListener('submit', (event) => {
    inputs.forEach(input => {
        if (input.value.trim() === '') {
            document.getElementById("error").innerHTML = "Nie wypełniono wszystkich pól!";
            event.preventDefault();
            return;
        }
    })
});