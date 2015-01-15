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