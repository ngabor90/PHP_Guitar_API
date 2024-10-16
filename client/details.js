document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');

    if (!id) {
        console.error("Nincs megadva az ID!");
        return;
    }

    const apiUrl = `https://guitarapi.eu/index.php?method=getguitar&id=${id}`;

    fetch(apiUrl)
        .then(response => {
            if (!response.ok) {
                throw new Error(`Hiba a válaszban: ${response.status}`);
            }
            return response.json();
        })
        .then(guitar => {
            console.log('Gitár adat:', guitar);

            if (guitar.error) {
                console.error('API hiba:', guitar.reason);
                document.getElementById('guitar-details').innerHTML = `<p>Hiba: ${guitar.reason}</p>`;
                return;
            }

            const neckPickupValue = guitar.neckPU || "nincs"; 

            const detailsHtml = `
                <h1 class="my-5">${guitar.name}</h1>
                <p id="detailsP">
                    <strong>Type:</strong> ${guitar.type}<br>
                    <strong>Body:</strong> ${guitar.body}<br>
                    <strong>Neck Profile:</strong> ${guitar.neckProfile}<br>
                    <strong>Frets Size:</strong> ${guitar.fretsSize}<br>
                    <strong>Fret Count:</strong> ${guitar.fretCount}<br>
                    <strong>Bridge Pickup:</strong> ${guitar.bridgePU}<br>
                    <strong>Neck Pickup:</strong> ${neckPickupValue}<br>  <!-- Itt a neck pickup értéket frissítjük -->
                    <strong>Price:</strong> ${guitar.price} $<br>
                    <strong>Store No:</strong> ${guitar.storeno}<br>
                </p>
            `;

            document.getElementById('guitar-image').innerHTML = `<img src="${guitar.image_url}" class="w-100" alt="${guitar.name}" title="${guitar.name}">`;
            document.getElementById('guitar-details').innerHTML = detailsHtml;

            const detailsP = document.getElementById('detailsP');
            detailsP.style.fontSize = '1.0rem';
            detailsP.style.lineHeight = '2.5';
        })
        .catch(error => console.error("Hibás adat:", error));
});
