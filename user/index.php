<?php
session_start();
if(isset($_SESSION['autentificado'])){
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
  <title>Dekoratex - Cuenta</title>
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

  <div class=" fondo">
    <div class="container">
      <div class="row">
        <?php if($_SESSION['role'] == false){
          require("../login/conexion.php");
          $query = "select * from user where Name = '".$_SESSION['username']."'";
          $consulta = mysqli_query($conexion, $query);
          $idu = mysqli_fetch_assoc($consulta);?>
        <div class="col-sm-8">
          <div class="container"><h2>Bienvenido <?php echo $_SESSION['username']; ?></h2><br></div>
          <div class="table-responsive">
            <table class="table table-bordered">
              <p class="text-primary">Compras realizadas</p>
              <tr class="active">
                  <th>#</th>
                  <th>Fecha</th>
                  <th>Total</th>
                  <th>Estado</th>
              </tr>
              <?php
              $query2 = mysqli_query($conexion, "select * from sale where idUser='".$idu['idUser']."'");
              while($a = mysqli_fetch_array($query2)){
              if($a['state'] == 1){
                  $estado = "Finalizado";
                }else if($a['state'] == 2){
                  $estado = "Pendiente";
                }else if($a['state'] == 3){
                  $estado = "Cancelado";
                }else if($a['state'] == 4){
                  $estado = "Sin confirmar";
                } ?>
              <tr>
                  <td><?php echo $a['idSale'] ?></td>
                  <td><?php echo $a['sale_date'] ?></td>
                  <td>$<?php echo $a['total'] ?></td>
                  <td><a href="purchase-detail.php?ids=<?php echo $a['idSale']?>&idu=<?php echo base64_encode($a['idUser']) ?>"><?php echo $estado ?></a></td>
              </tr>
              <?php } ?>
            </table>
          </div>
        </div><br>
        <?php } ?>
        <?php  if($_SESSION['role'] == false){?>
        <div class="col-sm-4 perfil">
          <h3 align="center">CUENTA</h3>
          <div>
              <h4 class="">
                <?php
                $query = "select * from user where Name = '".$_SESSION['username']."'";
                $consulta1 = mysqli_query($conexion, $query);
                  if($i = mysqli_fetch_array($consulta1)){
                    echo "Nombre: <spam class='text-primary'>". $i['Name'] ."</spam><br>";
                    echo "Apellido: <spam class='text-primary'>" . $i['Lastname'] ."</spam><br>";
                    echo "Correo: <spam class='text-primary'>" . $i['email'] ."</spam><br>";
                    echo "Dirección: <spam class='text-primary'>" . $i['Address'] ."</spam><br>";
                    echo "Telefono: <spam class='text-primary'>" . $i['phone'] ."</spam><br>";
                    echo "Fecha de Nacimiento: <spam class='text-primary'>" . $i['birthdate'] ."</spam><br>";
                    echo "Estado de cuenta: <spam class='text-primary'>Activado</spam><br>";
                  }
                 ?>
              </h4><br>
              <div class="col-sm-6 col-sm-offset-3">
                <a href="edit-account.php" class="btn btn-primary btn-block">Editar <span class="glyphicon glyphicon-pencil"></span></a><br>              </div>
          </div>
        </div>
        <?php }else{
          require("../login/conexion.php");
          $query = "select * from user where Name = '".$_SESSION['username']."'";
          $consulta = mysqli_query($conexion, $query);?>
        <div class="col-sm-8 col-sm-offset-2 perfil">
          <h3 align="left">CUENTA</h3><br>
          <?php
            if($i = mysqli_fetch_array($consulta)){ ?>
                <li class="list-group-item text-center"><h4><b>Nombre: </b><span><?php echo $i['Name'] ?></span></h4></li>
                <li class="list-group-item text-center"><h4><b>Apellido: </b><span><?php echo $i['Lastname'] ?></span></h4></li>
                <li class="list-group-item text-center"><h4><b>Correo: </b><span><?php echo $i['email'] ?></span></h4></li>
                <li class="list-group-item text-center"><h4><b>Dirección: </b><span><?php echo $i['Address'] ?></span></h4></li>
                <li class="list-group-item text-center"><h4><b>Telefono: </b><span><?php echo $i['phone'] ?></span></h4></li>
                <li class="list-group-item text-center"><h4><b>Fecha de Nacimiento: </b><span><?php echo $i['birthdate'] ?></span></h4></li>
                <li class="list-group-item text-center"><h4><b>Estado: </b><span class="label label-success">Activado</span></h4></li>
          <?php } ?>
          <br>
          <div class="col-sm-6 col-sm-offset-3">
            <a href="edit-account.php" class="btn btn-primary btn-block">Editar <span class="glyphicon glyphicon-pencil"></span></a><br>
          </div>
        </div>
        <?php } ?>
      </div>
    </div><br>
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
