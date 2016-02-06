FirstApp.service("LoginService", [ 'crudResource' , '$q', '$rootScope', '$cookieStore', 
                                   '$cookies', 'registerService',
                                   
                                   function(  crudResource, $q, $rootScope, $cookieStore, $cookies, registerService) {

	// $q - A service that helps you run functions asynchronously, and use their return values (or exceptions) when they are done processing.
  
	
	
	var self = this;
	
	this.register = function(uploadUrl, data){
		var dfd = $q.defer();
		registerService.register(uploadUrl, data).then(
				function success(response){
					/**/
					console.log('im registered in ' + response);
					dfd.resolve(response);
				},
				function failure(error){
					console.log('failure during registration');
				
					dfd.reject(error);
				}
			
		);
		
		return dfd.promise;
	}
	
    this.login = function(userLoginData) {
    	
    	var deferred = $q.defer();
    	
    	crudResource.login(userLoginData,
    			
				function success(response){
					
    				//alert("user login data: " + response.token);
    				if (response.$status === 200) {
						/* ok */
    				
    					$cookieStore.put("logged", true);
    					$rootScope.logged = true;
					} else {
						/* handlame validacija */
						$cookieStore.put("logged", false);
						$rootScope.logged = false;
					}
					/* TODO remove */
					deferred.resolve(response);
					
				},function failure(error){
					
//					alert("user login data error.");
					deferred.reject(error);
					
				});
    	
			return deferred.promise;
		   	
    };
  
    
    this.logout = function(){
    	
    	var deferred = $q.defer();
    	
    	crudResource.logout(
    			
				function success(response){
					console.log("succesfully logged out");
					$rootScope.logged = false;
					$cookieStore.put("logged", false);
			
					deferred.resolve(response);
				},function failure(error){
					console.log("error logging out");
					deferred.reject(error);
				});
			return deferred.promise;

    	
    };
    
    

this.checkSession = function(){
	$rootScope.logged = $cookieStore.get('logged');
}
    

this.clearSession = function(){
	$rootScope.logged = false;
	$cookieStore.put('logged', $rootScope.logged);
}

this.forceLoggedUser = function(){
	$rootScope.logged = true;
	$cookieStore.put('logged', true);
}

this.forceGuest = function(){
	$rootScope.logged = false;
	$cookieStore.put('logged', false);
}
 
}]);