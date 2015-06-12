<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sección de Curiosidades</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

    <style>
    body { padding-top: 50px; }
    .starter-template { padding: 40px 15px; text-align: center; }
    </style>
  </head>

  <body>

    <?php
    include '../Secciones/CodeNavCat.php';
    ?>
      <div class="container-fluid">
          <div class="row">
              <?php include '../Secciones/menu-lateralCat.php'; ?>
          
          <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main"> 
               <h1 class="page-header">Panel de Administración</h1>

          <h4 class="sub-header">Bienvenido, administrador.</h4>
          <p>Por favor seleccione una de las opciones del menú lateral izquierdo.</p>
        
              
        </div>
      </div><!-- /.container -->
      </div>
    <!-- Bootstrap core JavaScript ================================================== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
  </body>
</html>
