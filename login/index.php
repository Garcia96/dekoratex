<?php
session_start();
if(isset($_SESSION['autentificado'])){
  echo "<script> location.href='../index.php'</script>";
}else{
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" type="image/x-icon" href="../image/favicon.ico">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../estilo_index.css">
  <title>Dekoratex - Ingresar/Registro</title>
</head>
<body style="padding-top: 100px;">
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
          <a class="navbar-brand " href="../index.php"><img src="../image/logo2.png" class="imagenheader" alt="Logo" /></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class=""><a href="../index.php"><span class="glyphicon glyphicon-globe glyphicon-globe"></span> Inicio <span class="sr-only">(current)</span></a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-shopping-cart glyphicon-shopping-cart"></span> Productos <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <?php
                include "../login/conexion.php";

                $resultado=mysqli_query($conexion,"select * from product ");
                while($f=mysqli_fetch_array($resultado)){
                 ?>
                <li><a href=../Product/index.php?idp=<?php echo $f['idProd']; ?>&np=<?php echo $f['Name']?>><?php echo $f['Name']; ?></a></li>
                <?php
                }
                 ?>
              </ul>
            </li>
            <li><a href="../us.php"><span class="glyphicon glyphicon-info-sign glyphicon-info-sign"></span> Nosotros</a></li>
            <li><a href="../contact.php"><span class="glyphicon glyphicon-envelope glyphicon-envelope"></span> Contacto</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li style="display:inline-block"><a href="#ventana1" data-toggle="modal"><span class="glyphicon glyphicon-search"></span></a>

            </li>
            <li style="display:inline-block" class="facebook"><a href="https://www.facebook.com/Decoratex-1397698147200574/?fref=ts" target="_blank" class=""><i class="fa fa-facebook color_fb"></i></a></li>
            <li style="display:inline-block" class="twitter"><a href="https://twitter.com/Decoratex3" target="_blank" class=""><i class="fa fa-twitter color_tt"></i></a></li>
            <?php
            if(isset($_SESSION['username'])){
                echo "<li class='dropdown'>
                  <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'><span class='glyphicon glyphicon-user'></span> ".$_SESSION['username']." <span class='caret'></span></a>
                  <ul class='dropdown-menu'>
                    <li><a href='../user/index.php'>Ver mi cuenta</a></li>
                    <li><a href='../login/logout.php'>Cerrar Sesion</a></li>
                  </ul>
                </li>";
            }else{
                echo "<li style='align:center'><a href='../login/index.php'><strong>Inicia Sesion / Registrarse</strong></a></li>";
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

<div class="container registro">
  <?php
  error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
  if(isset($_GET['respuesta'])){
    echo "<div class='col-sm-6 col-sm-offset-3'>
          <br><p align='center'>".$_GET['respuesta']."</p>
         </div>";
  }?>
  <div class="col-md-12 "  style="padding: 5%;">
    <div role="tabpanel">
      <ul class="nav nav-tabs nav-justified" role="tablist">
        <li role="presentation" class="active"><a href="#seccion1" aria-contorls="seccion1" data-toggle="tab" role="tab">Ingresar</a></li>
        <li role="presentation"><a href="#seccion2" aria-contorls="seccion2" data-toggle="tab" role="tab">Registrarse</a></li>
      </ul><br>
      <div class="tab-content">
        <div role="tab-panel" class="tab-pane active" id="seccion1"><br>
          <h3 align="center"><strong>INICIAR SESIÓN</strong></h3><br>
          <div style="padding-left: 10%; padding-right: 10%;">
            <form method="post" action="validation.php" name="formulario">
              <label for="">Correo</label>
              <input class="form-control" type="email" name="email" placeholder="example@example.com" required><br>
              <label for="">Contraseña</label>
              <input class="form-control" type="password" name="pass" placeholder="*************" required><br>
              <a href="recover.php" type="button" style="font-size: 12px" name="olv" class="pull-right">Olvide la contraseña</a><br>
              <input type="submit" name="enviar" class="btn btn-primary" value="Iniciar Sesión">
            </form>
          </div>
        </div>
        <div role="tab-panel" class="tab-pane" id="seccion2"><br>
          <h3 align=center>
              <strong>FORMULARIO DE REGISTRO</strong>
          </h3>
          <form method="post" action="registro.php">
            <div style="padding-left: 10%; padding-right: 10%;"><br>
              Nombre: <font color=red>*</font><input class="form-control" type="text" name="nombre" value="" placeholder="Nombre" required >
              Apellido: <font color=red>*</font><input class="form-control" type="text" name="apellido" value="" placeholder="Apellido"required >
              Cedula: <font color=red>*</font><input class="form-control" type="text" name="cedula" value="" placeholder="Cedula"required >
              fecha: <span class="sr-only"> dd/mm/aa </span><font color=red>*</font><input class="form-control" type="date" name="fecha" value="" placeholder="" width="50%" required ><br><br>
              Direccion: <font color=red>*</font><input class="form-control" type="text" name="direccion" value="" placeholder="Direccion"required >
              Telefono: <font color=red>*</font><input class="form-control" type="text" name="telefono" value="" placeholder="Telefono"required ><br><br>
              Correo: <font color=red>*</font><input class="form-control" type="email" name="correo" value="" placeholder="example@example.com"required >
              Contraseña:<font color=red>*</font><input class="form-control" type="password" name="contraseña" value="" placeholder="*********"required >
              Confirmar Contraseña:<font color=red>*</font><input class="form-control" type="password" name="contraseña2" value="" required placeholder="*********"><br><br>
              <div class="form-group" >
                <div class="col-md-6 col-md-offset-3" style="padding-left: 10%; padding-right: 10%;">
                  <input class="form-control btn btn-primary" type="submit" name="registrarse" value="REGISTRARSE">
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
  <br>
<footer class="footer-basic-centered">
  <div class="container-fluid">
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
<?php
  }
?>
