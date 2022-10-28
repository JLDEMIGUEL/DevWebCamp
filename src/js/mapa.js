if (document.querySelector('#mapa')) {

    const lat = 40.420271
    const lng = -3.705446
    const map = L.map('mapa').setView([lat, lng], 16);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {}).addTo(map);

    L.marker([lat, lng]).addTo(map)
        .bindPopup(`
            <h2 class="mapa__heading">DevWebCamp</h2>
            <p class="mapa_texto">Gran Via, Madrid</p>
        `)
        .openPopup();
}