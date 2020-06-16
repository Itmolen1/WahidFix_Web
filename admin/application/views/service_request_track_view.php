<div class="content-wrapper">
    <?php //echo "<pre>";print_r($list);die; ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-map-marker"></i>Tracking
        <small>Live Tracking</small>
                    
      </h1>
    </section>
        <input type="hidden" name="sr_id" id="sr_id" value="<?php echo $sr_id; ?>">  
        <div id="map" class="content" style="height: 500px;"></div>  
      
</div>
<script>
  function initMap() {

    //////////
    map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 6
        });

    infoWindow = new google.maps.InfoWindow;

    if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('Location found.');
            infoWindow.open(map);
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }


        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }
    //////////
  var uluru = {lat: 21.2184872, lng: 72.8744373};
  
  // var map = new google.maps.Map(
  //   document.getElementById('map'), {zoom: 20, center: pos});  
  	
  	var mark;
	var lineCoords = [];
    var baseURL = '<?php echo base_url(); ?>';
    var hitURL = baseURL + "get_latest_cordinates";
    var data=$('#sr_id').val();
    //var data=1;
    var i=1;
    var ajax_call = function() {
        $.ajax({
        type : "POST",
        dataType : "json",
        url : hitURL,
        data : { data : data } 
        }).done(function(data){
            //alert(parseInt(i)+1);
            /*marker.setMap(null);
            var myLatlng = new google.maps.LatLng(data.service_track_latitude, data.service_track_longitude);
            marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
            });*/
			/*var redraw = function(payload) {
		      lat = payload.message.lat;
		      lng = payload.message.lng;

		      map.setCenter({lat:lat, lng:lng, alt:0});
		      mark.setPosition({lat:lat, lng:lng, alt:0});
		      
		      lineCoords.push(new google.maps.LatLng(lat, lng));

		      var lineCoordinatesPath = new google.maps.Polyline({
		        path: lineCoords,
		        geodesic: true,
		        strokeColor: '#2E10FF'
		      });
		      
		      lineCoordinatesPath.setMap(map);
		    };*/

		    

		    lat = parseFloat(data.service_track_latitude);
		    lng = parseFloat(data.service_track_longitude);
		    mark = new google.maps.Marker({position:{lat:lat, lng:lng}, map:map});
		    map.setCenter({lat:lat, lng:lng, alt:0});
		    mark.setPosition({lat:lat, lng:lng, alt:0});

		    lineCoords.push(new google.maps.LatLng(lat, lng));
		    //alert(lineCoords);
		    var lineCoordinatesPath = new google.maps.Polyline({
		        path: lineCoords,
		        geodesic: true,
		        strokeColor: '#FF0000',
          		strokeOpacity: 1.0,
          		strokeWeight: 2	
		      });

		    lineCoordinatesPath.setMap(map);
		    mark.setMap(null);
            console.log(data);                 
        });
    };

  var interval = 1000 * 60 * 1;
  setInterval(ajax_call, interval);
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAGn8-ISaUiBcrSyEaPvnklfQcPIJqCxIk&callback=initMap"
    async defer></script>
