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
  <title>Dekoratex - Compra</title>
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
            <li class=""><a href="../index.php"><span class="glyphicon glyphicon-globe glyphicon-globe"></span> Inicio <span class="sr-only">(current)</span></a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-shopping-cart glyphicon-shopping-cart"></span> Productos <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <?php
                include "../login/conexion.php";

                $resultado=mysqli_query($conexion,"select * from product where offered=1 ");
                while($f=mysqli_fetch_array($resultado)){
                 ?>
                  <li><a href=../product/index.php?idp=<?php echo $f['idProd'];?>&np=<?php echo $f['Name']?>><?php echo $f['Name']; ?></a></li>
                <?php
                }
                 ?>
              </ul>
            </li>
            <li ><a href="../us.php"><span class="glyphicon glyphicon-info-sign glyphicon-info-sign"></span> Nosotros</a></li>
            <li><a href="../contact.php"><span class="glyphicon glyphicon-envelope glyphicon-envelope"></span> Contacto</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li style="display:inline-block"><a href="#ventana1" data-toggle="modal"><span class="glyphicon glyphicon-search"></span></a></li>
            <li style="display:inline-block" class="facebook"><a href="#" class=""><i class="fa fa-facebook color_fb"></i></a></li>
            <li style="display:inline-block" class="twitter"><a href="#" class=""><i class="fa fa-twitter color_tt"></i></a></li>
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
    <div class="container"><h1>Detalle de venta</h1><br></div>
    <div class="container">
      <div class="row">
      <?php require("../login/conexion.php");
      $idus = base64_decode($_GET['idu']);
      $query2 = mysqli_query($conexion, "select * from sale where idSale=".$_GET['ids']." and idUser=".base64_decode($_GET['idu'])."");
      while($a = mysqli_fetch_array($query2)){
        if($a['state'] == 1){
          $estado1 = "Finalizado";
        ?>
        <div class="col-sm-4">
          <div class="well well-lg">
              <h4>Fecha: <?php echo $a['sale_date'] ?></h4>
              <h4>Total: $ <?php echo $a['total'] ?></h4>
              <h4>Estado: <span class="label label-success"><?php echo $estado1 ?></span></h4>
          </div>
          <a href="index.php" class="btn btn-default">Volver</a><br>
        </div>
        <?php
        }else if($a['state'] == 2){
          $estado1 = "Pendiente";
        ?>
        <div class="col-sm-4">
          <div class="well well-lg">
              <h4>Fecha: <?php echo $a['sale_date'] ?></h4>
              <h4>Total: $ <?php echo $a['total'] ?></h4>
              <h4>Estado: <span class="label label-warning"><?php echo $estado1 ?></span></h4>
          </div>
          <a href="index.php" class="btn btn-default">Volver</a><br>
        </div>
        <?php
        }else if($a['state'] == 3){
          $estado1 = "Cancelado";
        ?>
        <div class="col-sm-4">
          <div class="well well-lg">
              <h4>Fecha: <?php echo $a['sale_date'] ?></h4>
              <h4>Total: $ <?php echo $a['total'] ?></h4>
              <h4>Estado: <span class="label label-danger"><?php echo $estado1 ?></span></h4>
          </div>
          <a href="index.php" class="btn btn-default">Volver</a><br>
        </div>
        <?php
        }else if($a['state'] == 4){
          $estado1 = "sin comfirmar";
        ?>
        <div class="col-sm-4">
          <div class="well well-lg">
              <h4>Fecha: <?php echo $a['sale_date'] ?></h4>
              <h4>Total: $ <?php echo $a['total'] ?></h4>
              <h4>Estado: <span class="label label-danger"><?php echo $estado1 ?></span></h4>
          </div>
          <a href="index.php" class="btn btn-default">Volver</a><br>
        </div>
        <?php
        } } ?>
        <div class="col-sm-8">
          <div class="table-responsive">
            <table class="table table-bordered">
              <tr class="active">
                  <th class="text-center">Producto</th>
                  <th class="text-center">Alto</th>
                  <th class="text-center">Ancho</th>
                  <th class="text-center">Valor</th>
              </tr>
              <?php
              $query = mysqli_query($conexion, "select *, b.Name as Producto from product_sale as a join product as b on a.idProd=b.idProd where a.idSale=".$_GET['ids']."");
              while($a = mysqli_fetch_array($query)){
               ?>
              <tr>
                  <td class="text-center"><?php echo $a['Producto'] ?></td>
                  <td class="text-center"><?php echo $a['sizeX'] ?> m</td>
                  <td class="text-center"><?php echo $a['sizeY'] ?> m</td>
                  <td class="text-center"><?php echo $a['unitprice'] ?></td>
              </tr>
              <?php } ?>
            </table>
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
<?php
  }else{
    echo "<script> location.href='../index.php'</script>";
  }
?>
