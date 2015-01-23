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
      switch(form.$name){
          case "single" :
      
      $scope.submitted_single = true;
      
      if (form.$invalid) {
        return;
      }
      var od_single = (parseInt($('#od_single').val(),10)-1) * 3600;
      var do_single = (parseInt($('#dox_single').val(),10)-1) * 3600;
      var dateUser = $('#datepicker_single').val();
     //If form is invalid, return and let AngularJS show validation errors.
      dateUser=reverse(dateUser);
      var now = (new Date().getTime())/1000;
      var vor = 6 * 3600;
      now=now + vor;
      var time = (new Date(dateUser).getTime())/1000;
      
	  var userId = $('#hidden_single').val();
	  var parkingId = $('#parking_single').val();
	  var total_od = time + od_single;
	  var total_do = time + do_single;
	 
	  if(total_od < now){
              $scope.messages_single = "Rezervacija mora biti izvršena minimalno 6 sati unaprijed";
              $timeout(function() {
            $scope.messages_single = null;
          }, 3000);
          break;
          }
	
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
            if (data.result === "USPJEH") {
            $('#datepicker_single').datepicker("update","");
            $scope.messages_single = 'Rezervacija je uspješno izvršena!';
            $scope.submitted = false;
          } else {
            $scope.messages_single = data.description;
            $log.error(data);
          }
        })
        .error(function(data, status, headers, config) {
          $scope.progress = data;
          $scope.messages_single = 'Došlo je do mrežne pogreške. Pokušajte ponovo kasnije.';
          $log.error(data);
        })
        .finally(function() {
          // Hide status messages after three seconds.
          $timeout(function() {
            $scope.messages_single = null;
          }, 3000);
        });
       break;
            case "rep" :
        

            $scope.submitted_rep = true;

            if (form.$invalid) {
              return;
            }
           var od_rep = (parseInt($('#od_rep').val(),10)-1) * 3600;
           var do_rep = (parseInt($('#dox_rep').val(),10)-1) * 3600;
           var dateUser = $('#datepicker_rep').val();
            var now = (new Date().getTime())/1000;
            var vor = 6 * 3600;
            now=now + vor;
           var allDates = dateUser.split(",");
           var month = checkDates(allDates);
           if(month===0){
               $scope.messages_rep = "U svakom tijednu treba biti barem jedna rezervacija!";
           }
           else if(month===-1){
               $scope.messages_rep = "Sve rezervacije trebaju biti unutar 30 dana!";
           }
           //If form is invalid, return and let AngularJS show validation errors.
           else if(month===1){
           for(var i=0;i<allDates.length;i++){
                dateUser=reverse(allDates[i]);
                var time = (new Date(dateUser).getTime())/1000;
                

                var userId = $('#hidden_rep').val();
                var parkingId = $('#parking_rep').val();
                var total_od = time + od_rep;
                var total_do = time + do_rep;
                if(total_od < now){
                $scope.messages_rep = "Rezervacija za datum: "+ allDates[i] +" je pogrešna!";
                continue;
            }
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
                  $('#datepicker_rep').datepicker("update","");
                  $scope.submitted = false;
                  if (data.result === "USPJEH") {
                       if(typeof($scope.messages_rep) === "undefined"){
                    $scope.messages_rep = 'Rezervacije su uspješno izvršene!';
                }
                else if($scope.messages_rep !== "Rezervacije su uspješno izvršene!" && $scope.messages_rep !== "Sve rezervacije trebaju biti unutar 30 dana!" && !(~$scope.messages_rep.indexOf("Rezervacije su izvršene"))){
                    $scope.messages_rep += " Rezervacije su izvršene";
                }
                } else {
                     if(typeof($scope.messages_rep) === "undefined"){
                   $scope.messages_rep = 'Došlo je do mrežne pogreške. Pokušajte ponovo kasnije.';
               }
                }
              })
              .error(function(data, status, headers, config) {
                  $timeout(function() {
                  $scope.messages_rep = null;
                }, 3000);
              })
                      .finally(function() {
                // Hide status messages after three seconds.
                $timeout(function() {
                  $scope.messages_rep = null;
                }, 3000);
              }); 
           };
       }
            
              break;
        case "perm" :
            
            $scope.submitted_perm = true;
      
            if (form.$invalid) {
              return;
            }

           var dateUser = $('#datepicker_perm').val();
           //If form is invalid, return and let AngularJS show validation errors.

            dateUser=reverse(dateUser);

            var time = (new Date(dateUser).getTime())/1000;

                var total_od = time;
                var total_do = -1;

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
                  if (data.result === "USPJEH") {
                  $('#datepicker_perm').datepicker("update","");
                  $scope.messages_perm = 'Rezervacija je uspješno izvršena!';
                  $scope.submitted = false;
                } else {
                  $scope.messages_perm = data.description;
                  $log.error(data);
                }
              })
              .error(function(data, status, headers, config) {
                $scope.progress = data;
                $scope.messages_perm = 'Došlo je do mrežne pogreške. Pokušajte ponovo kasnije.';
                $log.error(data);
              })
              .finally(function() {
                // Hide status messages after three seconds.
                $timeout(function() {
                  $scope.messages_perm = null;
                }, 3000);
              });
             break;
            
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
    
    function validateBirthdate(){
        if($('#datepicker').val() === "undefined" || $('#datepicker').val() === ""){
        $scope.showError = "true";
    }
    else{
        $scope.showError="false";
    }
    };
    
    $scope.editBirthdate = function(){
        
        if($scope.showError === "true" && !($('#datepicker').val() === "undefined" || $('#datepicker').val() === "")){
            $scope.showError = "false";
        }
    };
    
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
      //validateBirthdate();
      if (form.$invalid) {
        return;
      }
      var dateUser = $('#datepicker').val();
     //If form is invalid, return and let AngularJS show validation errors.
      dateUser=reverse(dateUser);
      
      var time = (new Date(dateUser).getTime())/1000;
      // Default values for the request.
      var change = false;
      var config = {
        params : {
          'callback' : 'JSON_CALLBACK',
          'name' : $scope.nameUser,
          'surname' : $scope.surnameUser,
          'username' : $scope.usernameRegister,
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
          if (data.result === "USPJEH") {
            $scope.nameUser = null;
            $scope.surnameUser = null;
            $scope.usernameRegister = null;
            $scope.email = null;
            $scope.passwordRegister = null;
            $scope.passwordRegister2 = null;
            $scope.OIB = null;
            $scope.Address = null;
            $scope.telephone = null;
            $scope.Credit = null;
            $('#datepicker').datepicker("update","");
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
              
            if($scope.messages_register === "Registracija je uspješno izvršena!"){
                $('#registerModal').modal('hide');
          $('#loginModal').modal('show');
            }
            $scope.messages_register = null;
            
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

app.directive('datepicker', function() {
  return {
    require: 'ngModel',
    link: function(scope, el, attr, ngModel) {
        $(el).datepicker({
            format: "dd/mm/yyyy",
            autoclose: true,
            startView: 2,
            clearBtn: true,
            language: "hr",
            endDate: date_register});
      $(el).datepicker().on("changeDate",function(event){
            scope.$apply(function() {
               ngModel.$setViewValue(event.date);//This will update the model property bound to your ng-model whenever the datepicker's date changes.
            });
        });
    }
  };
});

app.directive('datepickersingle', function() {
  return {
    require: 'ngModel',
    link: function(scope, el, attr, ngModel) {
        $(el).datepicker({
            format: "dd/mm/yyyy",
            autoclose: true,
            clearBtn: true,
            language: "hr",
            startDate: date_1});
      $(el).datepicker().on("changeDate",function(event){
            scope.$apply(function() {
               ngModel.$setViewValue(event.date);//This will update the model property bound to your ng-model whenever the datepicker's date changes.
            });
        });
    }
  };
});

app.directive('datepickerrep', function() {
  return {
    require: 'ngModel',
    link: function(scope, el, attr, ngModel) {
        $(el).datepicker({
            format: "dd/mm/yyyy",
            multidate: true,
            clearBtn: true,
            language: "hr",
            startDate: date_1});
      $(el).datepicker().on("changeDate",function(event){
            scope.$apply(function() {
               ngModel.$setViewValue(event.date);//This will update the model property bound to your ng-model whenever the datepicker's date changes.
            });
        });
    }
  };
});

app.directive('datepickerperm', function() {
  return {
    require: 'ngModel',
    link: function(scope, el, attr, ngModel) {
        $(el).datepicker({
            format: "dd/mm/yyyy",
            autoclose: true,
            clearBtn: true,
            language: "hr",
            startDate: date_1});
      $(el).datepicker().on("changeDate",function(event){
            scope.$apply(function() {
               ngModel.$setViewValue(event.date);//This will update the model property bound to your ng-model whenever the datepicker's date changes.
            });
        });
    }
  };
});