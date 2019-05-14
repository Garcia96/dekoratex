<!DOCTYPE html>
<?php session_start(); ?>
<html>

<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" type="image/x-icon" href="image/favicon.ico">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="estilo_index.css">


  <title>Historia</title>
</head>

<body style="padding-top: 52px;">

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
          <a class="navbar-brand " href="index.php"><img src="image/logo2.png" class="imagenheader" alt="Logo" /></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class=""><a href="index.php"><span class="glyphicon glyphicon-globe glyphicon-globe"></span> Inicio <span class="sr-only">(current)</span></a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-shopping-cart glyphicon-shopping-cart"></span> Productos <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <?php
                include "login/conexion.php";

                $resultado=mysqli_query($conexion,"select * from product where offered=1 ");
                while($f=mysqli_fetch_array($resultado)){
                 ?>
                <li><a href=Product/index.php?idp=<?php echo $f['idProd'];?>&np=<?php echo $f['Name']?>><?php echo $f['Name']; ?></a></li>
                <?php
                }
                 ?>
              </ul>
            </li>
            <li class="active"><a href="us.php"><span class="glyphicon glyphicon-info-sign glyphicon-info-sign"></span> Nosotros</a></li>
            <li><a href="contact.php"><span class="glyphicon glyphicon-envelope glyphicon-envelope"></span> Contacto</a></li>
            <?php if(isset($_SESSION['username'])){
              if($_SESSION['role']== false){
                echo '<li><a href="Product/cart.php"><span class="glyphicon glyphicon-list-alt"></span> Carro de compras</a></li>';
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
                  echo "<li><a href='user/index.php'>Ver mi cuenta</a></li>";
                  echo "<li><a href='login/logout.php'>Cerrar Sesion</a></li>";
                }else{
                  echo "<li><a href='user/admin/admin.php'>Administrar</a></li>";
                  echo "<li><a href='user/index.php'>Ver mi cuenta</a></li>";
                  echo "<li><a href='login/logout.php'>Cerrar Sesion</a></li>";
                }
                echo "</ul>";
                echo "</li>";
            }else{
                echo "<li style='align:center'><a href='login/index.php'><strong>Inicia Sesion / Registrarse</strong></a></li>";
            } ?>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <div class="modal fade" id="ventana1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h2 class="modal-title">Buscar</h4>
        </div>
        <form method="get" action="Search.php">
          <div class="modal-body">
            <div class="form-group"><br>
                <input class="form-control" type="text" name="s" placeholder="keywords" required>
            </div><br>
            <input type="submit" value="Buscar" class="btn btn-primary">
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="registro"><br>
    <div class="container">
      <div class="row">
          <h2 class="text-center">Nuestra Historia</h2>
      </div>
      <div class="historia">
        <div class="row">
          <div class="col-xs-12 col-sm-6">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="col-xs-3 col-xs-offset-2">
                  <br><br>
                  <button id="pop" type="button" class="btn btn-info btn-block" data-container="body" data-toggle="popover"
                  title="Comienzos" data-content="Fueron dificiles los comienzos con un pequeño local en el barrio alqueria" data-placement="right">2005</button>
                  <br><br>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="col-xs-3 col-xs-offset-7">
                  <br><br>
                  <button id="pop1" type="button" class="btn btn-info btn-block" data-container="body" data-toggle="popover"
                  title="Crecer" data-content="Nuestro numero de clientes fue en aumento, la necesidad de transladarse era evidente" data-placement="left">2008</button>
                  <br><br>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 col-sm-6">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="col-xs-3 col-xs-offset-7">
                  <br><br>
                  <button  id="pop2" type="button" class="btn btn-info btn-block" data-container="body" data-toggle="popover"
                  title="Baches" data-content="Toda empresa en su camino tiene dificultades, por desgracia no somos la excepción pero con ayuda de ustedes logramos superarlos" data-placement="left">2010</button>
                  <br><br>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="col-xs-3 col-xs-offset-2">
                  <br><br>
                  <button  id="pop3" type="button" class="btn btn-info btn-block" data-container="body" data-toggle="popover"
                  title="Renacer" data-content="Aun en el barrio Alqueria pero en un local diferente fue nuestro renacer, las ventas superaron expectativas, esta fue nuestra oportunidad para sobresalir ante los demas" data-placement="right">2013</button>
                  <br><br>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 col-sm-6 col-sm-offset-3">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="col-xs-4 col-xs-offset-4">
                  <button id="pop4" type="button" class="btn btn-info btn-block" data-container="body" data-toggle="popover"
                  title="Ahora" data-content="El camino de Dekoratex ha sido arduo, gracias a ustedes hoy estamos felices y tenemos grandes planes. Esperenlos." data-placement="bottom">2016</button>
                  <br><br><br><br><br><br>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><br>
    <div class="container">
      <div class="row">
        <div class="col-sm-6" style="padding-left: 5%; padding-right: 5%">
          <a href="#seccion" class="btn btn-primary btn-block btn-lg"data-toggle="collapse">Misión</a>
        </div>
        <div class="col-sm-6" style="padding-left: 5%; padding-right: 5%">
          <a href="#seccion1" class="btn btn-primary btn-block btn-lg"data-toggle="collapse">Visión</a>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="collapse" id="seccion">
            <br>
            <div class="well">
              <h4>Misión: Nuestros principales objetivos son proporcionar calor, confort y glamour a los hogares Colombianos mediante nuestras cortinas y persianas; productos de excelente calidad y diseños exclusivos.</h4>
            </div>
          </div>
          <div class="collapse" id="seccion1">
            <br>
            <div class="well">
                <h4>Visión: Nuestra principal meta es lograr consolidarnos como la empresa líder en cortinas y persianas a nivel nacional destacándolos y fortaleciéndonos a través de nuestra organización, nuestra calidad e innovación.</h4>
            </div>
          </div>
        </div>
      </div>
    </div><br>
  </div>  <br>

  <footer class="footer-basic-centered">
      <div class="container">
          <div class="col-xs-6">
              <p class="copy">&copy; Dekoratex - 2016<br>
                  Daniel Navarro<br>
                  Nicolas Garcia
              </p>
          </div>
          <div class="col-xs-6">
              <ul class="list-inline text-right">
                <li class="facebook"><a href="#" class="btn btn-primary"><i class="fa fa-facebook"></i></a></li>
               <li class="twitter"><a href="#" class="btn btn-primary"><i class="fa fa-twitter"></i></a></li>
              </ul>
          </div>
      </div>
  </footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript" language="javascript" src="js/codjs_us.js"></script>
</body>
</html>
