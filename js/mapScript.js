var userLatLng;
var map;
var latLngArray = [];
var infoWindowArray = [];
var titlesArray = [];
var directionsDisplay;
var directionsService;
var distanceMatrixService;
var userApprove = false;
var currentlyRoutingTo_index;
var coordinates;



function userLocate(){
    var options = {
        enableHighAccuracy : true,
        timeout : 2000,
        maximumAge : 5000
    };
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(function(callback){
            userApprove = true;
        },function (){
            userApprove = false;
        },options);
    } 
    else{ //case the users browser doesn't support geolocations
        userApprove = false;
    }
}

var getLocation = function (callback) {
    var options = {
        enableHighAccuracy : true,
        timeout : 2000,
        maximumAge : 5000
    };
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(function(position){
            coordinates={
                "latitude" : position.coords.latitude,
                "longitude" : position.coords.longitude
            };
            typeof callback === 'function' && callback(coordinates);
        },function (){},options);
    } 
    else{}
};

function initialize() {
        setUserPos(45.798785, 15.979095);
        userLocate();
        if(userApprove){
        getLocation(function (position) {
            document.getElementById("warnMe").className ="hidden";
            userLatLng = new google.maps.LatLng(position.latitude, position.longitude);
            // creating the map canvas
	    var mapCanvas = document.getElementById('map-canvas');
		var mapOptions = {
			center: userLatLng,
			zoom: 15,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		}
		map = new google.maps.Map(mapCanvas, mapOptions);
		
		// deleting not important parts of the map
		map.set('styles', [
		{
			featureType: 'poi',
			stylers: [{ visibility: 'off' }]
		},{
			featureType: "transit.station",
			stylers: [{ visibility: 'off'}]
		}
		]);
		
		// adding markers
		for	(index = 0; index < latLngArray.length; ++index) {
			addMarker(index);
		}
		var userMarker = new google.maps.Marker({
			position: userLatLng,
			map: map,
                        draggable: true,
			title: 'Vi ste ovdje',
			icon: 'images/user-icon.png'
		});
                google.maps.event.addListener(userMarker, "dragend", function (e) {
			userLatLng = userMarker.getPosition();
			findBestRoute();
                });
  
		// directions
		directionsService = new google.maps.DirectionsService();
		directionsDisplay = new google.maps.DirectionsRenderer({suppressMarkers: true});
		directionsDisplay.setMap(map);
		distanceMatrixService = new google.maps.DistanceMatrixService();
		findBestRoute();
        });}
        else{
            document.getElementById("warnMe").className ="";
            // creating the map canvas
	    var mapCanvas = document.getElementById('map-canvas');
		var mapOptions = {
			center: userLatLng,
			zoom: 15,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		}
		map = new google.maps.Map(mapCanvas, mapOptions);
		
		// deleting not important parts of the map
		map.set('styles', [
		{
			featureType: 'poi',
			stylers: [{ visibility: 'off' }]
		},{
			featureType: "transit.station",
			stylers: [{ visibility: 'off'}]
		}
		]);
		
		// adding markers
		for	(index = 0; index < latLngArray.length; ++index) {
			addMarker(index);
		}
		var userMarker = new google.maps.Marker({
			position: userLatLng,
			map: map,
                        draggable: true,
			title: 'Vi ste ovdje',
			icon: 'images/user-icon.png'
		});
                google.maps.event.addListener(userMarker, "dragend", function (e) {
			userLatLng = userMarker.getPosition();
			findBestRoute();
                });
  
		// directions
		directionsService = new google.maps.DirectionsService();
		directionsDisplay = new google.maps.DirectionsRenderer({suppressMarkers: true});
		directionsDisplay.setMap(map);
		distanceMatrixService = new google.maps.DistanceMatrixService();
		findBestRoute();
	}
    }
	
function success(position){
    setUserPos(position.coords.latitude, position.coords.longitude);
}

function error(position){
    setUserPos(45.798785, 15.979095);
}



function addMarker(index) {
                
		var marker = new google.maps.Marker({
			position: latLngArray[index],
			map: map,
			title: titlesArray[index],
			icon: 'images/parking-icon.png'
		});
                
		google.maps.event.addListener(marker, 'click', function() {
                    for (i = 0; i < infoWindowArray.length; ++i){ infoWindowArray[i].close();}
			infoWindowArray[index].open(map, marker);
		});
	}
	
function setUserPos(newLat, newLng) {
		userLatLng = new google.maps.LatLng(newLat, newLng);
	}
	
function addParking(newLat, newLng, title, text) {
		var newLatLng = new google.maps.LatLng(newLat, newLng);
		var index = latLngArray.length;
		latLngArray[index] = newLatLng;
		
		// crate infowindow
		displayText = '<div style="width: 250px; height: 150px;text-align:left; " id="content" >'+
		'<div id="siteNotice" >'+
		'<h5 id="firstHeading" class="firstHeading" style=\"color:black\">' + title + '</h5>'+
                '</div>'+
		'<div id="bodyContent">'+
		'<p style=\"color:black\">' +
		text +
		'<br/>' +
		'</p>'+
		'<button style="color:black; position: absolute; bottom: 0;" type="button" onClick="calcRoute(' + index + ')">Odaberi</button>' +
		'</div>'+
		'</div>';
                
		var infowindow = new google.maps.InfoWindow({
			content: displayText
		});
		infoWindowArray[infoWindowArray.length] = infowindow;
		titlesArray[titlesArray.length] = title;
	}
	
function calcRoute(index) {
        currentlyRoutingTo_index = index;
		var request = {
			origin: userLatLng,
			destination: latLngArray[index],
			travelMode: google.maps.TravelMode.DRIVING
		};
		
		directionsService.route(request, function(response, status) {
			if (status === google.maps.DirectionsStatus.OK) {
				directionsDisplay.setDirections(response);
			}
		});
	}
	
function findBestRoute(){
        distanceMatrixService.getDistanceMatrix(
        {
                origins: [userLatLng],
                destinations: latLngArray,
                travelMode: google.maps.TravelMode.DRIVING,
                avoidHighways: false,
                avoidTolls: false
        }, callback);
}
function callback(response, status) {
		if (status === google.maps.DistanceMatrixStatus.OK) {
			var origins = response.originAddresses;
			var from = origins[0];
			var destinations = response.destinationAddresses;
			var results = response.rows[0].elements; // we have only one origin
			
			var closestParkingIndex = 0;
			var shortestDistance = Number.MAX_VALUE;
			for (var j = 0; j < results.length; j++) {
				var element = results[j];
				var distance = element.distance.text;
				var duration = element.duration.text;
				var to = destinations[j];
				//alert("Od " + from + " do " + to + " je udaljenost " + distance + ". Za prijeci tu udaljenost potrebno je " + duration + ".");
				if (element.distance.value < shortestDistance){
					shortestDistance = element.distance.value;
					closestParkingIndex = j;
				}
			}
			
			calcRoute(closestParkingIndex);
		}
	}