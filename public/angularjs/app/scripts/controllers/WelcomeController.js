FirstApp.controller('WelcomeController', ['$scope', '$location','$route','anchorSmoothScroll','$document',
    function($scope, $location,$route,anchorSmoothScroll,$document) {
    
	 
	$scope.comment = {};
	
	$scope.redirectLogin = function(){

		$location.path('/login');
	};
	
	$scope.redirectRegister = function(){

		$location.path('/register');
	};
	
	$scope.scroll = function() {
	$document.scrollTopAnimated(400).then(function() {
	      console && console.log('You just scrolled to the top!');
	    });
	}
	$scope.scrollToServices=function(){

	    var someElement = angular.element(document.getElementById('services'));
	    $document.scrollToElementAnimated(someElement);
	};
	$scope.scrollToAbout=function(){

	    var someElement = angular.element(document.getElementById('about'));
	    $document.scrollToElementAnimated(someElement);
	};
	$scope.scrollToContact=function(){

	    var someElement = angular.element(document.getElementById('contact'));
	    $document.scrollToElementAnimated(someElement);
	};
	$scope.scrollToTop=function(){

	    var someElement = angular.element(document.getElementById('wellcomepage'));
	    $document.scrollToElementAnimated(someElement);
	};
	

}
]);
