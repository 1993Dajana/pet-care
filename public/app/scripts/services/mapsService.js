
FirstApp.service('Map', function () {
    
	
    this.init = function(lat, lng) {
    	
    	console.log('init in service');
    console.log('and lat and lng are ' + lat + ' ' + lng);
    	var options = {
        		
            center: new google.maps.LatLng(lat, lng),
            zoom: 15,
            disableDefaultUI: true    
        }
        this.map = new google.maps.Map(
            document.getElementById("map"), options
        );
        console.log('document is ' + document.getElementById("map").id);
    	
    	var marker = new google.maps.Marker({
            position:  new google.maps.LatLng(lat, lng),
            map: this.map,
            title: 'Hello World!'
          });
        
        marker.setMap(this.map);
        
        this.places = new google.maps.places.PlacesService(this.map);
    }
    
   
});


