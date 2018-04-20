    <link type="text/css" rel="Stylesheet" href="<?= base_url()?>resources/css/login.css">

    <br><br><br><br><br>

    <section class="wrapper">
      <form action="<?= base_url()?>User/Start" method="post" id="login" class="formulario">
        <h3 class="form-cab" style="aling: center">Iniciar Sesión</h3>
        <hr class="colorgraph"><br>
        <input type="text" name="nick" id="nick" class="form-control" placeholder="Usuario" required autofocus="">
        <br>
        <input type="password" name="password" id="pass" class="form-control" placeholder="Contraseña" required>
        <input type="submit" value="Entrar!" class="btn btn-lg btn-block">
        <br>
        <p id="result" align = center>

        </p>
      </form>
    </section>

    <br><br><br><br>

    <script type="text/javascript" src = "<?= base_url()?>resources/js/login.js"></script>
