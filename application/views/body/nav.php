    <link rel="stylesheet" href="<?=base_url()?>resources/css/nav.css">
    <script src="<?=base_url()?>resources/js/nav.js" type="text/javascript"></script>

    <nav class="navbar navbar-default navbar-custom">
      <div class="container-fluid">
        <div class="navbar-header page-scroll">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Navegación</span>
              Menu <i class="fa fa-bars"></i>
          </button>
          <?php
            if($this->session->userdata('login'))
            {
          ?>
          <span class="navbar-brand"><?=$usuario?>
            <a id="sidebarCollapse"><span id="icono" class = "fa fa-chevron-right"></span></a>
          </span>
          <?php
            }
          ?>
        </div>
        <!--Computadora-->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <?php
              if($this->session->userdata('login'))
              {
            ?>
            <li>
              <a id="com" href="#compra" data-toggle = "modal"><span class = "fa fa-plus-circle"></span> Nueva Compra</a>
            </li>
            <li>
              <a href="<?= base_url()?>User/End"><span class = "fa fa-times"></span> Salir</a>
            </li>
            <?php
              }
            ?>
          </ul>
        </div>
    </nav>

    <script type="text/javascript">

      $(document).ready(function () {
        $('#com').click(function() {

          var request;

          if(request)
            request.abort();

          request = $.ajax({
            url: "<?=base_url('Buy/CreateBuy')?>",
            type: "POST"
          });

          request.done(function (response, textStatus, jqXHR){
            $('#idcompra').val(response);
          });

          request.fail(function(jqXHR,textStatus, thrown){
            console.log("Error:" + textStatus);
          });

          event.preventDefault();

        });
      });

    </script>
