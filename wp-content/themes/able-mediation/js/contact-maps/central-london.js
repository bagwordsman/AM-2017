function initialize() {	  
	
		
var myLatlng = new google.maps.LatLng(51.495218, -0.225818);
  var mapOptions = {
    zoom: 14,
    center: myLatlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  var map = new google.maps.Map(document.getElementById('central-london'), mapOptions);

  var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      title: 'Able Mediation: Central London Office'
  });
  
  var contentString =
    '<div class="address">'+
    '<h1 class="able">'+'Able'+'</h1>'+'<h1 class="archive-title">'+' Mediation'+'</h1>'+
    '<ul>'+'<li>Central London Office</li>'+'<li>26-28 Hammersmith Grove</li>'+'<li>London</li>'+'<li>W6 7BA</li>'+'</ul>'+
    '</div>';
	
	var infowindow = new google.maps.InfoWindow({
    content: contentString
});

google.maps.event.addListener(marker, 'mouseover', function() {
  infowindow.open(map,marker);
});
}
google.maps.event.addDomListener(window, 'load', initialize);