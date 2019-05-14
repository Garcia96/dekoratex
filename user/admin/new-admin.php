<!DOCTYPE html>
<html>
<?php require("../../login/authenticate.php"); ?>
<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" type="image/x-icon" href="../../image/favicon.ico">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../../estilo_index.css">
  <title>Dekoratex - Nuevo Administrador</title>
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
          <a class="navbar-brand " href="../../index.php"><img src="../../image/logo2.png" class="imagenheader" alt="Logo" /></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class=""><a href="admin.php"><span class="glyphicon glyphicon-globe glyphicon-globe"></span> Inicio <span class="sr-only">(current)</span></a></li>
            <li class=""><a href="inventory.php" ><span class="glyphicon glyphicon-list-alt"></span> Inventario</a></li>
            <li class=""><a href="customer.php"><span class="glyphicon glyphicon-user cli"></span> Usuarios</a></li>
            <li class=""><a href="sales.php"><span class="glyphicon glyphicon-usd"></span> Ventas</a></li>
            <li class=""><a href="providers.php"><span class="glyphicon glyphicon-edit"></span> Proveedores</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li style="display:inline-block" class="facebook"><a href="https://www.facebook.com/Decoratex-1397698147200574/?fref=ts" target="_blank" class=""><i class="fa fa-facebook color_fb"></i></a></li>
            <li style="display:inline-block" class="twitter"><a href="https://twitter.com/Decoratex3" target="_blank" class=""><i class="fa fa-twitter color_tt"></i></a></li>
            <?php
            if(isset($_SESSION['username'])){
                echo "<li class='dropdown'>
                  <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'><span class='glyphicon glyphicon-user'></span> ".$_SESSION['username']." <span class='caret'></span></a>
                  <ul class='dropdown-menu'>
                    <li><a href='admin.php'>Administrar</a></li>
                    <li><a href='../index.php'>Ver mi cuenta</a></li>
                    <li><a href='../../login/logout.php'>Cerrar Sesion</a></li>
                  </ul>
                </li>";
            }else{
                echo "<li style='align:center'><a href='../../login/index.php'><strong>Inicia Sesion / Registrarse</strong></a></li>";
            } ?>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>

  <div class=" fondo">
    <div class="container">
      <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
          <?php
          error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
          if(isset($_GET['r'])){
            echo "<div class='col-sm-6 col-sm-offset-3'>
                  <br><p align='center'>".$_GET['r']."</p>
                 </div><br><br>";
          }?>
          <h2 class="text-center">Nuevo Administrador</h2>
          <form method="post">
            <div class="form-group">
              Nombre: <font color=red>*</font><input class="form-control" type="text" name="nombre" value="" placeholder="Nombre" required >
              Apellido: <font color=red>*</font><input class="form-control" type="text" name="apellido" value="" placeholder="Apellido"required >
              Cedula: <font color=red>*</font><input class="form-control" type="text" name="cedula" value="" placeholder="Cedula"required >
              fecha: <span class="sr-only"> dd/mm/aa </span><font color=red>*</font><input class="form-control" type="date" name="fecha" value="" placeholder="" width="50%" required ><br><br>
              Direccion: <font color=red>*</font><input class="form-control" type="text" name="direccion" value="" placeholder="Direccion"required >
              Telefono: <font color=red>*</font><input class="form-control" type="text" name="telefono" value="" placeholder="Telefono"required ><br><br>
              Correo: <font color=red>*</font><input class="form-control" type="email" name="correo" value="" placeholder="example@example.com"required >
              Contraseña:<font color=red>*</font><input class="form-control" type="password" name="contraseña" value="" placeholder="*********"required >
              Confirmar Contraseña:<font color=red>*</font><input class="form-control" type="password" name="contraseña2" value="" required placeholder="*********"><br><br>
            </div>
            <div class="form-group">
              <div class="col-sm-3 col-sm-offset-2">
                <input type="submit" class="btn btn-primary btn-block" name="nuevoadmin" value="Añadir">
              </div>
          </form>
          <?php
    require('../../login/conexion.php');
    if(isset($_POST['nuevoadmin'])){
    $id = mysqli_query($conexion,"select idUser from user where idUser = '".$_POST['cedula']."'");
    $num = mysqli_num_rows($id);
    $co = mysqli_query($conexion,"select email from user where email = '".$_POST['correo']."'");
    $nu = mysqli_num_rows($co);
    if($num == 0){
        if($nu == 0){
            if( isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['cedula']) && isset($_POST['fecha']) && isset($_POST['direccion'])
            && isset($_POST['telefono']) && isset($_POST['correo']) && isset($_POST['contraseña']) && isset($_POST['contraseña2'])
            && ($_POST['contraseña2'] == $_POST['contraseña'])){
                $query = "insert into user values ('$_POST[cedula]','$_POST[nombre]','$_POST[apellido]','$_POST[correo]','". sha1(md5($_POST[contraseña]))."'
                ,'$_POST[direccion]','$_POST[telefono]','$_POST[fecha]',CURDATE(),'1','1',NULL)";
                $respuesta = mysqli_query($conexion,$query);
                $r= "Registro exitoso";
                echo "<script>location.href='new-admin.php?r=".$r."'</script>";
            }else{
                $r= "Las contraseñas no coinciden";
                echo "<script>location.href='new-admin.php?r=".$r."'</script>";
            }
        }else{
            $r = "El correo suministrado ya se encuentra registrado";
            echo "<script>location.href='new-admin.php?r=".$r."'</script>";
        }
    }else{
        $r = "El numero de identificación suministrado ya se encuentra registrado";
        echo "<script>location.href='new-admin.php?r=".$r."'</script>";
    }
  } ?>
              <div class="col-sm-3 col-sm-offset-2">
                <a href="admin.php" class="btn btn-info btn-block">Cancelar</a>
              </div>
            </div>
        </div>
      </div>
    </div><br><br>
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
