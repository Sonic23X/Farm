$(document).ready(function(){

  var request;

  $("#changeimg").submit(function(event){

    if(request)
    {
      request.abort();
    }

    var $form = $(this);
    var $inputs = $form.find("input, select, button, textarea");
    var formData = new FormData($(this)[0]);
    var formDataSerialized = $(this).serialize();

    request = $.ajax({

      cache: false,
      contentType: false,
      processData: false,
      url: $form.attr('action'),
      type: $form.attr('method'),
      data: formData

    });

    request.done(function (response, textStatus, jqXHR){

      if(response.indexOf("http") > -1)
      {
        $("#imagen").attr({
          'src': response
        });
        $("#result").html(
          "<span id = 'message' style = 'color: rgb(231, 60, 60); font-weight: bold;'>" +
          "Cambio completado con exito!</span>");

        setTimeout(function() {
         $("#message").fadeOut(1500);
        },1000);

      }
      else
      {
        if(response != '<p>You did not select a file to upload.</p>')
        {
          $("#result").html(
            "<span id = 'message' style = 'color: rgb(231, 60, 60); font-weight: bold;'>" +
            "Error, no se pudo cargar la imagen</span>");
        }
        else
        {
          $("#result").html(
            "<span id = 'message' style = 'color: rgb(231, 60, 60); font-weight: bold;'>" +
            "Error, no se ha seleccionado ninguna imagen</span>");
        }
        setTimeout(function() {
         $("#message").fadeOut(1500);
        },1000);
      }
    });

    request.fail(function(jqXHR, textStatus, errorThrown){

    });

    request.always(function(){
      $inputs.prop("disabled", false);
    });

    event.preventDefault();
  });


  $("#informacion").submit(function(event){

    var id = $('#id').val();
    var name = $('#name').val();
    var ape = $('#last').val();
    var sex = $('input[name="genero"]:checked').val();

    if(request)
      request.abort();

    var $form = $(this);

    request = $.ajax({
      url: $form.attr('action'),
      type: $form.attr('method'),
      data: "nombre=" + name + "&apellidos=" + ape + "&sexo=" + sex + "&id=" + id
    });

    request.done(function (response, textStatus, jqXHR){
      if(response == '')
      {
        $("#result").html(
          "<span id = 'message' style = 'color: rgb(231, 60, 60); font-weight: bold;'>" +
          "Actualización completada con exito!</span>");

        setTimeout(function() {
         $("#message").fadeOut(1500);
        },1000);

      }
      else
      {
        $("#result").html(
          "<span id = 'message' style = 'color: rgb(231, 60, 60); font-weight: bold;'>" +
          "Error al actualizar la información, Intente mas tarde</span>");

        setTimeout(function() {
         $("#message").fadeOut(1500);
        },1000);
      }
    });

    request.fail(function(jqXHR, textStatus, errorThrown){
      $("#result").html(
        "<span id = 'message' style = 'color: rgb(231, 60, 60); font-weight: bold;'>" +
        "Error al actualizar la información, Intente mas tarde</span>");
    });

    request.always(function(){

    });

	event.preventDefault();

  });

});
