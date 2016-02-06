/**
 * @ngdoc here we are configuring the module exposed through the FirstApp
 *        variable. The method receives an array that has a function as a last
 *        argument. Here, the angular inject the dependencies defined as strings
 *        in the array to the corresponding elements in the function. <br/> The
 *        $routeProvider is used to configure the routes. It maps templateUrl
 *        and optionally a controller to a given path. This is used by the
 *        ng-view directive. It replaces the content of the defining element
 *        with the content of the templateUrl, and connects it to the controller
 *        through the $scope.
 * @see https://docs.angularjs.org/guide/di
 */
 'use strict';
FirstApp

		.config([ '$routeProvider', '$compileProvider', '$httpProvider',function($routeProvider, $compileProvider, $httpProvider) {

			delete $httpProvider.defaults.headers.common['X-Requested-With'];
			$compileProvider.aHrefSanitizationWhitelist(/^\s*(https?|ftp|mailto|file|skype):/);
		
			
			console.log("config");
			$routeProvider.when('/angular', {
				templateUrl : 'views/welcome.html',
				controller : 'WelcomeController',
				auth : 'GUEST'
			});

// 			/* GRESHKA SO /404 PROVERI BESHE GUEST_USER */
// 			$routeProvider.when('/404', {
// 				templateUrl : '404.html',
// 				auth : 'USER'
// 			});

// 			$routeProvider.when('/login', {

// 				templateUrl : 'views/login.html',
// 				controller : 'LoginController',
// 				auth : 'GUEST'
// 			});
// 			$routeProvider.when('/register', {

// 				templateUrl : 'views/register.html',
// 				controller : 'RegisterController',
// 				auth : 'GUEST'
// 			});

// 			$routeProvider.when('/home', {

// 				templateUrl : 'views/home.html',
// 				controller: 'HomeController',
// 				auth : 'USER'
// 			});
			
// 			$routeProvider.when('/profile', {

// 				templateUrl : 'views/profile.html',
// 				controller: 'ProfileController',
// 				auth : 'USER'
// 			});
			
// 			$routeProvider.when('/tips', {

// 				templateUrl : 'views/TipsPetcare.html',
// 				controller: 'tipsController',
// 				auth : 'USER'
// 			});
			
			
// 			$routeProvider.when('/proba', {

// 				templateUrl : 'views/probi.html',
// 				auth : 'USER'
// 			});

// //			uiGmapGoogleMapApiProvider.configure({
// //				 key: 'AIzaSyA_BDNP4tTFTBGo0iCRhFePgnYNz2GL3xM',
// //				v: '3.17',
// //				libraries: 'places' // Required for SearchBox.
// //			});
// 		} ])

// 		.run(
// 				[
// 						'$rootScope',
// 						'crudResource',
// 						'$q',
// 						'$route',
// 						'$location',
// 						'LoginService',
// 						'$cookieStore',
// 						'likecomment',
// 						function($rootScope, crudResource, $q, $route,
// 								$location, LoginService, likecomment) {
// 							/*onunload ; onbeforeunload */
// 							/*
// 							 * na sekoe refreshiranje na stranata se povikuva
// 							 * ova
// 							 */
// //							
// //							$rootScope.listLikes = [];
// //							
// //							function applyLikes(){
// //								
// //								for (var int = 0; int < $rootScope.listLikes.length; int++) {
// //									likecomment.like($rootScope.listLikes[int]).then(
// //											function succ(response){
// //												console.log('success');
// //											},
// //											function fail(error){
// //												console.log('error');
// //											}
// //									
// //									);
// //								}
// //							}
// //							
// //							applyLikes();
							
// 							$rootScope.user = {};
// //							
// 							$rootScope.appReady = false;
							
// 							function authenticate (){
								
// 								console.log('auth');
// 								var dfd = $q.defer();
// 								crudResource.auth(

// 										function success(response) {
											
											
// 											if (response.$status === 200) {
// 												/* ok */
// 												console.log("--------++------"+ response.$status);
// //						    					
// 						    					LoginService.forceLoggedUser();
// 											} else {
// 												/* handlame validacija */
// //												$rootScope.logged = false;
// 												LoginService.forceGuest();
// 												console.log("--------++------"+ response.$status);
// 											} 
											
											
											
// 											dfd.resolve(response);
// 										},
										
// 										function failure(error){
// 											console.log("failure");
// 											$rootScope.logged = false;
// 									dfd.reject(error);
// 								});
// 								$rootScope.appReady =true;
// 								return dfd.promise;
// 							 }

// 							authenticate();

// 							var history = [];

// 						    $rootScope.$on('$routeChangeSuccess', function() {
// 						        history.push($location.$$url);
// 						    });

						    
// 							$rootScope.$on("$locationChangeStart",function(event, next) {
// //												alert("are you sure ? ");
// 												/*
// 												 * OVA E ZA PROFIL EDEN KOGA KJE
// 												 * IMAME: ../#/profiles/id_numb
// 												 */
									
// 									LoginService.checkSession();
// 									var location = $location.url();
									
// 									console.log('location is: '
// 											+ location);
									
								
											
// 												if (angular.isDefined($route.routes[location])) {

// 													switch ($rootScope.logged) {
// 													case undefined:{
// 														/* smeneto */
// 														$rootScope.logged = false;
// 														console.log('logged undefined');
// 													}
// 													case false:{
// 														/* imame guest */
// 														console.log('logged false');
// 														if($route.routes[location].auth === 'USER'){
														
// 															console.log('ne sum logiran i nemam pristap');
// 														//	event.preventDefault();
// 															$location.url('/login');
// 															console.log('preventirano');
// 														} else {
// 															console.log('ne sum logiran ama imam pristap');
// 														}
// 														break;
// 													}
// 													case true:{
// 														console.log('logged true');
// 														/* imame logiran user */
// 														if($route.routes[location].auth === 'GUEST'){
// 															console.log('logiran sum ama nemam pristap');
// 															console.log('mojata lokacija e: ' + $location.path() + " a sakam da pristapam na  " + next);
// 														if(history.length === 0){
// 															$location.url('/home');	
// 														} else{
// 															event.preventDefault();
// 														}
// //															event.preventDefault();
// 															console.log('url-to sega e: ' + $location.url());
// //															$location.url('/home')
// 														} else {
// 															console.log('logiran sum i imam pristap');
// 														}
// 														break;
// 													}
														
														

// 													default:{
// 														console.log('default');
// 														/* smeneto vo neshto drugo od user-ot, togash kje go odlogirame */
// 														LoginService.logout(); // prevencija
// 														if($route.routes[location].auth === 'USER'){
															
// 															console.log('smeneto cookie, vrati go na false');
// 														//	event.preventDefault();
// 															$location.url('/login');
// 															console.log('preventirano');
// 														} else {
// 															console.log('ne sum logiran ama imam pristap');
// 														}
// 														break;
														
// 													}
														
// 													}
													
// 												} else {
// 													console.log('error');
// 													$location.url('/404');
// 												}
											
										

												

// 											});

						} ])
						
						
				.filter('reverse', function() {
					  return function(items) {
						    return items.slice().reverse();
						  };
				});
