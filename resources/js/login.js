$(document).ready(function(){
  var request;

  $("#login").submit(function(event){

    var nick = $('#nick').val();
    var pass = $('#pass').val();

    if(request)
      request.abort();

    var $form = $(this);

    request = $.ajax({
      url: $form.attr('action'),
      type: 'POST',
      data: "nick=" + nick + "&password=" + pass
    });

    request.done(function (response, textStatus, jqXHR){
      console.log(response);
      if(response.indexOf('http') != -1)
      {
        location.href = response;
      }
      else 
      {
          $("#result").html(
            "<span id = 'message' style = 'color: rgb(231, 60, 60); font-weight: bold;'>" +
            response + "</span><br><br>");

          setTimeout(function() {
           $("#message").fadeOut(1500);
          },1000);
      }
    });

    request.fail(function(jqXHR, textStatus, errorThrown){
      $("#result").html(
        "<span id = 'message' style = 'color: rgb(231, 60, 60); font-weight: bold;'>" +
        + response + "</span><br><br>");

        setTimeout(function() {
         $("#message").fadeOut(1500);
        },1000);
    });

    request.always(function(){

    });

	   event.preventDefault();
  });
});
