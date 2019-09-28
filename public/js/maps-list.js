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

    let infoWindow = new google.maps.InfoWindow({
        content: null
    });

    $('.hospital-data').each(function () {
        let hospitalAddress = $(this).data('hospital-address');
        let hospitalPostCode = $(this).data('hospital-postcode');
        let hospitalName = $(this).find('.hospital-name').text();
        let city = $(this).find('.hospital-city').text();
        let address = hospitalName + ' ' + hospitalAddress + ' ' + city;

        geocoder.geocode({'address' : address}, function (results, status) {
            if (status === 'OK') {
                let marker = new google.maps.Marker({
                    map: map,
                    position : results[0].geometry.location,
                    title: hospitalName
                });

                marker.addListener('click', function () {
                    infoWindow.setContent(getInfoWindowHTML(hospitalName, hospitalAddress, city, hospitalPostCode));
                    infoWindow.open(map, marker);
                })
            }
        });
    });
}

//make this function retrieve an html file and fill it out
function getInfoWindowHTML(hospitalName, address, city, postCode) {
    return "<div class='container text-center'>" +
                "<h5 class='firstHeading'>" + hospitalName + "</h5>" +
                    "<div id='bodyContent'>" +
                        "<p><strong class='text-info'>Address: </strong>" + address + "</p>" +
                        "<p><strong class='text-info'>City: </strong>" + city + "</p>" +
                        "<p><strong class='text-info'>Post Code: </strong>" + postCode + "</p>" +
                    "</div>" +
                "</div>" +
            "</div>";
}