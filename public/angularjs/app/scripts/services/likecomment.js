FirstApp.service("likecomment", [ 'crudResource' , '$q', '$resource',
                                   
        function(crudResource, $q, $resource ) {

		
	
		
		/* ova se povikuva na sekoj reload */
		this.like = function(post){
			
			var dfd = $q.defer();
			var Post = $resource('/petCareWeb/posts/like');
			
			// Create an instance of User resource
			var result = Post.save(post, function succ(response){
					
				console.log("Like successfully added");
		
	      //     console.log('response is ' + response.status);
				dfd.resolve(response);
				
			}, function err(error){ 
				 console.log('error is '  + error.status);
				dfd.reject(error);
			});
			
			
			return dfd.promise;
			
		}
		
		this.comment = function(commentData){
			
			
			var dfd = $q.defer();
			
			var Comment = $resource('/petCareWeb/post/comment');
			
			// Create an instance of User resource
			var result = Comment.save(commentData, function succ(response){
					
				console.log("Reply successfully added");
		
	      //     console.log('response is ' + response.status);
				dfd.resolve(response);
				
			}, function err(error){ 
				 console.log('error is '  + error.status);
				dfd.reject(error);
			});
			
			
			return dfd.promise;
		}

		this.getLikedPosts = function(){
			
			var dfd = $q.defer();
			crudResource.getLikedPosts(
					function success(response){
						dfd.resolve(response);
					},
					function failure(reason){
						dfd.reject(reason);
					}
					
			);
			
			return dfd.promise;
			
		}
		
		
	
		
		
}]);