function weryfikujDane() {
const inputy = document.querySelectorAll('input[type="text"]');
const haslo = document.getElementsByName('haslo')[0];
let wszystkieWypelnione = true;

inputy.forEach(element => {
    if (!element.value) {
        wszystkieWypelnione = false;
    }
});

    let hasloValid = haslo.value.length >= 8 && /\d/.test(haslo.value) && zawieraZnakSpecjalny(haslo.value);

    if (!hasloValid) {
        wyswietlBladHasla();
    }

    if (!wszystkieWypelnione) {
        WyswietlBladDanych();
    }

    return wszystkieWypelnione && hasloValid;
}

function WyswietlBladDanych() {
    document.getElementById('blad').innerHTML = `Wszystkie elementy muszą być uzupełnione!`;
}

function zawieraZnakSpecjalny(str) {
    const specialChars = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
    return specialChars.test(str);
}

function wyswietlBladHasla() {
let informacja = `Hasło musi:
    <ul>
        <li>Mieć co najmniej 8 znaków</li>
        <li>Zawierać jeden znak specjalny</li>
        <li>Zawierać przynajmniej jedną cyfrę</li>
    </ul>`;
document.getElementById('blad').innerHTML = informacja;
}

document.querySelector('form').addEventListener('submit', (event) => {
    if (!weryfikujDane()) {
        event.preventDefault();
    }
});