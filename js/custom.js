function getDate(){
    var currentDate = new Date();
    var day = currentDate.getDate();
    var month = currentDate.getMonth() + 1;
    var year = currentDate.getFullYear();
    return("<b>" + day + "/" + month + "/" + year + "</b>");
}
            
function register(current){
    $('#loginModal').modal('hide');
    $('#registerModal').modal('show');
}

function logout(){
    var domain=document.URL;
    url_domain(function(domain) {
    window.location = "http://"+domain+"/OPP";
    //window.location = "http://www."+domain;
    });      
}

var url_domain = function (callback) {
    var a = document.createElement('a');
         a.href = callback;
         typeof callback === 'function' && callback(a.hostname);
};



$.extend(
{
    redirectPost: function(location, args)
    {
        var form = '';
        $.each( args, function( key, value ) {
            form += '<input type="hidden" name="'+key+'" value="'+value+'">';
        });
        $('<form action="'+location+'" method="POST">'+form+'</form>').appendTo('body').submit();
    }
});

$("#loginModal").on('hidden.bs.modal', function () {
    $('#username').val("");
    $('#password').val("");
});
$("#registerModal").on('hidden.bs.modal', function () {
    $('#nameUser').val("");
    $('#surnameUser').val("");
    $('#usernameRegister').val("");
    $('#email').val("");
    $('#passwordRegister').val("");
    $('#passwordRegister2').val("");
    $('#OIB').val("");
    $('#datepicker').val("");
    $('#Address').val("");
    $('#telephone').val("");
    $('#Credit').val("");
});
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

function checkDates(timestampsRaw) {
    
        var timestamps = [];
         for(i = 0;i<timestampsRaw.length;i++){
        	var reversed = reverse(timestampsRaw[i]);
            timestamps[i]= (new Date(reversed).getTime())/1000;
        }
	timestamps.sort();
	var dates = timestamps;
	var time = timestamps[0];	
	var weeks = [0, 0, 0, 0, 0];
	var week = 7 * 24 * 60 * 60;
	var month = 30 * 24 * 60 * 60;
	var check = 1;
	
	
	var firstDay = timestamps[0];
	var lastDay = timestamps[timestamps.length - 1];
	
	var lastDayLimit = firstDay + month;
	
	
	
	
	//provjera ako je izvan tekuceg mjeseca
	console.log(timestamps);
	if(timestamps.length < 5)
	{
		return 0;
	}
	
	if(lastDay > lastDayLimit)
	{
		return -1;
	}
	//END provjera
	
	
	var currentStart = firstDay;
	for(i = 0; i < 5; i++) {
		
		var currentEnd = currentStart + week-1;
		
		for (j = 0; j < dates.length; ++j) {
    		
			if(dates[j] >= currentStart && dates[j] <= currentEnd) {
				weeks[i] += 1;
			}
			
		}
		
		currentStart += week;	
	}
	
        console.log(weeks);
        
	for(i = 0; i < 5; i++) {
		if(weeks[i] == 0) {
			check = 0;
			break;
		}
	}
	
	return check;
}