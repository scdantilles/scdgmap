<div id="scdmap" style="width: 100%; height: 400px;"></div>

<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
<script type="text/javascript">
  var locations = [
    <?php
    foreach($libraries as $lib) {
      echo "['" . $lib['name'] . "', " . $lib['lat'] . ", " . $lib['lon'] . "],";
    }
    ?>
  ];

  var bounds = new google.maps.LatLngBounds();

  var map = new google.maps.Map(document.getElementById('scdmap'), {
    zoom: 10,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });

  var infowindow = new google.maps.InfoWindow();

  var marker, i;

  for (i = 0; i < locations.length; i++) {

    var position = new google.maps.LatLng(locations[i][1], locations[i][2]);

    bounds.extend(position);

    marker = new google.maps.Marker({
      position: position,
      map: map
    });

    google.maps.event.addListener(marker, 'click', (function(marker, i) {
      return function() {
        infowindow.setContent(locations[i][0]);
        infowindow.open(map, marker);
      }
    })(marker, i));

    map.fitBounds(bounds);
  }
</script>
