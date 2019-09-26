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
        if (status === 'OK') {
            console.log(results);
        }
    })
}

function initMap() {
    
}