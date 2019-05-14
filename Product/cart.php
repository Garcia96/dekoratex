<!DOCTYPE html>
<?php session_start(); ?>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="shortcut icon" type="image/x-icon" href="../image/favicon.ico">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../css/jquery.simplecolorpicker.css">
        <link rel="stylesheet" href="../css/jquery.simplecolorpicker-regularfont.css">
        <link rel="stylesheet" href="../css/jquery.simplecolorpicker-glyphicons.css">
        <link rel="stylesheet" href="../css/jquery.simplecolorpicker-fontawesome.css">
        <link rel="stylesheet" href="../estilo_index.css">
        <title>Carrito - </title>
    </head>
    <body style="padding-top: 50px;">

        <header>
          <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand " href="../index.php"><img src="../image/logo2.png"  class="imagenheader" alt="Logo" /></a>
              </div>

              <!-- Collect the nav links, forms, and other content for toggling -->
              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                  <li class=""><a href="../index.php"><span class="glyphicon glyphicon-globe glyphicon-globe"></span> Inicio <span class="sr-only">(current)</span></a></li>
                  <li class="dropdown ">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-shopping-cart glyphicon-shopping-cart"></span> Productos <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <?php
                      include "../login/conexion.php";

                      $resultado=mysqli_query($conexion,"select * from product where offered=1 ");
                      while($f=mysqli_fetch_array($resultado)){
                       ?>
                      <li><a href=index.php?idp=<?php echo $f['idProd'];?>&np=<?php echo $f['Name']?>><?php echo $f['Name']; ?></a></li>
                      <?php
                      }
                       ?>
                    </ul>
                  </li>
                  <li ><a href="../us.php"><span class="glyphicon glyphicon-info-sign glyphicon-info-sign"></span> Nosotros</a></li>
                  <li><a href="../contact.php"><span class="glyphicon glyphicon-envelope glyphicon-envelope"></span> Contacto</a></li>
                  <?php if(isset($_SESSION['username'])){
                    if($_SESSION['role']== false){
                      echo '<li class="active"><a href="cart.php" class=""><span class="glyphicon glyphicon-list-alt"></span> Carro de compras</a></li>';
                    }
                  } ?>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                  <li style="display:inline-block"><a href="#ventana1" data-toggle="modal"><span class="glyphicon glyphicon-search"></span></a>

                  </li>
                  <li style="display:inline-block" class="facebook"><a href="https://www.facebook.com/Decoratex-1397698147200574/?fref=ts" target="_blank" class=""><i class="fa fa-facebook color_fb"></i></a></li>
                  <li style="display:inline-block" class="twitter"><a href="https://twitter.com/Decoratex3" target="_blank" class=""><i class="fa fa-twitter color_tt"></i></a></li>
                  <?php

                  if(isset($_SESSION['username'])){
                      echo "<li class='dropdown'>";
                      echo "<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'><span class='glyphicon glyphicon-user'></span> ".$_SESSION['username']." <span class='caret'></span></a>";
                      echo "<ul class='dropdown-menu'>";
                      if($_SESSION['role'] == false){
                        echo "<li><a href='../user/index.php'>Ver mi cuenta</a></li>";
                        echo "<li><a href='../login/logout.php'>Cerrar Sesion</a></li>";
                      }else{
                        echo "<li><a href='../user/admin/admin.php'>Administrar</a></li>";
                        echo "<li><a href='../user/index.php'>Ver mi cuenta</a></li>";
                        echo "<li><a href='../login/logout.php'>Cerrar Sesion</a></li>";
                      }
                      echo "</ul>";
                      echo "</li>";
                  }else{
                      echo "<li style='align:center'><a href='../login/index.php'><strong>Inicia Sesion / Registrarse</strong></a></li>";
                  } ?>
                </ul>
              </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
          </nav>
        </header>
        <div class="modal fade" id="ventana1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h2 class="modal-title">Buscar</h4>
              </div>
              <form method="get" action="../Search.php">
                <div class="modal-body">
                  <div class="form-group"><br>
                      <input class="form-control" type="text" name="s" placeholder="keywords" required>
                  </div><br>
                  <input type="submit" value="Buscar" class="btn btn-primary">
                </div>
              </form>
            </div>
          </div>
        </div><br>

      <form action="sale.php" method="post">
         <div class="fondo">
          <div class="container">
            <div class="table-responsive">
              <table class="table table-hover">

                <thead>
                  <th >
                    <h3>Producto</h3>
                  </th>
                  <th style="width:40%">
                  <h3>  Articulo</h3>
                  </th>
                  <th >
                    <h3>Cantidad</h3>
                  </th>
                  <th style="width:15%">
                    <h3>Subtotal</h3>
                  </th>
                </thead>
                <tbody id="contiene-carrito-productos" >
                </tbody>
              </table>
            </div>
          </div>
        </div><br>
        </form>

    <footer class="footer-basic-centered">
        <div class="container-fluid" >
            <div class="col-xs-6">
                <p class="copy">&copy; Dekoratex - 2016<br>
                    Daniel Navarro<br>
                    Nicolas Garcia
                </p>
            </div>
            <div class="col-xs-6">
                <ul class="list-inline text-right">
                  <li class="facebook"><a href="https://www.facebook.com/Decoratex-1397698147200574/?fref=ts" target="_blank" class="btn btn-primary"><i class="fa fa-facebook"></i></a></li>
                 <li class="twitter"><a href="https://twitter.com/Decoratex3" target="_blank" class="btn btn-primary"><i class="fa fa-twitter"></i></a></li>
                </ul>
            </div>
        </div>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="../js/jquery.simplecolorpicker.js"></script>
    <script src="/Decoratex/js/bigSlide.min.js"></script>
    <script  src="../js/codjs_carritoventas.js"></script>
    <script  src="../js/codjs_cart.js"></script>
    <script src="../js/js.cookie.js"></script>
    </body>
</html>
