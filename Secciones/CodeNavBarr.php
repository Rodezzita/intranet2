<!-- CodeNavBar
================================================== -->
<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a class="navbar-brand" href="index.php"><img src="Imagenes/logo.png" width="150" height="25">
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <form class="navbar-form navbar-right" action="scripts/iniciar-sesion.php" method="POST">
            <div class="form-group">
              <input type="text" placeholder="Usuario" class="form-control" name="txtUsuario">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Contraseña" class="form-control" name="txtClave">
            </div>
            <button type="submit" class="btn btn-success">Iniciar sesión</button>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>