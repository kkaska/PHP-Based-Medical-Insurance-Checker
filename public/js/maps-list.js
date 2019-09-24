function initMap() {
    let position = {lat: -34.397, lng: 150.644};

    let map = new google.maps.Map(document.getElementById('map'), {
        center: position,
        zoom: 8
    });

    let marker = new google.maps.Marker({
        position: position,
        map: map
    })
}