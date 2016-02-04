FirstApp.service("mail", [ '$http' , '$q', 
                                   
                                   function( $http, $q) {

	
	this.sendMail = function(mailJSON){
		  var apiURL = "https://mandrillapp.com/api/1.0/messages/send.json";
		    $http.post(apiURL, mailJSON).
		      success(function(data, status, headers, config) {
//		        alert('successful email send.');
		        $scope.form={};
		        console.log('successful email send.');
		        console.log('status: ' + status);
		        console.log('data: ' + data);
		        console.log('headers: ' + headers);
		        console.log('config: ' + config);
		      }).error(function(data, status, headers, config) {
		        console.log('error sending email.');
		        console.log('status: ' + status);
		      });
	}
}]);