//login
if (sessionStorage.getItem("loggedIn") !== "true") {
    // Ha nincs bejelentkezve, irányítsuk át a login oldalra
    window.location.href = "login.html";
}

document.addEventListener('DOMContentLoaded', () => {
    const idForm = document.getElementById('id-form');
    const updateForm = document.getElementById('update-form');
    const storenoSelect = document.getElementById('storeno');

    // Az id űrlap elküldésekor
    idForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const guitarId = document.getElementById('id').value;

        try {
            const response = await fetch(`https://guitarapi.eu/index.php?method=getguitar&id=${guitarId}`);
            const data = await response.json();

            if (data.error) {
                alert(data.reason);
            } else {
                document.getElementById('name').value = data.name;
                document.getElementById('type').value = data.type;
                document.getElementById('body').value = data.body;
                document.getElementById('neckProfile').value = data.neckProfile;
                document.getElementById('fretsSize').value = data.fretsSize;
                document.getElementById('fretCount').value = data.fretCount;
                document.getElementById('bridgePU').value = data.bridgePU;
                document.getElementById('neckPU').value = data.neckPU;
                document.getElementById('image_url').value = data.image_url;
                document.getElementById('price').value = data.price;

                // Feltöltjük a Store No select-et és beállítjuk a kiválasztott értéket
                await loadStores(data.storeno);
            }
        } catch (error) {
            console.error("Error fetching guitar data:", error);
            alert("Hiba történt az adatlekérdezés során.");
        }
    });

    // A submit gombra kattintva frissítjük az adatokat
    updateForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const guitarId = document.getElementById('id').value;
        const updatedGuitar = {
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

        try {
            const response = await fetch(`https://guitarapi.eu/index.php?method=modguitar`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id: guitarId, ...updatedGuitar }),
            });

            const result = await response.json();

            if (result.error) {
                alert(result.reason);
            } else {
                alert("Gitár sikeresen frissítve!");
                window.location.href = 'index.html';
            }
        } catch (error) {
            console.error("Error updating guitar data:", error);
            alert("Hiba történt az adatok frissítése során.");
        }
    });

    // Store-ok betöltése és az aktuális kiválasztása
    async function loadStores(selectedStore) {
        try {
            const response = await fetch('https://guitarapi.eu/index.php?method=getstorenos');
            const stores = await response.json();

            if (!Array.isArray(stores)) {
                throw new Error("Hibás adatformátum a boltok listájához.");
            }

            storenoSelect.innerHTML = '';
            stores.forEach(store => {
                const option = document.createElement('option');
                option.value = store.storeno;
                option.textContent = store.storeno;
                if (store.storeno == selectedStore) {
                    option.selected = true;
                }
                storenoSelect.appendChild(option);
            });
        } catch (error) {
            console.error("Error fetching stores:", error);
            alert("Hiba történt az üzletek betöltése során.");
        }
    }
});
