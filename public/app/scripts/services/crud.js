FirstApp.service('crudResource', ['$resource', 
	function($resource){

		
		var BASEURL = 'http://localhost:8000/';

		return $resource(BASEURL + ':service/:action/:id',
		{  
			id: '@id'
		},
		{
			login: {

				method:'POST',
				params:{
					service:'auth'
				},
				 interceptor: {
			            response: function(response) {      
			                var result = response.resource;        
			                result.$status = response.status;
			                console.log('status is ' + result.$status);
			                console.log('status is ' + response.status);
			                
			                return result;
			            },
			            error: function(error){
			            	var result = error.resource;        
			                result.$status = error.status;
			                return result;
			            }
			        }
			},
			
			getUser:{
				
				method:'GET',
				params:{
					service:'userDetails',
				
				}
			},
			
			logout:{
				
				method:'GET',
				params:{
					service:'j_spring_security_logout'
				}
			},
			
			auth:{
				method:'GET',
				params:{
					service:'authentication'
				},
				 interceptor: {
			            response: function(response) {      
			                var result = response.resource;        
			                result.$status = response.status;
			                return result;
			            },
			            error: function(error){
			            	var result = error.resource;        
			                result.$status = error.status;
			                return result;
			            }
			        }
			},
			
			getComments:{
				method:'GET',
				params:{
					service:'posts',
					action: 'get'
					
				}
			},
			getLikedPosts:{
				method:'GET',
				params:{
					service:'posts',
					action: 'liked'
				}
			},
			comment:{
				method:'POST',
				params:{
					service:'post',
					action:'comment'
				}
			},
			getReplies:{
				method:'GET',
				params:{
					service:'post',
					action:'comments'
				}
			},
			nearBy:{
				method:'GET',
				params:{
					service:'nearby'
				}
			}
			
			
			
			
		});


}]);