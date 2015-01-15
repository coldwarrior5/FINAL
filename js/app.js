/**
 * AngularJS module to process a form.
 * 
 * 
 */
var app = angular.module('myApp', ['ajoslin.promise-tracker']);



app.controller('Peek',function($scope, $window, $http, $log, promiseTracker, $timeout){
    $scope.subjectListOptions = {
      'bug': 'Report a Bug',
      'account': 'Account Problems',
      'mobile': 'Mobile',
      'user': 'Report a Malicious User',
      'other': 'Other'
    };
    

    // Inititate the promise tracker to track form submissions.
    $scope.progress = promiseTracker();
    $scope.toShow=false;
    $scope.init = function(inputVariable){
        $scope.toShow=inputVariable;
    };
    
	//R
	
	   function reverse(s) {
        var o = '';
        var splitted = s.split("/");
        for (var i = splitted.length - 1; i >= 0; i--){
          if(i === 0){
              o += splitted[i];
          }
          else {
              o += splitted[i]+"-";
          }
      }
        
        return o;
    }

     
	
	//ER
	
    $scope.submit = function(form) {
      // Trigger validation flag.
      $scope.submitted = true;
     var dateUser = $('#datepicker_single').val();
     //If form is invalid, return and let AngularJS show validation errors.
     
      dateUser=reverse(dateUser);
      
      var time = (new Date(dateUser).getTime())/1000;
      var od_single = $('#od_single').val() * 3600;
	  var do_single = $('#dox_single').val() * 3600;
      
	
	  
	  var total_od = time + od_single;
	  var total_do = time + do_single;
	 
	  var userId = $('#hidden_single').val();
	  var parkingId = $('#parking_single').val();
	  
	  
	
	var config = {
        params : {
          'callback' : 'JSON_CALLBACK',
          'parking' : parkingId,
          'user' : userId,
          'from' : total_od,
          'to' : total_do
        }};
	
	
	
	      // Perform JSONP request.
      var $promise = $http.jsonp('backend/app/QUERY/insertReservation.php', config)
        .success(function(data, status, headers, config) {
			console.log('spremljeno :)');
        })
        .error(function(data, status, headers, config) {
          $scope.progress = data;
          $scope.messages_login = 'Došlo je do mrežne pogreške. Pokušajte ponovo kasnije.';
          $log.error(data);
        })
        .finally(function() {
          // Hide status messages after three seconds.
          $timeout(function() {
            $scope.messages_login = null;
          }, 3000);
        });
	
	
	
	
	


      var config = {
        params : {
          'callback' : 'JSON_CALLBACK',
          'parking' : $scope.username,
          'password' : $scope.password          
        }
      };
  };
    
});
app.controller('login', function ($scope, $window, $http, $log, promiseTracker, $timeout){
    $scope.subjectListOptions = {
      'bug': 'Report a Bug',
      'account': 'Account Problems',
      'mobile': 'Mobile',
      'user': 'Report a Malicious User',
      'other': 'Other'
    };
    

    // Inititate the promise tracker to track form submissions.
    $scope.progress = promiseTracker();
    $scope.submit = function(form) {
      // Trigger validation flag.
      $scope.submitted = true;

      // If form is invalid, return and let AngularJS show validation errors.
      if (form.$invalid) {
        return;
      }

      // Default values for the request.
      var config = {
        params : {
          'callback' : 'JSON_CALLBACK',
          'username' : $scope.username,
          'password' : $scope.password          
        }
      };

      // Perform JSONP request.
      var $promise = $http.jsonp('backend/app/QUERY/login.php', config)
        .success(function(data, status, headers, config) {
          if (typeof data.result === "undefined") {
            //TO DO send user to register.php
            if(data.Role === "Admin"){
                var domain=document.URL;
                url_domain(function(domain) {
                    var redirect = 'admin_loginer.php?id=' + data.UserId + '&role=' + data.Role;
                    //var redirect = "http://"+domain+"/OPP/admin";
                    $.redirectPost(redirect,{Role: data.Role, UserId: data.UserId});
                });
            }
            else if(data.Role === "User"){
                var domain=document.URL;
                url_domain(function(domain) {
                    var redirect = 'user_loginer.php?id=' + data.UserId + '&role=' + data.Role;
                    //var redirect = 'http://'+domain+"/OPP/";
                    $.redirectPost(redirect,{Role: data.Role, UserId: data.UserId});
                });
            }
          } else {
            $scope.messages_login = data.description;
            $log.error(data);
          }
        })
        .error(function(data, status, headers, config) {
          $scope.progress = data;
          $scope.messages_login = 'Došlo je do mrežne pogreške. Pokušajte ponovo kasnije.';
          $log.error(data);
        })
        .finally(function() {
          // Hide status messages after three seconds.
          $timeout(function() {
            $scope.messages_login = null;
          }, 3000);
        });
    };
});
app.controller('register', function ($scope, $window, $http, $log, promiseTracker, $timeout){
    $scope.subjectListOptions = {
      'bug': 'Report a Bug',
      'account': 'Account Problems',
      'mobile': 'Mobile',
      'user': 'Report a Malicious User',
      'other': 'Other'
    };
    

    // Inititate the promise tracker to track form submissions.
    $scope.progress = promiseTracker();
    $scope.showPassword=false;
    var len;
    var passwords =false;
    $scope.validate = function () {
        var unicodeWord = XRegExp("(?=^.{6,30}$)((?=.*\\d)|(?=.*\\W))(?![.\\n])(?=.*\\p{Lu})(?=.*\\p{Ll})");
                len = $scope.passwordRegister;
                if(!unicodeWord.test(len) && !$('#passwordRegister').hasClass('redborder')){
                    $scope.showPassword=false;
                    $('#passwordRegister').addClass('redborder');
                }
                else if(unicodeWord.test(len)){
                    $scope.showPassword=true;
                     $('#passwordRegister').removeClass('redborder');
                }
    };
    
    $scope.checkup = function () {
        var string = $scope.passwordRegister2;
        if(len!==string && !$('#passwordRegister2').hasClass('redborder')){
            passwords = true;
            $('#passwordRegister2').addClass('redborder');
        } else if(len===string){
            $('#passwordRegister2').removeClass('redborder');
        }
        
    };
   function reverse(s) {
        var o = '';
        var splitted = s.split("/");
        for (var i = splitted.length - 1; i >= 0; i--){
          if(i === 0){
              o += splitted[i];
          }
          else {
              o += splitted[i]+"-";
          }
      }
        
        return o;
    }
    $scope.submit = function(form) {
      // Trigger validation flag.
      $scope.submitted = true;
      var dateUser = $('#datepicker').val();
     //If form is invalid, return and let AngularJS show validation errors.
      dateUser=reverse(dateUser);
      
      var time = (new Date(dateUser).getTime())/1000;
      // Default values for the request.
      var config = {
        params : {
          'callback' : 'JSON_CALLBACK',
          'name' : $scope.nameUser,
          'surname' : $scope.surnameUser,
          'username' : $scope.username,
          'email' : $scope.email,
          'password' : $scope.passwordRegister2 ,
          'oib' : $scope.OIB,
          'date' : time,
          'address' : $scope.Address,
          'telephone' : $scope.telephone,
          'card' : $scope.Credit
        }
      };
      // Perform JSONP request.
      var $promise = $http.jsonp('backend/app/QUERY/register.php', config)
        .success(function(data, status, headers, config) {
          if (typeof data.result === "undefined") {
            $scope.nameUser = null;
            $scope.surnameUser = null;
            $scope.username = null;
            $scope.password = null;
            $scope.OIB = null;
            $scope.Address = null;
            $scope.telephone = null;
            $scope.Credit = null;
            $scope.messages_register = 'Registracija je uspješno izvršena!';
            $scope.submitted = false;
          } else {
            $scope.messages_register = data.description;
            $log.error(data);
          }
        })
        .error(function(data, status, headers, config) {
          $scope.progress = data;
          $scope.messages_register = 'Došlo je do mrežne pogreške. Pokušajte ponovo kasnije.';
          $log.error(data);
        })
        .finally(function() {
          // Hide status messages after three seconds.
          $timeout(function() {
              if($scope.messages_register === "Resgistracija je uspješno izvršena!"){
                $scope.messages_register = null;
                $('#registerModal').modal('hide');
            }
            
          }, 3000);
        });
    };
});
app.controller('help', function ($scope, $window, $http, $log, promiseTracker, $timeout) {
    $scope.subjectListOptions = {
      'bug': 'Report a Bug',
      'account': 'Account Problems',
      'mobile': 'Mobile',
      'user': 'Report a Malicious User',
      'other': 'Other'
    };
    

    // Inititate the promise tracker to track form submissions.
    $scope.progress = promiseTracker();
    
    // Form submit handler.
    $scope.submit = function(form) {
      // Trigger validation flag.
      $scope.submitted = true;

      // If form is invalid, return and let AngularJS show validation errors.
      if (form.$invalid) {
        return;
      }

      // Default values for the request.
      var config = {
        params : {
          'callback' : 'JSON_CALLBACK',
          'name' : $scope.name,
          'email' : $scope.email,
          'message' : $scope.message,
          'response' : $window.response
        }
      };

      // Perform JSONP request.
      var $promise = $http.jsonp('mail.php', config)
        .success(function(data, status, headers, config) {
          if (data.status === 'OK') {
            $scope.name = null;
            $scope.email = null;
            $scope.message = null;
            $scope.messages = 'Vaš upit je poslan!';
            $scope.submitted = false;
          } else {
            $scope.messages = data.status;
            $log.error(data);
          }
        })
        .error(function(data, status, headers, config) {
          $scope.progress = data;
          $scope.messages = 'Došlo je do mrežne pogreške. Pokušajte ponovo kasnije.';
          $log.error(data);
        })
        .finally(function() {
          // Hide status messages after three seconds.
          $timeout(function() {
            $scope.messages = null;
          }, 3000);
        });
    };
  });


