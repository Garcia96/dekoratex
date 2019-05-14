<!DOCTYPE html>
<html>
<?php require("login/conexion.php") ?>
<head>
  <link rel="shortcut icon" type="image/x-icon" href="image/favicon.ico">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="estilo_index.css">
  <title>Dekoratex - Busqueda</title>
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
            <li ><a href="index.php"><span class="glyphicon glyphicon-globe glyphicon-globe"></span> Inicio <span class="sr-only">(current)</span></a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-shopping-cart glyphicon-shopping-cart"></span> Productos <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <?php
                include "login/conexion.php";

                $resultado=mysqli_query($conexion,"select * from product where offered=1");
                while($f=mysqli_fetch_array($resultado)){
                 ?>
                <li><a href=Product/index.php?idp=<?php echo $f['idProd'];?>&np=<?php echo $f['Name']?>><?php echo $f['Name']; ?></a></li>
                <?php
                }
                 ?>
              </ul>
            </li>
            <li ><a href="us.php"><span class="glyphicon glyphicon-info-sign glyphicon-info-sign"></span> Nosotros</a></li>
            <li><a href="contact.php"><span class="glyphicon glyphicon-envelope glyphicon-envelope"></span> Contacto</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li style="display:inline-block"><a href="#ventana1" data-toggle="modal"><span class="glyphicon glyphicon-search"></span></a>
            </li>
            <li style="display:inline-block" class="facebook"><a href="https://www.facebook.com/Decoratex-1397698147200574/?fref=ts" target="_blank" class=""><i class="fa fa-facebook color_fb"></i></a></li>
            <li style="display:inline-block" class="twitter"><a href="https://twitter.com/Decoratex3" target="_blank" class=""><i class="fa fa-twitter color_tt"></i></a></li>
            <?php
            session_start();
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

  <div class="fondo">
    <div class="container">
      <div class="row">
        <div class="col-xs-6">
          <h2>Resultados para <?php echo $_GET['s']; ?></h2><br>
        </div>
        <div class="col-xs-6">
          <form method="get" class="form-inline" action="Search.php">
            <input type="text" class="form-control pull-right" name="s" placeholder="keywords" required>
            <input type="submit" class="btn btn-primary pull-right" value="Buscar">
          </form>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-9">
          <div class="media">
            <?php $consulta=mysqli_query($conexion,"select *,b.Description as description,a.Name as Namep,d.Name as Namem,b.Name as Namet,c.idtype as idut,c.idMat as idum from product as a JOIN type as b on a.idProd=b.idProd JOIN type_material as c on b.idtype=c.idtype join material as d on c.idMat=d.idMat WHERE a.Name like '%".$_GET['s']."%' or b.Name like '%".$_GET['s']."%' or d.Name like '%".$_GET['s']."%' and b.offered=1");
            while ($a=mysqli_fetch_array($consulta)) {

            ?>
            <div class="media-left">
                <a href=Product/product-detail.php?im=<?php echo $a['Image'] ?>&n=<?php echo $a['Namep'] ?>>
                <img class="media-object" src="image/productos/<?php echo $a['Image'] ?>" alt="item-resultado">
              </a>
            </div>
            <div class="media-body">
              <h4 class="media-heading"><?php echo $a['Namep']." ".$a['Namet']." ".$a['Namem'] ?></h4><br>
              <h5 class="media-heading"><?php echo $a['description']?></h5>

            </div><br>
            <?php   }
          ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <br>
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
                <li class="facebook"><a href="https://www.facebook.com/Decoratex-1397698147200574/?fref=ts" target="_blank" class="btn btn-primary"><i class="fa fa-facebook"></i></a></li>
               <li class="twitter"><a href="https://twitter.com/Decoratex3" target="_blank" class="btn btn-primary"><i class="fa fa-twitter"></i></a></li>
              </ul>
          </div>
      </div>
  </footer>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>
