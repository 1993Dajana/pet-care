FirstApp.factory('homeService',['crudResource', '$q', 'likecomment',
                             
       function(crudResource, $q, likecomment) {

             return { 
					loadComments : function(){
						
						var dfd = $q.defer();
						crudResource.getComments(
								function successs (response){
									
									dfd.resolve(response);
								},
								function failure (error){
									
									dfd.reject(error);
								}
								
						);
						
						return dfd.promise;
					},
					
					getUser: function(){
						var dfd=$q.defer();
						crudResource.auth(
								function success(response){
									
									dfd.resolve(response);
								},
								function failure(error){
									dfd.reject(error);
								}
					);
					return dfd.promise;
             },
					
					post: function(comment){
						
						var dfd = $q.defer();
						/* with utf-8 message transfer encoding */
//						new String (s.getBytes ("iso-8859-1"), "UTF-8");
//						$scope.comment.message = ($scope.comment.message.getBytes("iso-8859-1"), "UTF-8");
//						console.log('comment message is: ' + $scope.commnet.message);
						crudResource.postComment(comment,
								function successs (response){
									
									dfd.resolve(response);
								},
								function failure (error){
									
									dfd.reject(error);
								}
								
						);
						
						return dfd.promise;
					},
					
					setFlagsLikes : function(comments){
						/* ne ni treba */
						var listFlags = [];
						var result = true;
						
						for (var int = 0; int < comments.length; int++) {
							console.log("comment id is " + comments[int].id);
							result = likecomment.checkLike(comments[int].id).then(
									function succ(response){
										console.log('smee da lajkne: ' + response);
										listFlags.push(result);
									},
									function failure(error){
										console.log('error');
									}
							);
						
						}
						
						return listFlags;
					}
					
					
					
					
             };
}]);