// Beégetett felhasználónév és jelszó
const validUsername = "admin";
const validPassword = "password123";

// Ellenőrzi a bejelentkezési állapotot az oldal betöltésekor
document.addEventListener("DOMContentLoaded", function() {
    const loggedIn = sessionStorage.getItem("loggedIn");

    // Elem hivatkozások
    const loginForm = document.getElementById("loginForm");
    const logoutButton = document.getElementById("logoutButton");
    const message = document.getElementById("message");
    const messagePIC = document.getElementById("messagePIC");

    if (loggedIn === "true") {
        // Ha be van jelentkezve, a Login formot elrejtjük, és a Logout gombot mutatjuk
        loginForm.style.display = "none";
        logoutButton.style.display = "inline-block";
        message.innerText = `Üdv, ${validUsername}! Most már tölthet fel új gitárt, módosíthat illetve törölhet!`;
        messagePIC.style.display = "inline-block"; // Itt kell a style.property-t használni
    } else {
        // Ha nincs bejelentkezve, a Login formot mutatjuk, és a Logout gombot elrejtjük
        loginForm.style.display = "block";
        logoutButton.style.display = "none";
        message.innerText = "";
        messagePIC.style.display = "none"; // Itt is a style.property-t használjuk
    }
});

// Form elküldése (bejelentkezés kezelése)
document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault();  // Megakadályozza az űrlap alapértelmezett elküldését

    // Felhasználónév és jelszó lekérése
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;

    // Ellenőrzés
    if (username === validUsername && password === validPassword) {
        // Sikeres belépés, sessionStorage beállítása
        sessionStorage.setItem("loggedIn", "true");
        window.location.reload();  // Frissítjük az oldalt a változások megjelenítéséhez
    } else {
        // Sikertelen belépés
        document.getElementById("message").innerText = "Hibás felhasználónév vagy jelszó!";
    }
});

// Kijelentkezés
document.getElementById("logoutButton").addEventListener("click", function() {
    // Töröljük a bejelentkezési információkat
    sessionStorage.removeItem("loggedIn");
    window.location.reload();  // Az oldal újratöltése, hogy visszajelezze a kijelentkezést
});
