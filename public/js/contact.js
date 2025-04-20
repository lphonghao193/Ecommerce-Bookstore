let map;
let markers = [];

window.initMap = function () {
    map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: 10.7732, lng: 106.6572 }, // default center
        zoom: 16,
    });

    fetch('./app/controllers/LocationsController.php')
        .then(response => response.json())
        .then(locations => {
            const buttonsContainer = document.getElementById("location-buttons");
            locations.forEach((loc, index) => {
                const marker = new google.maps.Marker({
                    position: { lat: loc.lat, lng: loc.lng },
                    map: map,
                    title: loc.name
                });

                markers.push(marker);

                const infoWindow = new google.maps.InfoWindow({
                    content: `
                        <div class="custom-info-window">
                            <h6>${loc.name}</h6>
                            <p>${loc.loca}</p>
                        </div>
                    `
                });
                

                marker.addListener("click", () => {
                    infoWindow.open(map, marker);
                });

                // Create button
                const btn = document.createElement("button");
                btn.innerText = loc.name + ": " + loc.loca;
                btn.className = "btn btn-light m-2 custom-info-window";
                btn.addEventListener("click", () => {
                    map.panTo({ lat: loc.lat, lng: loc.lng });
                    map.setZoom(17);
                });

                buttonsContainer.appendChild(btn);
            });
        })
        .catch(error => console.error("Error loading locations:", error));
};
