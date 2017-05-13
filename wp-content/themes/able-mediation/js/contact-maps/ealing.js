function initialize() {	  
	
		
var myLatlng = new google.maps.LatLng(51.51408, -0.300053);
  var mapOptions = {
    zoom: 14,
    center: myLatlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  var map = new google.maps.Map(document.getElementById('ealing'), mapOptions);

  var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      title: 'Able Mediation: Ealing Office'
  });
  
  var contentString =
    '<div class="address">'+
    '<h1 class="able">'+'Able'+'</h1>'+'<h1 class="archive-title">'+' Mediation'+'</h1>'+
    '<ul>'+'<li>Ealing Office</li>'+'<li>Saunders House</li>'+'<li>52-53 The Mall</li>'+'<li>Ealing</li>'+'<li>W5 3TA</li>'+'</ul>'+
    '</div>';
	
	var infowindow = new google.maps.InfoWindow({
    content: contentString
});

google.maps.event.addListener(marker, 'mouseover', function() {
  infowindow.open(map,marker);
});
}
google.maps.event.addDomListener(window, 'load', initialize);
	
