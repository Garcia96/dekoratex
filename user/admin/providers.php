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
  <title>Dekoratex - Admin - Proveedores</title>
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
            <li class="active"><a href="providers.php"><span class="glyphicon glyphicon-edit"></span> Proveedores</a></li>
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
      <div class="container"><h2>Mis proveedores</h2><br></div>
      <div class="container">
        <form action="" method="post">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <input type="text" name="busqueda" class="form-control" placeholder="Busqueda por ID ...  Dejar en blanco para mostrar todos">
              </div>
            </div>
            <div class="col-sm-2">
              <input type="submit" name="buscar" id="buscar" class="btn btn-primary btn-block" value="Buscar">
            </div>
            <div class="col-sm-2 col-sm-offset-2">
              <input type="submit" name="nuevo" id="nuevo" class="btn btn-primary btn-block" value="Nuevo">
            </div>
          </div>
        </form><br>
        <?php
          require("../../login/conexion.php");
          if(isset($_POST['buscar'])){
            if(!(empty($_POST['busqueda']))){
              $query = mysqli_query($conexion, "select * from provider where idProv ='".$_POST['busqueda']."'");
        ?>
        <div class="row">
          <form method="post">
            <div class="col-sm-12">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <tr class="active">
                      <th>ID</th>
                      <th>Nombre</th>
                      <th>Dirección</th>
                      <th>Telefono</th>
                  </tr>
                  <?php while($a = mysqli_fetch_array($query)){ ?>
                  <tr>
                      <input type="hidden" name="id" value="<?php echo $a['idProv']?>">
                      <td><?php echo $a['idProv'] ?></td>
                      <td><?php echo $a['Name'] ?></td>
                      <td><?php echo $a['Address'] ?></td>
                      <td><?php echo $a['phone'] ?></td>
                  </tr>
                  <?php } ?>
                </table>
              </div>
            </div>
            <div class="col-md-2 col-sm-offset-8">
                <input type="submit" name="editar" value="Editar" class="btn btn-default btn-block">
            </div>
            <div class="col-md-2">
                <input type="submit" name="eliminar" id="eliminar" value="Eliminar" class="btn btn-default btn-block">
            </div>
          </form>
        </div>
        <?php }else{
          $query = mysqli_query($conexion, "select * from provider");
        ?>
        <div class="row">
          <form method="post">
            <div class="col-sm-12">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <tr class="active">
                      <th>    </th>
                      <th>ID</th>
                      <th>Nombre</th>
                      <th>Dirección</th>
                      <th>Telefono</th>
                  </tr>
                  <?php while($a = mysqli_fetch_array($query)){ ?>
                  <tr>
                      <td><input type="radio" name="opcion" value="<?php echo $a['idProv'] ?>"></td>
                      <td><?php echo $a['idProv'] ?></td>
                      <td><?php echo $a['Name'] ?></td>
                      <td><?php echo $a['Address'] ?></td>
                      <td><?php echo $a['phone'] ?></td>
                  </tr>
                  <?php } ?>
                </table>
              </div>
            </div>
            <div class="col-md-2 col-sm-offset-8">
                <input type="submit" name="editar1" value="Editar" class="btn btn-default btn-block">
            </div>
            <div class="col-md-2">
                <input type="submit" name="eliminar1" value="Eliminar" class="btn btn-default btn-block">
            </div>
          </form>
        </div>
        <?php } ?>
        <?php }else{
          if(isset($_POST['eliminar'])){
            $id = $_POST['id'];
            $query2 = mysqli_query($conexion, "delete from provider where id ='".$id."'");
          ?>
          <?php }
          if(isset($_POST['eliminar1'])){
              $lista_id[] = $_POST['opcion'];
              foreach ($lista_id as $id) {
                $query2 = "delete from provider where idProv='".$id."'";
                $resultado2 = mysqli_query($conexion,$query2) or die ("no se puede ejecutar la query".mysqli_error());
              }
          ?>
          <?php }
          if(isset($_POST['editar'])){
            $query2 = mysqli_query($conexion, "select * from provider where idProv = '".$_POST['id']."'");
          ?>
          <div class="row">
          <form method="post">
            <div class="col-sm-12">
              <?php while($a = mysqli_fetch_array($query2)){
              echo '<div class="form-group" style="padding-left: 15%; padding-right: 15%;">
              <h3>Edición</h3>
                <input type="hidden" name="id1" value="'.$a['idProv'].'">
                Nombre:
                <input type="text" name="nomProv" class="form-control" value="'.$a['Name'].'">
                Dirección:
                <input type="text" name="dirProv" class="form-control" value="'.$a['Address'].'">
                Telefono:
                <input type="text" name="telProv" class="form-control" value="'.$a['phone'].'">
              </div>';
              } ?>
            </div>
            <div class="col-sm-6 col-sm-offset-3">
                  <h4 class="text-center">Productos y precios</h4>
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <tr class="active">
                        <th class="text-center">Producto</th>
                        <th class="text-center">Precio</th>
                      </tr>
                      <?php
                      $otra = mysqli_query($conexion, "select c.idProd as id, c.Name as producto, b.price as precio from provider
                      as a join provider_product as b on a.idProv=b.idProv join product as c on b.idProd=c.idProd where a.idProv ='".$_POST['id']."'");
                      while($t = mysqli_fetch_array($otra)){?>
                      <tr>
                        <input type="hidden" name="idprodedit[]" value="<?php echo $t['id'] ?>">
                        <input type="hidden" name="idprovedit" value="<?php echo $_POST['id'] ?>">
                        <td class="text-center"><?php echo $t['producto'] ?></td>
                        <td class="text-center"><input type="text" class="text-center" name="precioedit<?php echo $t['id'] ?>" value="<?php echo $t['precio'] ?>"></td>
                      </tr>
                      <?php } ?>
                    </table>
                  </div>
                </div>
            <div class="col-md-2 col-sm-offset-4">
                <input type="submit" name="guardar" value="Guardar" class="btn btn-default btn-block">
            </div>
            <div class="col-md-2">
                <input type="submit" name="cancelar" value="Cancelar" class="btn btn-default btn-block">
            </div>
          </form>
        </div>
          <?php }
          if(isset($_POST['editar1'])){
            $lista_id = $_POST['opcion'];
            $query2 = "select * from provider where idProv='".$lista_id."'";
            $resultado2 = mysqli_query($conexion,$query2) or die ("no se puede ejecutar la query".mysqli_error());
            ?>
            <div class="row">
              <form method="post">
                <div class="col-sm-12">
                  <?php while($a = mysqli_fetch_array($resultado2)){
                  echo '<div class="form-group" style="padding-left: 15%; padding-right: 15%;">
                  <h3>Edición</h3>
                    <input type="hidden" name="id2" value="'.$a['idProv'].'">
                    Nombre:
                    <input type="text" name="nomProv1" class="form-control" value="'.$a['Name'].'">
                    Dirección:
                    <input type="text" name="dirProv1" class="form-control" value="'.$a['Address'].'">
                    Telefono:
                    <input type="text" name="telProv1" class="form-control" value="'.$a['phone'].'">
                  </div>';
                  } ?>
                </div>
                <div class="col-sm-6 col-sm-offset-3">
                  <h4 class="text-center">Productos y precios</h4>
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <tr class="active">
                        <th class="text-center">Producto</th>
                        <th class="text-center">Precio</th>
                      </tr>
                      <?php
                      $otra = mysqli_query($conexion, "select c.idProd as id, c.Name as producto, b.price as precio from provider
                      as a join provider_product as b on a.idProv=b.idProv join product as c on b.idProd=c.idProd where a.idProv ='".$lista_id."'");
                      while($t = mysqli_fetch_array($otra)){?>
                      <tr>
                        <input type="hidden" name="idprodedit[]" value="<?php echo $t['id'] ?>">
                        <input type="hidden" name="idprovedit" value="<?php echo $lista_id ?>">
                        <td class="text-center"><?php echo $t['producto'] ?></td>
                        <td class="text-center"><input type="text" class="text-center" name="precioedit<?php echo $t['id'] ?>" value="<?php echo $t['precio'] ?>"></td>
                      </tr>
                      <?php } ?>
                    </table>
                  </div>
                </div>
                <div class="col-md-2 col-sm-offset-4">
                    <input type="submit" name="guardar1" value="Guardar" class="btn btn-default btn-block">
                </div>
                <div class="col-md-2">
                    <input type="submit" name="cancelar1" value="Cancelar" class="btn btn-default btn-block">
                </div>
              </form>
            </div>
              <?php
          }
          if(isset($_POST['guardar'])){
            $query3 = mysqli_query($conexion, "update provider set Name='".$_POST['nomProv']."',
              Address='".$_POST['dirProv']."', phone='".$_POST['telProv']."' where idProv='".$_POST['id1']."'");
            $lista = $_POST['idprodedit'];
           foreach ($lista as $id) {
            $query4 = mysqli_query($conexion, "update provider_product set price='".$_POST['precioedit'.$id]."' where
              idProv='".$_POST['idprovedit']."' and idProd='".$id."'");
           }
          }
          if(isset($_POST['guardar1'])){
           $query3 = mysqli_query($conexion, "update provider set Name='".$_POST['nomProv1']."',
              Address='".$_POST['dirProv1']."', phone='".$_POST['telProv1']."' where idProv='".$_POST['id2']."'");
           $lista = $_POST['idprodedit'];
           foreach ($lista as $id) {
            $query4 = mysqli_query($conexion, "update provider_product set price='".$_POST['precioedit'.$id]."' where
              idProv='".$_POST['idprovedit']."' and idProd='".$id."'");
           }
          }
          if(isset($_POST['cancelar'])){
            echo "<script>location.href='providers.php'</script>";
          }
          if(isset($_POST['cancelar1'])){
            echo "<script>location.href='providers.php'</script>";
          }
          if(isset($_POST['nuevo'])){ ?>
          <div class="row">
            <form method="post">
              <div class="col-sm-12">
                <div class="form-group" style="padding-left: 15%; padding-right: 15%;">
                <h3 class="text-center">Nuevo proveedor</h3>
                  Identificación:
                  <input type="text" name="nuevoid" value="" class="form-control" required>
                  Nombre:
                  <input type="text" name="nuevonom" class="form-control" value="" required>
                  Dirección:
                  <input type="text" name="nuevodir" class="form-control" value="" required>
                  Telefono:
                  <input type="text" name="nuevotel" class="form-control" value="" required>
                </div>
              </div>
              <div class="col-md-2 col-sm-offset-4">
                  <input type="submit" name="continuar" value="Continuar" class="btn btn-default btn-block">
              </div>
              <div class="col-md-2">
                  <input type="submit" name="cancelar2" value="Cancelar" class="btn btn-default btn-block">
              </div>
            </form>
          </div>
          <?php }
          if(isset($_POST['continuar'])){
            $query3 = mysqli_query($conexion, "insert into provider values('".$_POST['nuevoid']."',
              '".$_POST['nuevonom']."', '".$_POST['nuevodir']."', '".$_POST['nuevotel']."')");
          ?>
          <div class="row">
            <form method="post">
              <div class="col-sm-12">
                <div class="form-group" style="padding-left: 15%; padding-right: 15%;">
                <h3 class="text-center">Asignar productos y precios</h3>
                <?php $consulta = mysqli_query($conexion, "select * from product"); ?>
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <tr class="active">
                        <th class="text-center">  #  </th>
                        <th class="text-center">Producto</th>
                        <th class="text-center">Precio</th>
                      </tr>
                      <?php while($o = mysqli_fetch_array($consulta)){ ?>
                      <tr>
                        <td class="text-center"><input type="checkbox" name="elegido[]" value="<?php echo $o['idProd'] ?>"></td>
                        <input type="hidden" name="idprove" value="<?php echo $_POST['nuevoid'] ?>">
                        <td class="text-center"><?php echo $o['Name'] ?></td>
                        <td class="text-center"><input type"text" name="preci<?php echo $o['idProd'] ?>"></td>
                      </tr>
                      <?php } ?>
                    </table>
                  </div>
                </div>
              </div>
              <div class="col-md-2 col-sm-offset-5">
                  <input type="submit" name="insertar" value="Guardar" class="btn btn-default btn-block">
              </div>
            </form>
          </div>
          <?php }
          if(isset($_POST['insertar'])){
            $list_id = $_POST['elegido'];
            foreach($list_id as $id) {
              $query3 = mysqli_query($conexion, "insert into provider_product values('".$_POST['idprove']."',
                '".$id."', '".$_POST['preci'.$id]."')");
            }
          } ?>

        <?php } ?>

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
  <script type="text/javascript" src="../../Product/codigo.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>
