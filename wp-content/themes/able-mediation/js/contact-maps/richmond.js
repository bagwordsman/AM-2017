function initialize() {	  
	
		
var myLatlng = new google.maps.LatLng(51.462874, -0.302187);
  var mapOptions = {
    zoom: 14,
    center: myLatlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  var map = new google.maps.Map(document.getElementById('richmond'), mapOptions);

  var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      title: 'Able Mediation: Richmond Office'
  });
  
  var contentString =
    '<div class="address">'+
    '<h1 class="able">'+'Able'+'</h1>'+'<h1 class="archive-title">'+' Mediation'+'</h1>'+
    '<ul>'+'<li>Richmond Office</li>'+'<li>Gainsborough House</li>'+'<li>2 Sheen Road</li>'+'<li>Richmond</li>'+'<li>TW9 1AE</li>'+'</ul>'+
    '</div>';
	
	var infowindow = new google.maps.InfoWindow({
    content: contentString
});

google.maps.event.addListener(marker, 'mouseover', function() {
  infowindow.open(map,marker);
});
}
google.maps.event.addDomListener(window, 'load', initialize);