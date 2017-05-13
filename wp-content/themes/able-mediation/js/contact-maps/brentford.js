function initialize() {	  
	
		
var myLatlng = new google.maps.LatLng(51.489035, -0.313383);
  var mapOptions = {
    zoom: 14,
    center: myLatlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  var map = new google.maps.Map(document.getElementById('brentford'), mapOptions);

  var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      title: 'Able Mediation: Brentford (Head Office)'
  });
  
  var contentString =
    '<div class="address">'+
    '<h1 class="able">'+'Able'+'</h1>'+'<h1 class="archive-title">'+' Mediation'+'</h1>'+
    '<ul>'+'<li>Brentford Office</li>'+'<li>The Mille</li>'+'<li>1000 Great West Road</li>'+'<li>Brentford</li>'+'<li>TW8 9DW</li>'+'</ul>'+
    '</div>';
	
	var infowindow = new google.maps.InfoWindow({
    content: contentString
});

google.maps.event.addListener(marker, 'mouseover', function() {
  infowindow.open(map,marker);
});
}
google.maps.event.addDomListener(window, 'load', initialize);