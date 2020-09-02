	var x = document.getElementById("localizacao");
	var latitudeuser = $('#latitude').html();
	var longitudeuser = $('#longitude').html();
	
	$('.name-like').each(function(){
		var latitudecrush = $(this).find('#latitudecrush').html();
		var longitudecrush = $(this).find('#longitudecrush').html();
		var distancia = getDistanceFromLatLonInKm(latitudeuser,longitudeuser,latitudecrush,longitudecrush);
		//alert(distancia);
		$('.name-like p:nth-of-type(2)').html('Distância: '+distancia+' Km');
	})

	function getLocation(){
	  if (navigator.geolocation) {
	    navigator.geolocation.getCurrentPosition(showPosition);
	  }else{ 
	    x.innerHTML = "O sistema de localização não é suportada por este navegador.";
	  }

	}

	function showPosition(position){
	  x.innerHTML = "<p>Latitude: " + position.coords.latitude+"</p>"+ 
	  "<p>Longitude: " + position.coords.longitude+"</p>";
	  //console.log(getDistanceFromLatLonInKm(position.coords.latitude,position.coords.longitude,-27.441564,-48.491754));
	  $.ajax({
	  	url:'ajax/coordenadas.php',
	  	method:'post',
	  	data:{'latitude':Math.round(position.coords.latitude * 100) / 100,'longitude':Math.round(position.coords.longitude * 100) / 100}
	  })
	}

	function getDistanceFromLatLonInKm(lat1,lon1,lat2,lon2){
	  var R = 6371; // Radius of the earth in km
	  var dLat = deg2rad(lat2-lat1);  // deg2rad below
	  var dLon = deg2rad(lon2-lon1); 
	  var a = 
	    Math.sin(dLat/2) * Math.sin(dLat/2) +
	    Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
	    Math.sin(dLon/2) * Math.sin(dLon/2)
	    ; 
	  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
	  var d = R * c; // Distance in km
	  return d;
	}

	function deg2rad(deg){
	  return deg * (Math.PI/180)
	}