function initMap() {
    let geocoder = new google.maps.Geocoder;

    //Determine the center position of the map

    //If no user-defined exact position, use the input City or default to the center of the USA
    if (position.lat === null || position.lng === null) {
        let searchParams = new URLSearchParams(window.location.search);
        if (searchParams.has('city')) {
            geocoder.geocode({'address' : searchParams.get('city')}, function (results, status) {
               if (status === 'OK') {
                   let lat = results[0].geometry.location.lat();
                   let lng = results[0].geometry.location.lng();
                   loadMap(lat, lng);
               } else {
                   // Center of USA
                   let lat = 38;
                   let lng = -97;
                   loadMap(lat, lng);
               }
            });
        } else {
            let lat = 38;
            let lng = -97;
            loadMap(lat, lng);
        }
    } else {
        loadMap(position.lat, position.lng);
    }
}

function loadMap(lat, lng) {
    let geocoder = new google.maps.Geocoder;

    let map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: lat, lng: lng},
        zoom: 9
    });

    $('.hospital-name').each(function () {
        geocoder.geocode({'address' : $(this).text()}, function (results, status) {
            if (status === 'OK') {
                var marker = new google.maps.Marker({
                    map: map,
                    position : results[0].geometry.location
                })
            }
        })
    })
}