document.addEventListener('DOMContentLoaded', () => {
    const apiUrl = 'https://guitarapi.eu/index.php?method=getguitars';

    fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('guitar-container');

            if (container) {
                data.forEach(guitar => {
                    const cardHtml = `
                        <div class="col-12">
                            <div class="card">
                                <img src="${guitar.image_url}" class="card-img-top" alt="${guitar.name}" title="${guitar.name}">
                                <div class="card-body">
                                    <h3 class="card-title text-center">${guitar.name}</h3>
                                    <p class="card-text">
                                        #${guitar.id}<br>
                                        <strong>Type:</strong> ${guitar.type}<br>
                                        <strong>Body:</strong> ${guitar.body}<br>
                                        <strong>Price:</strong> ${guitar.price} $<br>
                                        <strong>Store No:</strong> ${guitar.storeno}<br>
                                        <button class='btn btn-dark my-5 h-100 w-100' onclick='viewDetails(${guitar.id})'>Details</button><br>
                                    </p>
                                </div>
                            </div>
                        </div>
                    `;

                    const cardElement = document.createElement('div');
                    cardElement.innerHTML = cardHtml;
                    cardElement.className = 'col-lg-3 col-md-6 col-sm-12 mb-4';
                    container.appendChild(cardElement);
                });
            } else {
                console.error("Konténer elem nem található");
            }
        })
        .catch(error => console.error("Hibás adat:", error));
});

function viewDetails(id) {
    window.location.href = `details.html?id=${id}`;
}

