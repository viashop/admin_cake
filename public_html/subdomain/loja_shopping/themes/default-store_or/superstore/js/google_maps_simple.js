var geocoder;
var map;

function initialize() {
    geocoder = new google.maps.Geocoder();
    var address = query;
    geocoder.geocode({
        'address': address
    }, function(results, status) {
        var mapOptions = {
            zoom: 14,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);

        if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location
            });
        } else {
            document.getElementById('map_canvas').remove();
        }
    });
}

initialize();