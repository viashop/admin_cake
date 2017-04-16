/* Mostra Mapa - BEGIN */
var geocoder;
var map;

function initialize() {
    var zomm = uzomm;
    geocoder = new google.maps.Geocoder();
    var myOptions = {
        zoom: zomm,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    codeAddress();
}

function codeAddress() {
    var address = query;
    geocoder.geocode({
        'address': address
    }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location
            });
        }
    });
}