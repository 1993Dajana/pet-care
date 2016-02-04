FirstApp.service("nearBy", [ '$q', '$rootScope', '$resource','$http', 'crudResource',
                                   
                                   function($q, $rootScope, $resource,$http, crudResource) {
	
	this.retrivePetStores = function(loc){
		
		var dfd = $q.defer();
	console.log('my location is ' + loc.lat);

//		 
		var JSON = $resource('https://maps.googleapis.com/maps/api/place/nearbysearch/json?location='+ loc.lat + '%2C' + loc.lng + '&radius=500&types=pet_store&key=AIzaSyA_BDNP4tTFTBGo0iCRhFePgnYNz2GL3xM');
		
		var result = JSON.get(
			function success (response){
				
				dfd.resolve(response);
			},
			
			function failure (reason){
				
				dfd.reject(reason);
			}
		);
		

		
		return dfd.promise;
	}
	
	
	function getLocation() {
	    if (navigator.geolocation) {
	        navigator.geolocation.getCurrentPosition(showPosition);
	    } else { 
	        console.log('geolocation not provided');
	    }
	}

	function showPosition(position) {
		   $scope.location = {
				   lat : position.coords.latitude,
				   lng :position.coords.longitude
			   }
	  
	}
	
	 this.current = function(){
		 
		getLocation();
     }
	 
	 
this.retrivePharmacies = function(loc){

		
		var dfd = $q.defer();
	console.log('my location is ' + loc.lat);

//		 
		var JSON = $resource('https://maps.googleapis.com/maps/api/place/nearbysearch/json?location='+ loc.lat + '%2C' + loc.lng + '&radius=500&types=pharmacy&key=AIzaSyA_BDNP4tTFTBGo0iCRhFePgnYNz2GL3xM');
		
		var result = JSON.get(
			function success (response){
				
				dfd.resolve(response);
			},
			
			function failure (reason){
				
				dfd.reject(reason);
			}
		);
		

		
		return dfd.promise;
	}
	

this.retriveParks = function(loc){

	
	var dfd = $q.defer();
console.log('my location is ' + loc.lat);

//	 
	var JSON = $resource('https://maps.googleapis.com/maps/api/place/nearbysearch/json?location='+ loc.lat + '%2C' + loc.lng + '&radius=500&types=park&key=AIzaSyA_BDNP4tTFTBGo0iCRhFePgnYNz2GL3xM');
	
	var result = JSON.get(
		function success (response){
			
			dfd.resolve(response);
		},
		
		function failure (reason){
			
			dfd.reject(reason);
		}
	);
	

	
	return dfd.promise;
}

this.retriveVet = function(loc){

	
	var dfd = $q.defer();
console.log('my location is ' + loc.lat);

//	 
	var JSON = $resource('https://maps.googleapis.com/maps/api/place/nearbysearch/json?location='+ loc.lat + '%2C' + loc.lng + '&radius=500&types=veterinary_care&key=AIzaSyA_BDNP4tTFTBGo0iCRhFePgnYNz2GL3xM');
	
	var result = JSON.get(
		function success (response){
			
			dfd.resolve(response);
		},
		
		function failure (reason){
			
			dfd.reject(reason);
		}
	);
	

	
	return dfd.promise;
}
 
}]);