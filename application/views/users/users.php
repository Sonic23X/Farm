      <div>
        <a id="create" href = "#new" class="form-control btn-warning" style="text-align: center; text-decoration: none;" data-toggle = 'modal'>Crear nuevo Usuario</a>
        <hr>
        <h1>Usuarios registrados en el sistena</h1>
        <br>
        <div id="user_table">
          <?php
            $content  = "<div class='table-responsive'>";
            $content .= "<table class='table table-hover table-bordered table-condensed'>";
            $content .=	"<thead>";
            $content .=	"<tr>";
            $content .= "<th style='text-align: center;'>Nombre</th>";
            $content .= "<th style='text-align: center;'>Tipo</th>";
            $content .= "<th style='text-align: center;' colspan='3'> Acciones</th>";
            $content .=	"</tr>";
            $content .=	"</thead>";
            $content .=	"<tbody>";
            $id = 0;
            foreach ($user->result_array() as $usuario)
            {
              $content .= "<tr id ='tr$id'>";
              foreach ($usuario as $fila => $value)
              {
                if($fila == "Nick")
                {
                  $content .= "<td style='text-align: center;'>". $value ."</td>";
                  $content .= "<td style='text-align: center;'>". $usuario['Tipo'] ."</td>";
                  if($value != 'admin')
                    $content .= "<td style='text-align: center;'><a id='#modi' name ='$value' class = 'btn btn-warning' href='#mod' data-toggle = 'modal'>Modificar</a></td>";
                  else
                    $content .= "<td style='text-align: center;'></td>";
                  $content .= "<td style='text-align: center;'><a id='#changep' name ='$value' class = 'btn btn-warning' href='#cpass' data-toggle = 'modal'>Cambiar Contraseña</a></td>";
                  if($value != 'admin' && $usuario['idUsuario'] != $this->session->userdata('id'))
                    $content .= "<td style='text-align: center;'><Button name ='$value' id = '$id' class = 'btn btn-danger' href='#eliminar' data-toggle = 'modal'>Eliminar</Button></td>";
                  else
                  $content .= "<td style='text-align: center;'></td>";
                }
              }
              $content .= "</tr>";
              $id++;
            }
            $content .=	"</tbody>";
            $content .=	"</table>";
            $content .= "</div>";
            echo $content;
          ?>
        </div>
        <h3>Nota:</h3>
        <p>
          Eliminar un usuario provocará que no pueda iniciar sesión, registrar mas compras y consultar las compras que realizo,
          por lo que debe estar completamente segur@ al querer borrarlo del sistema.
        </p>
      </div>

      <div class = "modal fade" id= "eliminar">
        <div class = "modal-dialog">
          <div class = "modal-content">
            <div class = "modal-header">
              <button tyle = "button" class = "close" data-dismiss = "modal" aria-hidden="true">&times;</button>
              <h4 class = "modal-title">Advertencia</h4>
            </div>

            <div class = "modal-body">
              <p id="mensaje"><p>
            </div>

            <div class = "modal-footer">
              <input type="button" class = "btn btn-warning" data-dismiss = "modal" value="Cancelar">
              <input type="button" id="delete" class = "btn btn-danger" data-dismiss = "modal" value="Aceptar">
            </div>
          </div>
        </div>
      </div>

      <div class = "modal fade" id= "mod">
        <div class = "modal-dialog">
          <div class = "modal-content">
            <div class = "modal-header">
              <button tyle = "button" class = "close" data-dismiss = "modal" aria-hidden="true">&times;</button>
              <h4 class = "modal-title">Actualizar Información</h4>
            </div>

            <div class = "modal-body">

              <form id="updateUser" class="formulario">
                <input type="text" id="idup" class="form-control" value= "" style="width: auto; display: none">
                <table>
                  <tr>
                    <td>
                      <p id="a1">Usuario</p>
                    </td>
                    <td>&nbsp;&nbsp;</td>
                    <td>
                      <input type="text" id="nick" class="form-control" value= "" placeholder="Usuario" required style="width: auto">
                    </td>
                  </tr>
                  <tr>
                    <td colspan='3'>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>
                      <p id="a2">Categoria</p>
                    </td>
                    <td>&nbsp;&nbsp;</td>
                    <td>
                      <select id="tipo" class = "select form-control" style="width: auto;">
          							<option value="Administrador">Administrador</option>
          							<option value="Usuario">Usuario</option>
          					  </select>
                    </td>
                  </tr>
                </table>
              </form>

            </div>

            <div class = "modal-footer">
              <input type="button" class = "btn btn-warning" data-dismiss = "modal" value="Cancelar">
              <input type="button" id="actuali" class = "btn btn-success" data-dismiss = "modal" value="Aceptar">
            </div>
          </div>
        </div>
      </div>

      <div class = "modal fade" id= "cpass">
        <div class = "modal-dialog">
          <div class = "modal-content">
            <div class = "modal-header">
              <button tyle = "button" class = "close" data-dismiss = "modal" aria-hidden="true">&times;</button>
              <h4 class = "modal-title">Cambia tu contraseña</h4>
            </div>

            <div class = "modal-body">

              <form id="updatePass" class="formulario">
                <input type="text" id="idup2" class="form-control" value= "" style="width: auto; display: none">
                <table>
                  <tr>
                    <td>
                      <p id="aviso1">Contraseña Actual</p>
                    </td>
                    <td>&nbsp;&nbsp;</td>
                    <td>
                      <input type="password" id="pass" class="form-control" value= "" required style="width: auto">
                    </td>
                  </tr>
                  <tr>
                    <td colspan='3'>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>
                      <p id="aviso2"> Nueva Contraseña</p>
                    </td>
                    <td>&nbsp;&nbsp;</td>
                    <td>
                      <input type="password" id="npass" class="form-control" value= "" required style="width: auto">
                    </td>
                  </tr>
                  <tr>
                    <td colspan='3'>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>
                      <p id="aviso3">Repetir Contraseña</p>
                    </td>
                    <td>&nbsp;&nbsp;</td>
                    <td>
                      <input type="password" id="nrpass" class="form-control" value= "" required style="width: auto">
                    </td>
                  </tr>
                </table>
              </form>

            </div>

            <div class = "modal-footer">
              <input type="button" class = "btn btn-warning" data-dismiss = "modal" value="Cancelar">
              <input type="button" id="chanp" class = "btn btn-success" data-dismiss = "modal" value="Aceptar">
            </div>
          </div>
        </div>
      </div>

      <div class = "modal fade" id= "new">
        <div class = "modal-dialog">
          <div class = "modal-content">
            <div class = "modal-header">
              <button tyle = "button" class = "close" data-dismiss = "modal" aria-hidden="true">&times;</button>
              <h4 class = "modal-title">Nuevo Usuario - Informacion necesaria</h4>
            </div>

            <div class = "modal-body">

              <form id="newUser" class="formulario">
                <table>
                  <tr>
                    <td>
                      <p id="av1">Nuevo Usuario</p>
                    </td>
                    <td>&nbsp;&nbsp;</td>
                    <td>
                      <input type="text" id="user" class="form-control" value= "" required style="width: auto">
                    </td>
                  </tr>
                  <tr>
                    <td colspan='3'>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>
                      <p id="av2">Contraseña</p>
                    </td>
                    <td>&nbsp;&nbsp;</td>
                    <td>
                      <input type="password" id="contrasena" class="form-control" value= "" required style="width: auto">
                    </td>
                  </tr>
                  <tr>
                    <td colspan='3'>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>
                      <p id="av3">Repetir Contraseña</p>
                    </td>
                    <td>&nbsp;&nbsp;</td>
                    <td>
                      <input type="password" id="rcontrasena" class="form-control" value= "" required style="width: auto">
                    </td>
                  </tr>
                  <tr>
                    <td colspan='3'>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>
                      <p id="av4">Tipo</p>
                    </td>
                    <td>&nbsp;&nbsp;</td>
                    <td>
                      <select id="tipe" class = "select form-control" style="width: auto;">
                        <option style="display: none"></option>
          							<option value="Administrador">Administrador</option>
          							<option value="Usuario">Usuario</option>
          					  </select>
                    </td>
                  </tr>
                </table>
              </form>

            </div>

            <div class = "modal-footer">
              <input type="button" class = "btn btn-warning" data-dismiss = "modal" value="Cancelar">
              <input type="button" id="crear" class = "btn btn-success" data-dismiss = "modal" value="Aceptar">
            </div>
          </div>
        </div>
      </div>

      <script type="text/javascript">
        $(document).ready(function(){

          var fila;
          var usuario;

          $("button").on("click", function (e){

            var user = $(this).attr('name');
            var id = $(this).attr('id');

            fila = id;
            usuario = user;

            $("#mensaje").text('Desea eliminar al usuario ' + user);

          });

          $("#delete").click(function(event) {

            var request;

            if(request)
              request.abort();

            request = $.ajax({
              url: "<?=base_url('User/DeleteThis')?>",
              type: "POST",
              data: "user=" + usuario + "&id=" + fila
            });

            request.done(function (response, textStatus, jqXHR){
              $("#tr" + response).html("");
            });

            request.fail(function(jqXHR,textStatus, thrown){
              console.log("Error:" + textStatus);
            });

            event.preventDefault();

          });

          $("a").on("click", function (e){

            var user = $(this).attr('name');
            var idelemento = $(this).attr('id');
            var request;

            if(idelemento == "#modi")
            {
              var iduser;
              var tipo;

              if(request)
                request.abort();

              request = $.ajax({
                url: "<?=base_url('User/GetInfo')?>",
                type: "POST",
                data: "user=" + user
              });

              request.done(function (response, textStatus, jqXHR){
                iduser = response.split('_')[0];
                tipo = response.split('_')[1];

                $('#idup').val(iduser);
                $("#tipo option[value="+ tipo +"]").attr("selected",true);
              });

              $('#nick').val(user);
            }

            if(idelemento == "#changep")
            {
              var iduser;

              if(request)
                request.abort();

              request = $.ajax({
                url: "<?=base_url('User/GetInfo')?>",
                type: "POST",
                data: "user=" + user
              });

              request.done(function (response, textStatus, jqXHR){
                iduser = response.split('_')[0];
                $('#idup2').val(iduser);
              });
            }

          });

          $("#actuali").click(function(event) {

            var request;

            var user = $('#nick').val();
            var id = $('#idup').val();
            var tipo = $("#tipo option:selected").val();

            if(request)
              request.abort();

            request = $.ajax({
              url: "<?=base_url('User/UpdateInfo')?>",
              type: "POST",
              data: "nick=" + user + "&id=" + id + "&tipo=" + tipo
            });

            request.done(function (response, textStatus, jqXHR){
              location.href = "http://localhost/manitas/User";
            });

            request.fail(function(jqXHR,textStatus, thrown){
              console.log("Error:" + textStatus);
            });

            event.preventDefault();

          });

          $("#chanp").click(function(event) {

            var request;

            var id = $('#idup2').val();
            var old = $('#pass').val();
            var nueva = $('#npass').val();
            var rnueva = $('#nrpass').val();

            if(request)
              request.abort();

            request = $.ajax({
              url: "<?=base_url('User/UpdatePass')?>",
              type: "POST",
              data: "actual=" + old + "&nueva=" + nueva + "&rnueva=" + rnueva + "&id=" + id
            });

            request.done(function (response, textStatus, jqXHR){
              console.log(response);
            });

            request.fail(function(jqXHR,textStatus, thrown){
              console.log("Error:" + textStatus);
            });

            event.preventDefault();

          });

          $("#crear").click(function(event) {

            var request;

            var nick = $('#user').val();
            var nueva = $('#contrasena').val();
            var rnueva = $('#rcontrasena').val();
            var tip = $("#tipe option:selected").val();

            if(request)
              request.abort();

            request = $.ajax({
              url: "<?=base_url('User/UserUp')?>",
              type: "POST",
              data: "nick=" + nick + "&nueva=" + nueva + "&rnueva=" + rnueva + "&tip=" + tip
            });

            request.done(function (response, textStatus, jqXHR){
              /*$('#user_table').html("");

              $.ajax({
                url: "<?=base_url('User/Reboot')?>",
                type: "POST",
                success: function(response2) {
                  $('#user_table').html(response2);
                }
              });*/
              location.href = "http://localhost/manitas/User";
            });

            request.fail(function(jqXHR,textStatus, thrown){
              console.log("Error:" + textStatus);
            });

            event.preventDefault();

          });

        });
      </script>
