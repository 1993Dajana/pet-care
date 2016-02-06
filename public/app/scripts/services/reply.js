FirstApp.service("reply", [ 'crudResource' , '$q',  '$resource',
                                   
                                   function(  crudResource, $q, $resource ) {
	
		this.getReplies = function(id){
			/* id e post id */
			
			var dfd = $q.defer();
			
			console.log('id-to e ' + id);
			var reply = $resource('/petCareWeb/post/comments/:postId', {postId:'@id'});
			// Create an instance of User resource
			var response = reply.get({postId:id}, 
					function success(response){
			//		console.log('response of replies is ' + response.comment[0].message);
					dfd.resolve(response);
				},
				
					function failure(reason){
					dfd.reject(reason);
				}
			);	
			
			return dfd.promise;
			
			
		}
		
}]);