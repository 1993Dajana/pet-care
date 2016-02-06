FirstApp.factory('profileService',['crudResource', '$q',
                             
       function(crudResource, $q) {

             return { 
            	 loadComments : function(userId){
            	
            		 console.log("servisot e povikan");
						var dfd = $q.defer();
						
						var param = {
								id: userId
							};
						
						
						crudResource.getCommentsForUser(param,
								function successs (response){
									
									console.log("gi imam komentarite" + response);
									dfd.resolve(response);
								},
								function failure (error){
									console.log("greshka pri zemanje na komentarite od sevis crudResource")
									dfd.reject(error);
								}
								
						);
						
						return dfd.promise;
					}
					
					
					
             };
}]);