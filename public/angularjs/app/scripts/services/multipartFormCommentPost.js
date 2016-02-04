FirstApp.service("postService", [ '$http','$q', function($http,$q) {

  
	  /* PROBA SO IMAGE */
	 this.postComment = function(uploadUrl, data ) {
		  
		 var dfd=$q.defer();
		 var fd = new FormData();
		 /* podatocite od formata za postiranje na post */
		 for (var key in data){
			 //console.log('post data ' + key + ' data[key] ' + data[key]);
	        fd.append(key, data[key]); 
		 }
		
	      $http.post(uploadUrl, fd, {
	            transformRequest: angular.identity,
	            /* because angular tries to serialize our data, we don't wanna */
	            headers: {'Content-Type': undefined}
	        })
	        .success(function(response){
	        	console.log("success posted comment");
	        	dfd.resolve(response);
	        })
	        .error(function(){
	        	console.log("failure posted comment");
	        	dfd.reject();
	        });
	      return dfd.promise;
    }
  
  
}]);