$('#location').click(function(){
    navigator.geolocation.getCurrentPosition(function(position) {
        store(position.coords.latitude, position.coords.longitude);
      });
    
});

function store (lat, lng) {
    // make this store variables to pass to results page
 alert(lat + ', ' +lng);
}