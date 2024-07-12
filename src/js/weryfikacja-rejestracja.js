function weryfikujDane() {
    const inputy = document.querySelectorAll('input[type="text"]');
    let wszystkieWypelnione = true;

    inputy.forEach(element => {
        if (!element.value) {
            wszystkieWypelnione = false;
        }
    });

    if (!wszystkieWypelnione) {
        wyswietlBlad();
    }

    return wszystkieWypelnione;
}

function wyswietlBlad() {
    document.getElementById('blad').innerHTML = `Wszystkie elementy muszą być uzupełnione!`;
}

document.querySelector('form').addEventListener('submit', (event) => {
    if (!weryfikujDane()) {
        event.preventDefault();
    }
});