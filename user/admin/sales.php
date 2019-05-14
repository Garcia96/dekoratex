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
  <title>Dekoratex - Admin - Ventas</title>
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
            <li class="active"><a href="sales.php"><span class="glyphicon glyphicon-usd"></span> Ventas</a></li>
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
    <div class="border-image">
    <div class="container"><h2 class="text-primary">Mis ventas</h2><br></div>
    <div class="container">
      <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
          <div class="table-responsive">
            <table class="table table-bordered">
              <tr class="active">
                  <th class="text-center">#</th>
                  <th class="text-center">Fecha</th>
                  <th class="text-center">Total</th>
                  <th class="text-center">Estado</th>
              </tr>
              <?php require("../../login/conexion.php");
              $query = mysqli_query($conexion, "select * from sale");
              while($a = mysqli_fetch_array($query)){
                if($a['state'] == 1){
                  $estado = "Finalizado";
                }else if($a['state'] == 2){
                  $estado = "Pendiente";
                }else if($a['state'] == 3){
                  $estado = "Cancelado";
                }else if($a['state'] == 4){
                  $estado = "Sin comprobar";
                }
               ?>
              <tr>
                  <td class="text-center"><?php echo $a['idSale'] ?></td>
                  <td class="text-center"><?php echo $a['sale_date'] ?></td>
                  <td class="text-center"><?php echo $a['total'] ?></td>
                  <td class="text-center">
                    <a href=purchase-detail.php?ids=<?php echo $a['idSale']?>&idu=<?php echo base64_encode($a['idUser']) ?>><?php echo $estado ?></a>
                  </td>
              </tr>
              <?php } ?>
            </table>
          </div>
        </div>
      </div>
    </div><br><br>
  </div><br><br>
    <form class="" action="reportesales.php" method="post" target="_blank">
    <div class="container ">
      <div class="row">
        <div class="col-md-6 ">
              <h5 class="text-muted">Seleccione los componentes a mostrar:</h5><br>
              <select class="form-control" name="componente" id="ordenc">
                <option value="todos">Mostrar todo</option>
                <option value="sale_date">Fecha</option>
                <option value="total">Total</option>
                <option value="state">Estado</option>
              </select>
        </div>
        <div class="col-md-6 ">
              <h5 class="text-muted ">Seleccione el orden:</h5><br>
              <select class="form-control" name="orden">
                <option value="idSale">#</option>
                <option value="sale_date">Fecha</option>
                <option value="total">Total</option>
              </select>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6" id="compo-desde">

        </div>
        <div class="col-md-6" id="compo-hasta">

        </div>
      </div><br>
      <div class="row">
      <div class="col-sm-offset-9">
          <div class="form-inline">
          <div class="form-group">
            <button type="submit" class="btn btn-primary" name="button"><span class="glyphicon glyphicon-file"></span> Generar pdf</button>
          </div>
          <div class="form-group">
            <button type="reset" class="btn btn-primary" name="button"><span class="glyphicon glyphicon-refresh"></span> Reestablecer</button>
          </div>
        </div>
      </div>
      </div>
    </div>
    </form>
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
  <script src="../../js/codjs_report.js"></script>
</body>

</html>
