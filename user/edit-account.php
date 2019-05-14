<?php
session_start();
if(isset($_SESSION['autentificado'])){
?>
<!DOCTYPE html>
<html>
<?php require("../login/conexion.php"); ?>
<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" type="image/x-icon" href="../image/favicon.ico">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../estilo_index.css">
  <title>Editar - <?php echo $_SESSION['username'];?></title>
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
          <a class="navbar-brand " href="../index.php"><img src="../image/logo2.png" class="imagenheader" alt="Logo" /></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <?php
            if($_SESSION['role'] == false){
              echo '<li class=""><a href="../index.php"><span class="glyphicon glyphicon-globe glyphicon-globe"></span> Inicio <span class="sr-only">(current)</span></a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-shopping-cart glyphicon-shopping-cart"></span> Productos <span class="caret"></span></a>
              <ul class="dropdown-menu">';

              include "../login/conexion.php";

              $resultado=mysqli_query($conexion,"select * from product where offered=1 ");
              while($f=mysqli_fetch_array($resultado)){
                ?>
                <li><a href=../product/index.php?idp=<?php echo $f['idProd'];?>&np=<?php echo $f['Name']?>><?php echo $f['Name']; ?></a></li>
              <?php
                }

            echo'  </ul>
            </li>
            <li ><a href="../us.php"><span class="glyphicon glyphicon-info-sign glyphicon-info-sign"></span> Nosotros</a></li>
            <li><a href="../contact.php"><span class="glyphicon glyphicon-envelope glyphicon-envelope"></span> Contacto</a></li>';
            }else{
              echo '<li class=""><a href="admin/admin.php"><span class="glyphicon glyphicon-globe glyphicon-globe"></span> Inicio <span class="sr-only">(current)</span></a></li>
            <li class=""><a href="admin/inventory.php" ><span class="glyphicon glyphicon-list-alt"></span> Inventario</a></li>
            <li class=""><a href="admin/customer.php"><span class="glyphicon glyphicon-user cli"></span> Usuarios</a></li>
            <li class=""><a href="admin/sales.php"><span class="glyphicon glyphicon-usd"></span> Ventas</a></li>
            <li class=""><a href="admin/providers.php"><span class="glyphicon glyphicon-edit""></span> Proveedores</a></li>';
            }
             ?>
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
                  echo "<li><a href='index.php'>Ver mi cuenta</a></li>";
                  echo "<li><a href='../login/logout.php'>Cerrar Sesion</a></li>";
                }else{
                  echo "<li><a href='admin/admin.php'>Administrar</a></li>";
                  echo "<li><a href='index.php'>Ver mi cuenta</a></li>";
                  echo "<li><a href='../login/logout.php'>Cerrar Sesion</a></li>";
                }
                echo "</ul>";
                echo "</li>";
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
  </div>
  <?php
  $query ="select * from user where Name='".$_SESSION['username']."'";
  $respuesta = mysqli_query($conexion, $query);
  $idrole;
  $aut;
  if($dato = mysqli_fetch_array($respuesta)){
    $id = $dato['idUser'];
    $nom = $dato['Name'];
    $apellido = $dato['Lastname'];
    $mail = $dato['email'];
    $pass = $dato['password'];
    $dir = $dato['Address'];
    $tel = $dato['phone'];
    $role = $dato['idrole'];
  }
  if($role == 1){
      $idrole = true;
      $aut = true;
    }else{
      $idrole = false;
      $aut = true;
    }
  ?>
  <div class=" fondo" name="a">
    <?php
      echo "<div class='col-sm-6 col-sm-offset-3' name='b'>
            <br><font color=gray><h4 align='center' id='respuesta'></h4></font>
           </div><br>";
    ?>
    <div class="container">
      <div class="row">
        <div style="padding-left: 10%; padding-right: 10%;">
          <div class="col-sm-10 col-sm-offset-1">
              <div class="text-center"><h2><?php echo "".$_SESSION['username']." "; echo $apellido;?></h2></div>
            <form method="post" name="formualrio">
                <div class="form-group">
                  Nombre: <font color=red>*</font>
                  <input type="text" class="form-control" name="nombre" value='<?php echo $nom; ?>' placeholder="Nombre" required>
                  Apellido: <font color=red>*</font>
                  <input type="text" class="form-control" name="apellido" value='<?php echo $apellido; ?>' placeholder="Apellido" required>
                  Dirección: <font color=red>*</font>
                  <input type="text" class="form-control" name="direccion" value='<?php echo $dir ?>' placeholder="Direccion"required >
                  Telefono: <font color=red>*</font>
                  <input type="text" class="form-control" name="tel" value='<?php echo $tel; ?>' placeholder="Telefono" required>
                  Correo: <font color=red>*</font>
                  <input type="email" class="form-control" name="correo" value='<?php echo $mail; ?>' placeholder="example@example.com" requiered>
                </div><br>
                <div class="form-group">
                  Nueva Contraseña:
                  <input type="password" class="form-control" name="pas1" placeholder="**********">
                  Repetir Contraseña:
                  <input type="password" class="form-control" name="pas2" placeholder="**********">
                </div>
                <div class="form-grpup">
                  <div class="col-sm-4 col-sm-offset-1">
                    <input type="submit" class="btn btn-default btn-block" name="guardar" value="Guardar">
                  </div>
                  <div class="col-sm-4 col-sm-offset-2">
                    <a href="index.php" class=" btn btn-primary pull-right btn-block" type="button" name="volver" ><span class="glyphicon glyphicon-arrow-left"></span> Volver</a><br><br>
                  </div>
                </div>
              </form>
              <?php
              if(isset($_POST['guardar'])){
                $contra1 = $_POST['pas1'];
                $contra2 = $_POST['pas2'];
                $nom = $_POST['nombre'];
                $ape = $_POST['apellido'];
                $cor = $_POST['correo'];
                $dir = $_POST['direccion'];
                $pho = $_POST['tel'];
                if(empty($contra1) && empty($contra2)){
                  $resultado = mysqli_query($conexion,"update user set Name='$nom', Lastname='$ape', email='$cor', Address='$dir', phone=$pho where idUser= '$id'");
                  session_unset();
                  session_destroy();
                  session_start();
                  $_SESSION['autentificado']= $aut;
                  $_SESSION['role'] = $idrole;
                  $_SESSION['username']= $nom;
                  echo "<script> location.href='index.php'</script>";
                }else if(empty($contra1) || empty($contra2)){
                  echo '<script type="text/javascript">
                          var res = "Las contraseñas no coninciden"
                          document.getElementById("respuesta").innerHTML=res
                        </script>';
                }else if($contra1==$contra2){
                  $query2 ="update user set Name='$nom', Lastname='$ape', email='$cor', password='".sha1(md5($contra1))."', Address='$dir', phone=$pho where idUser= '$id'";
                  $resultado = mysqli_query($conexion,$query2);
                  session_unset();
                  session_destroy();
                  session_start();
                  $_SESSION['autentificado']= $aut;
                  $_SESSION['role'] = $idrole;
                  $_SESSION['username']= $nom;
                  echo "<script> location.href='index.php'</script>";
                }else{
                  echo '<script type="text/javascript">
                          var res = "Las contraseñas no coninciden"
                          document.getElementById("respuesta").innerHTML=res
                        </script>';
                }
              }
               ?>
          </div><br><br><br>
        </div><br>
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
<?php
  }else{
    echo "<script> location.href='../index.php'</script>";
  }
?>
