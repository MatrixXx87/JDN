const mymap = L.map('mapid').setView([45.837469, 1.489231], 16);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mymap);

        L.marker([45.837469, 1.489231]).addTo(mymap)
            .bindPopup("<h3>L'escalier</h3><address>3, Place Gay Lussac<br/>87400 Saint-Léonard-de-Noblat</address>");

        let circle = L.circle([45.837469, 1.489231], {
            color: 'e58714',
            fillColor: '#f03',
            fillOpacity: 0.5,
            radius: 150
        }).addTo(mymap);

        let popup = L.popup();

        function onMapClick(e) {
            popup
                .setLatLng(e.latlng)
                .setContent("You clicked the map at " + e.latlng.toString())
                .openOn(mymap);
        }

        mymap.on('click', onMapClick);