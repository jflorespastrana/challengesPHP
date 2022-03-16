

$(function() {
    
    let map = L.map('map').setView([33.8387, -9.2215], 4);
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    let icon = L.icon({
        iconUrl: '../src/icon.png',
        iconSize: [40, 40],
        iconAnchor: [20, 90],
        popupAnchor: [-5, -80],
        shadowSize: [70, 90],
        shadowAnchor: [20, 90]
    });

    $.get(`../sismologia.php`, function(data) {
        
        data.forEach(({loc, link, date, time, mag, lat, long}) => {

            L.marker([lat, long],{icon: icon}).addTo(map)
                .bindPopup(`<p>${date} ${time} <br> <a href="${link}" target="_blank">${loc}</a> (magnitud ${mag})</p>`)
                .openPopup();
        });
        

    });


})
