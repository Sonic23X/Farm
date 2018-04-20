    <link rel="stylesheet" href= "<?=base_url()?>resources/css/sidebar.css">

    <div class="wrapper">
      <nav id="sidebar" class = "active">
        <div class="sidebar-header">
          <h3>Farmacia X</h3>
          <strong>FX</strong>
        </div>

        <ul class="list-unstyled components">
          <li <?php if($inicio) { ?>class="active"<?php } ?>>
            <a href="<?=base_url()?>">
              <i class="fa fa-home"></i>
              Inicio
            </a>
          </li>
          <li <?php if($inventario) { ?>class="active"<?php } ?>>
            <a href="<?=base_url('Inventary')?>">
              <i class="fa fa-shopping-bag"></i>
              Inventario
            </a>
          </li>
          <li <?php if($reporte) { ?>class="active"<?php } ?>>
            <a href="<?=base_url('Report')?>">
              <i class="fa fa-file-text"></i>
              Reporte
            </a>
          </li>
          <?php
            if($ver) {
          ?>
          <li <?php if($usuarios) { ?>class="active"<?php } ?>>
            <a href="<?=base_url()?>User">
              <i class="fa fa-users"></i>
              Usuarios
            </a>
          </li>
          <?php
            }
          ?>
          <li>
            <a href="#about" data-toggle = "modal">
              <i class="fa fa-comment"></i>
              Acerca de
            </a>
          </li>
        </ul>
      </nav>

      <div id="content">
