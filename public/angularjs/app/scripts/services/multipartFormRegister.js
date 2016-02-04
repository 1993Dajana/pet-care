FirstApp.service("registerService", [ '$http', '$q', function($http, $q) {

  
	  /* PROBA SO IMAGE */
	 this.register = function(uploadUrl, data ) {
		  
		 var dfd = $q.defer();
		 var fd = new FormData();
		 /* podatocite od formata za registracija */
		 for (var key in data){
			 console.log('data ' + key + ' data[key] ' + data[key])
	        fd.append(key, data[key]); 
		 }
	 
	      $http.post(uploadUrl, fd, {
	            transformRequest: angular.identity,
	            /* because angular tries to serialize our data, we don't wanna */
	            headers: {'Content-Type': undefined}
	           
	        })
	        .success(function(response){
	        	dfd.resolve(response);
	        	console.log("success register " + response.$status);
	        })
	        .error(function(error){
	        	dfd.reject(error);
	        	console.log("failure register");
	        });
	      
	      return dfd.promise;
    }
  
  
}]);