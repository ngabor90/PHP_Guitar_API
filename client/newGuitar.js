//login
if (sessionStorage.getItem("loggedIn") !== "true") {
    // Ha nincs bejelentkezve, irányítsuk át a login oldalra
    window.location.href = "login.html";
}


document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('guitar-form');
    const storenoSelect = document.getElementById('storeno');

    // Store No értékek lekérése a backendből
    fetch('http://localhost/SzakkepesitoVizsga/index.php?method=getstorenos')
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert('Hiba történt a Store No értékek lekérése során: ' + data.reason);
            } else {
                data.forEach(store => {
                    const option = document.createElement('option');
                    option.value = store.storeno;
                    option.textContent = store.storeno;
                    storenoSelect.appendChild(option);
                });
            }
        })
        .catch(error => console.error('Hiba:', error));

    form.addEventListener('submit', (event) => {
        event.preventDefault();

        const guitarData = {
            name: document.getElementById('name').value,
            type: document.getElementById('type').value,
            body: document.getElementById('body').value,
            neckProfile: document.getElementById('neckProfile').value,
            fretsSize: document.getElementById('fretsSize').value,
            fretCount: document.getElementById('fretCount').value,
            bridgePU: document.getElementById('bridgePU').value,
            neckPU: document.getElementById('neckPU').value,
            image_url: document.getElementById('image_url').value,
            price: document.getElementById('price').value,
            storeno: document.getElementById('storeno').value
        };

        const apiUrl = 'http://localhost/SzakkepesitoVizsga/index.php?method=setguitar';

        fetch(apiUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(guitarData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert('Hiba történt: ' + data.reason);
            } else {
                alert('Gitár hozzáadva sikeresen!');
                form.reset();
                window.location.href = 'index.html';
            }
        })
        .catch(error => console.error('Hiba:', error));
    });
});
