$('#location').click(function(){
    navigator.geolocation.getCurrentPosition(function(position) {
        store(position.coords.latitude, position.coords.longitude);
      });
    
});

function store (lat, lng) {
    $('#user-latitude').val(lat);
    $('#user-longitude').val(lng);
    let geocoder = new google.maps.Geocoder;
    let location = {lat: lat, lng: lng};
    geocoder.geocode({'location' : location}, function (results, status) {
        if (status === 'OK' && results[0]) {
            let components = results[0].address_components;
            for (var i = 0; i < components.length; i++) {
                if (jQuery.inArray('postal_town', components[i].types) > -1) {
                    $('#city').val(components[i].long_name);
                    break;
                }
            }
            if (!$('#city').val()) {
                alert('Unable to determine location. Please try inputting it manually.');   // todo: use bootstrap
            }
        } else {
            alert('An error occurred when trying to find your location. Please try again, or input a city manually.'); // todo: use bootstrap
        }
    })
}

function initMap() {
    
}