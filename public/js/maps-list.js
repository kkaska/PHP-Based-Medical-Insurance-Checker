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
    let userPosition = {lat: lat, lng: lng};

    let map = new google.maps.Map(document.getElementById('map'), {
        center: userPosition,
        zoom: 10
    });

    let infoWindow = new google.maps.InfoWindow({
        content: null
    });

    let userMarker = new google.maps.Marker({
        map: map,
        position: userPosition,
        icon: "../img/current-location.png",
        title: "Your Current Location"
    });

    userMarker.addListener('click', function () {
        infoWindow.setContent('<div><h5>Your Current Location</h5></div>');
        infoWindow.open(map, userMarker);
    });

    $('.hospital-data').each(function () {
        let hospitalAddress = $(this).data('hospital-address');
        let hospitalPostCode = $(this).data('hospital-postcode');
        let hospitalName = $(this).find('.hospital-name').text();
        let city = $(this).find('.hospital-city').text();
        let address = hospitalName + ' ' + hospitalAddress + ' ' + city;
        let distance = $(this).find('.distance').text();

        geocoder.geocode({'address' : address}, function (results, status) {
            if (status === 'OK') {
                let marker = new google.maps.Marker({
                    map: map,
                    position : results[0].geometry.location,
                    title: hospitalName,
                    icon: "../img/hospital-location.png"
                });

                // The opening infoWindow and highlighting of table row event
                let event = function () {
                    infoWindow.setContent(getInfoWindowHTML(hospitalName, hospitalAddress, city, hospitalPostCode, distance));
                    infoWindow.open(map, marker);
                    $('.hospital-data').removeClass('bg-primary text-dark');
                    $('[data-hospital-address="' + hospitalAddress + '"]').addClass('bg-primary text-dark');

                    // Need this otherwise the highlight remains if the user closes the infowindow.
                    infoWindow.addListener('closeclick', function () {
                        $('.hospital-data').removeClass('bg-primary text-dark');
                    });
                }

                // Apply the same click event to both the row and the map marker
                $('[data-hospital-address="' + hospitalAddress + '"]').click(event);
                marker.addListener('click', event);
            }
        });
    });
}

//make this function retrieve an html file and fill it out
function getInfoWindowHTML(hospitalName, address, city, postCode, distance) {
    return "<div class='container text-center'>" +
                "<a href='#'><h5 class='firstHeading'>" + hospitalName + "</h5></a>" +      //TODO: Link this to the view for the selected hospital
                    "<div id='bodyContent'>" +
                        "<p><strong class='text-info'>Address: </strong>" + address + "</p>" +
                        "<p><strong class='text-info'>City: </strong>" + city + "</p>" +
                        "<p><strong class='text-info'>Zip Code: </strong>" + postCode + "</p>" +
                        "<p><strong class='text-info'>Distance: </strong>" + distance + "</p>" +
                    "</div>" +
                "</div>" +
            "</div>";
}
