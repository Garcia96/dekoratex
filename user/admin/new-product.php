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
  <title>Dekoratex - Nuevo Producto</title>
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
            <li class="active"><a href="inventory.php" ><span class="glyphicon glyphicon-list-alt"></span> Inventario</a></li>
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

  <div class="fondo">
    <div class="container">
      <div class="row">
        <h2>Nuevo producto</h2><br><br>
        <div class="col-sm-8 col-sm-offset-2">
          <form method="post">
            <div class="form-group">
              Codigo:
              <input type="text" name="codigo" placeholder="solo numeros" class="form-control" required>
              Nombre:
              <input type="text" name="nombre" placeholder="nombre" class="form-control" required>
            </div>
            <div class="form-group">
              <div class="col-sm-3 col-sm-offset-6">
              <input type="submit" name="nuevo" class="btn btn-primary btn-block" value="Enviar">
              </div>
            </div>
          </form>
          <div class="col-sm-3">
            <a href="inventory.php" name="" class="btn btn-default btn-block">Cancelar</a>
          </div>
        </div>
      </div><br><br>
      <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
        <?php require("../../login/conexion.php");
        if(isset($_POST['nuevo'])){
        $ids= mysqli_query($conexion, "select idProd from product where idProd ='".$_POST['codigo']."'");
        $r = mysqli_num_rows($ids);
          if($r == 0){
            $query = mysqli_query($conexion, "insert into product values('".$_POST['codigo']."', '".$_POST['nombre']."', 0)");
            $qu = "select * from product where Name ='".$_POST['nombre']."'";
                  $r = mysqli_query($conexion, $qu);
                  while($a = mysqli_fetch_array($r)){
                    echo '<div style="padding-left: 5%; padding-right: 5%;">';
                    echo "<h4>Nuevo tipo para ".$_POST['nombre']."</h4>";
                    echo '<form method="post" name="formualrio">';
                    echo '<input type=hidden name="idproducto" value="'.$a['idProd'].'">
                      <div class="form-group">
                      ID:<font color=red>*</font>
                      <input type="text" class="form-control" name="idtiponuevo" placeholder="identificador" required>
                      Nombre: <font color=red>*</font>
                      <input type="text" class="form-control" name="nombretipo" placeholder="Nombre" required>
                      Descripción: <font color=red>*</font>
                      <textarea class="form-control" name="descripciontipo" cols="60" rows="4" style="resize: none; height:150" placeholder="Descripción hasta 250 caracteres"required></textarea>
                      </div>
                      <div class="form-grpup">
                      <div class="col-sm-3 col-sm-offset-9">
                        <input type="submit" class="btn btn-primary btn-block" name="siguientenuevotipo" value="Siguiente">
                      </div>
                      </div>
                      </form>';
                    echo "</div>";
                  }
            // header("location: inventory.php");
          }else{
            echo "<script> alert('El codigo ya existe');</script>";
          }
        }else{
          if(isset($_POST['siguientenuevotipo'])){
            $query3 = "insert into type values('".$_POST['idtiponuevo']."', '".$_POST['nombretipo']."', '".$_POST['descripciontipo']."', '".$_POST['idproducto']."', '0')";
            $resultado3 = mysqli_query($conexion  , $query3);
            $quer = "select * from material";
            $res = mysqli_query($conexion, $quer);
            echo '<h3>Asignar material</h3>';
            echo '<form method="post" enctype="multipart/form-data">';
            echo '<div class="col-sm-12">';
            echo '<div class="table-responsive">';
            echo '<table class="table table-bordered">';
            echo '<tr class="active">';
            echo '<th>  </th>
                  <th>Nombre</th>
                  <th>Precio m<sup>2</sup></th>
                  <th>Imagen</th>';
            echo '</tr>';
            while($i = mysqli_fetch_array($res)){
              echo "<tr>";
              echo "<td><input type='checkbox' name='opciones[]' value='".$i['idMat']."'></td>";
              echo "<input type=hidden name='idtiponuevo' value=".$_POST['idtiponuevo'].">";
              echo "<td>".$i['Name']."</td>";
              echo "<input type=hidden name='nombrematerial".$i['idMat']."' value='".$i['Name']."'>";
              echo "<td><input type='text' name='preciomc".$i['idMat']."'></td>";
              echo "<td><input type='file' name='fotof".$i['idMat']."'><p class=help-block>Max 1MB</p></td>";
              echo "</tr>";
            }
            echo '</table>';
            echo '</div>';
            echo '</div><br>';
            echo '<div class="col-md-2 col-sm-offset-10">
                    <input type="submit" name="guardarnuevotipo" value="Guardar" class="btn btn-default btn-block">
                </div>';
            echo '</form>';
          }
          if(isset($_POST['guardarnuevotipo'])){
            $p =$_POST['idtiponuevo'];
            $cortina = mysqli_query($conexion,"select b.idProd, b.Name as cate, a.Name from type as a join product as b on a.idProd=b.idProd where a.idtype = $p");
            $idcate; $nomcate; $nomtipo;
            while($a = mysqli_fetch_array($cortina)){
                $idcate = $a['idProd'];
                $nomcate = $a['cate'];
                $nomtipo = $a['Name'];
            }
            $lista_id = $_POST['opciones'];
            foreach ($lista_id as $id) {
                if(isset($_FILES['fotof'.$id]['name']) !=""){
                    $allowedExts = array("image/jpg", "image/jpeg", "image/gif", "image/png", "image/JPG", "image/GIF", "image/PNG");
                    if (in_array($_FILES['fotof'.$id]['type'],$allowedExts) && $_FILES['fotof'.$id]['size'] <= 1048576) {
                                $extension = end(explode('.', $_FILES['fotof'.$id]['name']));
                                $nombrefoto = $nomcate.$nomtipo.$_POST['nombrematerial'.$id].".".$extension;
                                $pathfoto ="../../image/productos/".$nombrefoto;
                                move_uploaded_file($_FILES['fotof'.$id]['tmp_name'], $pathfoto);

                                $query2 = "insert into type_material values('".$id."', '".$p."', '".$_POST['preciomc'.$id]."', '".$nombrefoto."')";
                                $resultado2 = mysqli_query($conexion,$query2) or die ("no se puede ejecutar la query".mysqli_error());
                            }else{
                                echo "<h3>alert('El formato de imagen o el tamaño no es correcto');</h3>";
                            }
                }else{
                    echo "<h3>alert('No se selecciono imagen para el material'); </h3>";            }
            }
            echo "<script> location.href='inventory.php'</script>";
          }
        }
         ?>
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
