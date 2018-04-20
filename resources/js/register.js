$(document).ready(function(){
  var request;

  $("#register").submit(function(event){

    var correo = $('#email').val();
    var pass = $('#pass').val();
    var rpass = $('#rpass').val();
    var name = $('#user_name').val();
    var ape = $('#user_last').val();
    var sex = $('input[name="genero"]:checked').val();

    if(request)
      request.abort();

    var $form = $(this);

    request = $.ajax({
      url: $form.attr('action'),
      type: 'POST',
      data: "correo=" + correo + "&password=" + pass + "&rpassword=" + rpass +
      "&name=" + name + "&apellidos=" + ape + "&sexo=" +sex
    });

    request.done(function (response, textStatus, jqXHR){
      console.log(response);
      if(response == '')
      {
        $("#result").html(
          "<span id = 'message' style = 'color: rgb(231, 60, 60); font-weight: bold;'>" +
          "Registro realizado con exito! por favor espere...</span><br><br>");

        setTimeout(function() {
         $("#message").fadeOut(1500);
        },1000);

      }
      else
      {
        $("#result").html(
          "<span id = 'message' style = 'color: rgb(231, 60, 60); font-weight: bold;'>" +
          "Error al registrarse, Intente mas tarde</span><br><br>");

        setTimeout(function() {
         $("#message").fadeOut(1500);
        },1000);
      }
    });

    request.fail(function(jqXHR, textStatus, errorThrown){
      $("#result").html(
        "<span id = 'message' style = 'color: rgb(231, 60, 60); font-weight: bold;'>" +
        "Error al registrarse, Intente mas tarde</span><br><br>");

        setTimeout(function() {
         $("#message").fadeOut(1500);
        },1000);
    });

    request.always(function(){

    });

	   event.preventDefault();
  });
});
