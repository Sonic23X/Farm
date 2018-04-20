    <div class = "modal fade" id = "compra">
      <div class = "modal-dialog">
        <div class = "modal-content">
          <div class = "modal-header">
            <button tyle = "button" class = "close cerrar" data-dismiss = "modal" aria-hidden="true">&times;</button>
            <h4 class = "modal-title">Informacion de Compra </h4>
          </div>

          <div class = "modal-body">

            <form id="newBuy" class="formulario">
              <input type="text" class="form-control" id="idcompra" style="width: 100px; display: none"/>
              <table>
                <tr>
                  <td>
                    <p>Categoria </p>
                  </td>
                  <td>&nbsp;&nbsp;</td>
                  <td>
                    <select id="categoria" class = "select form-control" style="width: auto;">
        				      <option style="display: none"></option>
        							<option value="Papeleria">Papeleria</option>
        							<option value="Regalos">Regalos</option>
        					  </select>
                  </td>
                  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                  <td>
                    <p>Producto</p>
                  </td>
                  <td>&nbsp;&nbsp;</td>
                  <td>
                    <select id="producto" class = "select form-control" style="width: auto;">
        					  </select>
                  </td>
                </tr>
                <tr>
                  <td colspan='7'>&nbsp;</td>
                </tr>
                <tr>
                  <td colspan='7'>
                    <input type="number" class="form-control" id="cantidad" placeholder="Cantidad" style="width: 100px;" disabled/>
                  </td>
                </tr>
                <tr>
                </tr>
              </table>
              <hr>
              <table id="detalles" style="width: 100%">
                <thead>
                  <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th colspan="2">Costo</th>
                  </tr>
                </thead>
                <tbody id = "cdetalles">
                  <tr>
                  </tr>
                </tbody>
              </table>
              <hr>
              <p id="result" align = center></p>
            </form>

            <div id="details" style="Display: none">
              <table>
                <tr>
                  <td>
                    <p> Folio:
                  </td>
                  <td>&nbsp;&nbsp;</td>
                  <td>
                    <input type="text" class="form-control" id="folio" style="width: 100px" disabled/>
                  </td>
                </tr>
                <tr>
                  <td colspan='3'>&nbsp;</td>
                </tr>
                <tr>
                  <td>
                    <p> Monto a Pagar:
                  </td>
                  <td>&nbsp;&nbsp;</td>
                  <td>
                    <input type="text" class="form-control" id="dinero" style="width: 100px" disabled/>
                  </td>
                </tr>
                <tr>
                  <td colspan='3'>&nbsp;</td>
                </tr>
                <tr>
                  <td>
                    <p> Dinero Recibido:
                  </td>
                  <td>&nbsp;&nbsp;</td>
                  <td>
                    <input type="number" class="form-control" id="money" value="0" style="width: 100px"/>
                  </td>
                </tr>
              </table>
              <br> <br>
              <p id="cambio"> </p>
            </div>

          </div>

          <div class = "modal-footer">
            <input type="button" class = "btn btn-danger cerrar" data-dismiss = "modal" value="Cancelar">
            <input type="button" id="agregar" class="btn btn-default"  value="Agregar Producto" disabled>
            <input type="button" id="back" class="btn btn-default"  value="Atras" style="display: none">
            <input type="button" id="next" class = "btn btn-primary" value="Continuar" disabled>
            <input type="button" id="finish" class = "btn btn-primary" data-dismiss = "modal" value="Finalizar" style="display: none" disabled>
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript">
      $(document).ready(function () {

        var stock;

        $('#categoria').change(function() {

          $("#cantidad").val('');
          $("#categoria option:selected").each(function() {

            var categoria = $('#categoria').val();

            $.post("<?=base_url()?>Buy/obtenerProductos", {
              categoria : categoria},
              function(data) {
                $("#producto").html(data);
              });

          });
        });

        $('#producto').change(function(e){

          $("#cantidad").val('');
          var producto = $("#producto option:selected").val();
          var request;

          if(request)
            request.abort();

          request = $.ajax({
            url: "<?=base_url('Buy/GetStock')?>",
            type: "POST",
            data: "producto=" + producto
          });

          request.done(function (response, textStatus, jqXHR){
            stock = response;
            $("#cantidad").removeAttr("disabled");
          });

          request.fail(function(jqXHR,textStatus, thrown){
            console.log("Error:" + textStatus);
          });

        });

        $('#cantidad').on('input',function(e){

          var texto = parseInt($('#cantidad').val());
          var st = parseInt(stock);

          $("#agregar").removeAttr("disabled");

          if(texto > st)
          {
            $("#result").html(
              "<span id = 'message' style = 'color: rgb(231, 60, 60); font-weight: bold;'>" +
              "La cantidad introducida es mayor al Stock actual</span><br><br>");

            setTimeout(function() {
             $("#message").fadeOut(1500);
            },1000);

            setTimeout(function() {
             $("#result").html('');
            },2000);

            $('#cantidad').val('');
          }
          if(texto <= 0)
          {
            $("#result").html(
              "<span id = 'message' style = 'color: rgb(231, 60, 60); font-weight: bold;'>" +
              "Rectifique la cantidad</span><br><br>");

            setTimeout(function() {
             $("#message").fadeOut(1500);
            },1000);

            setTimeout(function() {
             $("#result").html('');
            },2000);

            $('#cantidad').val('');
          }

        });

        $('#agregar').click(function() {

          var producto = $("#producto option:selected").val();
          var cantidad = $('#cantidad').val();
          var id = $('#idcompra').val();

          $("#next").removeAttr("disabled");

          var request;

          if(request)
            request.abort();

          request = $.ajax({
            url: "<?=base_url('Buy/InsertProduct')?>",
            type: "POST",
            data: "producto=" + producto + "&cantidad=" + cantidad + "&idcompra=" + id
          });

          request.done(function (response, textStatus, jqXHR){
            $('#cdetalles tr:last').after(response);
            $("#cantidad").val('');
          });

          request.fail(function(jqXHR,textStatus, thrown){
            console.log("Error:" + textStatus);
          });

          event.preventDefault();

        });

        $('.cerrar').click(function() {

          var id = $('#idcompra').val();

          $.post("<?=base_url()?>Buy/DeleteBuy", {
            id : id},
            function(data) {
              console.log(data);
            });

          var select = $('#categoria');
          select.val($('option:first', select).val());

          $("#producto").html('');
          $("#cdetalles").html('<tr></tr>');
          $("#cambio").html('');
          $("#cantidad").val('');
          $("#money").val('');
          $("#cantidad").attr("disabled","disabled");
          $("#agregar").attr("disabled","disabled");
          $("#next").attr("disabled","disabled");

          $("#next").removeAttr("style");
          $("#newBuy").removeAttr("style");
          $("#agregar").removeAttr("style");

          $("#finish").attr("style","display: none");
          $("#back").attr("style","display: none");
          $("#details").attr("style","display: none");

        });

        $('#next').click(function() {

          $("#next").attr("style","display: none");
          $("#agregar").attr("style","display: none");
          $("#newBuy").attr("style","display: none");

          $("#back").removeAttr("style");
          $("#finish").removeAttr("style");
          $("#details").removeAttr("style");

          var folio = $('#idcompra').val();
          $('#folio').val(folio);

          var request;

          if(request)
            request.abort();

          request = $.ajax({
            url: "<?=base_url('Buy/GetMonto')?>",
            type: "POST",
            data: "folio=" + folio
          });

          request.done(function (response, textStatus, jqXHR){
            $('#dinero').val(response);
          });

          request.fail(function(jqXHR,textStatus, thrown){
          });

          event.preventDefault();

        });

        $('#back').click(function() {
          $("#next").removeAttr("style");
          $("#newBuy").removeAttr("style");
          $("#agregar").removeAttr("style");

          $("#finish").attr("style","display: none");
          $("#back").attr("style","display: none");
          $("#details").attr("style","display: none");

        });

        $('#money').on('input',function(e){

          var total = parseFloat($('#dinero').val());
          var pago = parseFloat($('#money').val());

          var cambio = pago - total;

          if(cambio < 0)
          {
            $("#cambio").html(
              "<span id = 'message' style = 'color: rgb(231, 60, 60); font-weight: bold;'>" +
              "Faltan $" + cambio * -1 + " pesos</span><br><br>");
            $("#finish").attr("disabled","disabled");
          }
          else if(cambio > 0)
          {
            $("#cambio").html(
              "<span id = 'message' style = 'color: rgb(231, 60, 60); font-weight: bold;'>" +
              "Regresar $" + cambio + " pesos</span><br><br>");
            $("#finish").removeAttr("disabled");
          }
          else if(cambio == 0)
          {
            $("#cambio").html(
              "<span id = 'message' style = 'color: rgb(231, 60, 60); font-weight: bold;'>" +
              "Pago Exacto!</span><br><br>");
            $("#finish").removeAttr("disabled");
          }

        });

        $('#finish').click(function()
        {

          var total = $('#dinero').val();
          var folio = $('#folio').val();

          $.post("<?=base_url()?>Buy/SetPrice", {
            total : total, folio : folio},
            function(data) {
              console.log(data);
          });

          $.post("<?=base_url()?>Buy/UpdateStock", {
            folio : folio},
            function(data) {
              console.log(data);
          });

          $("#producto").html('');
          $("#cdetalles").html('<tr></tr>');
          $("#cambio").html('');
          $("#cantidad").val('');
          $("#money").val('');
          $("#cantidad").attr("disabled","disabled");
          $("#agregar").attr("disabled","disabled");
          $("#next").attr("disabled","disabled");

          $("#next").removeAttr("style");
          $("#newBuy").removeAttr("style");
          $("#agregar").removeAttr("style");

          $("#finish").attr("style","display: none");
          $("#back").attr("style","display: none");
          $("#details").attr("style","display: none");

        });

      });

      function borrar(num) {
        $(document).ready(function () {

          var folio = $('#idcompra').val();

          var request;

          if(request)
            request.abort();

          request = $.ajax({
            url: "<?=base_url('Buy/DeleteItem')?>",
            type: "POST",
            data: "item=" + num + "&folio=" + folio
          });

          request.done(function (response, textStatus, jqXHR){
            $("#t" + response).remove();
          });

          request.fail(function(jqXHR,textStatus, thrown){
            console.log("Error:" + textStatus);
          });

        });
      }
    </script>
