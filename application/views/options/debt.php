      <div>
        <a id="create" href = "#new" class="form-control btn-warning" style="text-align: center; text-decoration: none;" data-toggle = 'modal'>Nueva nota</a>
        <hr>
        <?php
          if($deudas != null)
          {
        ?>
        <h1>Notas registradas en el sistema</h1>
        <br>
        <div id="pay_table">
          <?php
            $content  = "<div class='table-responsive'>";
            $content .= "<table class='table table-hover table-bordered table-condensed'>";
            $content .=	"<thead>";
            $content .=	"<tr>";
            $content .= "<th style='text-align: center;'>Folio</th>";
            $content .= "<th style='text-align: center;'>Nombre</th>";
            $content .= "<th style='text-align: center;'>Monto</th>";
            $content .= "<th style='text-align: center;' colspan='2'> Acciones</th>";
            $content .=	"</tr>";
            $content .=	"</thead>";
            $content .=	"<tbody>";
            $id = 0;
            foreach ($deudas->result_array() as $nota)
            {
              $content .= "<tr id ='tr$id'>";
              foreach ($nota as $fila => $value)
              {
                if($fila == "Nombre")
                {
                  $content .= "<td style='text-align: center;'>". $nota['idDeuda'] ."</td>";
                  $content .= "<td style='text-align: center;'>". $value ."</td>";
                  $content .= "<td style='text-align: center;'>$". $nota['Monto'] ."</td>";
                  $content .= "<td style='text-align: center;'><a id='#modi' name ='".$nota['idDeuda']."' class = 'btn btn-warning' href='#mod' data-toggle = 'modal'>Modificar</a></td>";
                  $content .= "<td style='text-align: center;'><Button name ='".$nota['idDeuda']."' id = '$id' class = 'btn btn-danger' href='#eliminar' data-toggle = 'modal'>Eliminar</Button></td>";
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
        <?php
          }
          else
          {
        ?>
        <h1>No hay notas registradas en el sistema</h1>
        <?php
          }
        ?>
        <h3>Nota:</h3>
        <p>
          Eliminar una nota significará que el deudor a terminado de pagar el monto mostrado en el apartado de detalles, debe estar segur@
          querer eliminar la nota y no querer actualizarla en su lugar
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
              <p id="msj"><p>
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
              <h4 class = "modal-title">Actualizar Nota</h4>
            </div>

            <div class = "modal-body">

              <form id="updateUser" class="formulario">
                <table>
                  <tr>
                    <td>
                      <p id="a1">Folio: </p>
                    </td>
                    <td>&nbsp;&nbsp;</td>
                    <td>
                      <input type="text" id="folio" class="form-control" value= "" required style="width: 35px" disabled>
                    </td>
                    <td>&nbsp;&nbsp;</td>
                    <td>
                      <p id="a2">Monto: </p>
                    </td>
                    <td>&nbsp;&nbsp;</td>
                    <td>
                      <input type="number" id="monto" class="form-control" value= "" required style="width: auto">
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

      <div class = "modal fade" id= "new">
        <div class = "modal-dialog">
          <div class = "modal-content">
            <div class = "modal-header">
              <button tyle = "button" class = "close" data-dismiss = "modal" aria-hidden="true">&times;</button>
              <h4 class = "modal-title">Nueva Nota - Informacion necesaria</h4>
            </div>

            <div class = "modal-body">

              <form id="newUser" class="formulario">
                <table>
                  <tr>
                    <td>
                      <p id="av1">Nombre del Deudor:</p>
                    </td>
                    <td>&nbsp;&nbsp;</td>
                    <td>
                      <input type="text" id="deudor" class="form-control" value= "" required style="width: auto">
                    </td>
                  </tr>
                  <tr>
                    <td colspan='3'>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>
                      <p id="av2">Monto: </p>
                    </td>
                    <td>&nbsp;&nbsp;</td>
                    <td>
                      <input type="text" id="cantidad" class="form-control" value= "" required style="width: auto">
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

          var nota;

          $("button").on("click", function (e){

            var folio = $(this).attr('name');

            nota = folio;

            $("#msj").text('Desea la nota con folio: ' + folio);

          });

          $("#delete").click(function(event) {

            var request;

            if(request)
              request.abort();

            request = $.ajax({
              url: "<?=base_url('Debt/DeleteThis')?>",
              type: "POST",
              data: "folio=" + nota
            });

            request.done(function (response, textStatus, jqXHR){
              location.href = "http://localhost/manitas/Debt";
            });

            request.fail(function(jqXHR,textStatus, thrown){
              console.log("Error:" + textStatus);
            });

            event.preventDefault();

          });

          $("a").on("click", function (e){

            var folio = $(this).attr('name');
            var idelemento = $(this).attr('id');

            var request;

            if(idelemento == "#modi")
            {
              $('#folio').val(folio);

              if(request)
                request.abort();

              request = $.ajax({
                url: "<?=base_url('Debt/GetMonto')?>",
                type: "POST",
                data: "folio=" + folio
              });

              request.done(function (response, textStatus, jqXHR){
                $('#monto').val(response);
              });
            }

          });

          $("#actuali").click(function(event) {

            var request;

            var monto = $('#monto').val();
            var id = $('#folio').val();

            if(request)
              request.abort();

            request = $.ajax({
              url: "<?=base_url('Debt/Update')?>",
              type: "POST",
              data: "monto=" + monto + "&id=" + id
            });

            request.done(function (response, textStatus, jqXHR){
              location.href = "http://localhost/manitas/Debt";
            });

            request.fail(function(jqXHR,textStatus, thrown){
              console.log("Error:" + textStatus);
            });

            event.preventDefault();

          });

          $("#crear").click(function(event) {

            var request;

            var nombre = $('#deudor').val();
            var monto = $('#cantidad').val();

            if(request)
              request.abort();

            request = $.ajax({
              url: "<?=base_url('Debt/Create')?>",
              type: "POST",
              data: "nombre=" + nombre + "&monto=" + monto
            });

            request.done(function (response, textStatus, jqXHR){
              location.href = "http://localhost/manitas/Debt";
            });

            request.fail(function(jqXHR,textStatus, thrown){
              console.log("Error:" + textStatus);
            });

            event.preventDefault();

          });

        });
      </script>
