var passwordContainers = document.querySelectorAll(".password-container");

passwordContainers.forEach(container => {
    // Znajdź input i przycisk wewnątrz kontenera
    var passwordInput = container.querySelector(".password-input");
    var toggleButton = container.querySelector(".show-password-btn");

    // Przypisz funkcję przełączania widoczności hasła do przycisku
    toggleButton.addEventListener("click", () => {
        var passwordType = passwordInput.getAttribute("type");

        if (passwordType === "password") {
            passwordInput.setAttribute("type", "text");
            toggleButton.innerHTML = '🔓';
        } else {
            
            passwordInput.setAttribute("type", "password");
            toggleButton.innerHTML = '🔒';
        }
    });
});