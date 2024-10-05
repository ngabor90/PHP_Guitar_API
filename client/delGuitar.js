//login
if (sessionStorage.getItem("loggedIn") !== "true") {
    // Ha nincs bejelentkezve, irányítsuk át a login oldalra
    window.location.href = "login.html";
}

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('delete-form');

    form.addEventListener('submit', (event) => {
        event.preventDefault();

        const id = document.getElementById('id').value;

        if (!id) {
            alert("Kérjük, adja meg a gitár ID-jét!");
            return;
        }

        const apiUrl = `http://localhost/SzakkepesitoVizsga/index.php?method=delguitar&id=${id}`;

        fetch(apiUrl, {
            method: 'DELETE',
        })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert("Hiba történt: " + data.reason);
                } else {
                    alert("Gitár sikeresen törölve!");
                    form.reset();
                    window.location.href = 'index.html';
                }
            })
            .catch(error => console.error("Hiba:", error));
    });
});
