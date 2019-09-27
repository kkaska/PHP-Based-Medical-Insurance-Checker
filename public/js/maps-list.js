// $(window).on('load', function () {
//
// })
function initMap() {
    let map = new google.maps.Map(document.getElementById('map'), {
        center: position,
        zoom: 9
    });
    $('.hospital-name').each(function () {
        let geocoder = new google.maps.Geocoder;
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