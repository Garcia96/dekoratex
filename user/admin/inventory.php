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
  <title>Dekoratex - Gestion de inventario</title>
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

  <div class=" fondo">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <h2 class="text-center">Gestión de Inventario</h2><br>
        </div>
      </div>
      <div class="row">
        <form method="post">
          <div class="col-md-3">
            <div class="panel panel-primary">
              <div class="panel-heading text-center">Escoger una categoria</div>
              <div class="panel-body">
                <ul class="nav nav-pills nav-stacked">
                  <?php
                  require("../../login/conexion.php");
                  $tipo = mysqli_query($conexion, "select Name from Product");

                  while($a = mysqli_fetch_array($tipo)){
                    echo '<li role="presentation" class=""><input type="submit" class="btn btn-info btn-block" name="tipos" value="'.$a['Name'].'"></li>';
                  }
                  ?>
                </ul>
              </div>
            </div>
            <div class="center-block" style="padding-left:20%; padding-right:20%;">
              <a href="new-product.php" class="btn btn-default btn-block">Nuevo Producto</a>
            </div>
          </div>
        </form>
        <div class="col-sm-9">
          <?php
          if(isset($_POST['tipos'])){
          $query = "select a.idtype, a.Name, a.Description, a.offered from type as a join Product as b on a.idProd=b.idProd where b.Name ='".$_POST['tipos']."'";
          $resultado = mysqli_query($conexion,$query) or die ("no se puede ejecutar la consulta".mysqli_error());

          echo "Tipos de ".$_POST['tipos'].":<br><br>";
          echo '<form method="post">';
          echo '<div class="col-sm-12">';
          echo '<div class="table-responsive">';
          echo '<table class="table table-bordered">';
          echo '<tr class="active">';
          echo '<th>  </th>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>En catalogo</th>';
          echo '</tr>';
          while($i = mysqli_fetch_array($resultado)){
            echo "<tr>";
            echo "<td><input type='radio' name='elegir[]' value='".$i['idtype']."'></td>";
            echo "<input type=hidden name=cortina value='".$_POST['tipos']."'>";
            echo "<td>".$i['idtype']."</td>";
            echo "<td>".$i['Name']."</td>";
            echo "<td>".$i['Description']."</td>";
            echo "<td>";
            if($i['offered'] == 1){
              echo "SI";
            }else{
              echo "NO";
            }
            echo "</td>";
            echo "</tr>";
          }
          echo '</table>';
          echo '</div>';
          echo '</div><br>';
          $ofertado = mysqli_query($conexion, "select * from product where Name='".$_POST['tipos']."'");
          while($e = mysqli_fetch_array($ofertado)){
            if($e['offered'] == 1){
              echo '<div class="col-md-4">
                      <input type="submit" name="dejar" value="Dejar de ofrecer '.$_POST['tipos'].'" class="btn btn-danger btn-block">
                    </div>';
            }else{
              echo '<div class="col-md-4">
                      <input type="submit" name="ofrecer" value="Ofrecer '.$_POST['tipos'].'" class="btn btn-danger btn-block">
                    </div>';
            }
          }
          echo '<div class="col-md-2 col-sm-offset-2">
                    <input type="submit" name="NuevoTipo" value="Nuevo" class="btn btn-default btn-block">
                </div>';
          echo '<div class="col-md-2">
                    <input type="submit" name="editar" value="Editar" class="btn btn-default btn-block">
                </div>';
          echo '<div class="col-md-2">
                    <input type="submit" name="eliminar" value="Eliminar" class="btn btn-default btn-block">
                </div>';

          echo '</form>';
          }else{
          if(isset($_POST['eliminar'])){
            $lista_id = $_POST['elegir'];
            foreach ($lista_id as $id) {
              $query2 = "delete from type where idtype='".$id."'";
              $resultado2 = mysqli_query($conexion,$query2) or die ("no se puede ejecutar la query".mysqli_error());
            }
            echo "<script> location.href='inventory.php'</script>";
          }
          if(isset($_POST['editar'])){
            if(isset($_POST['elegir'])){
              $lista_id = $_POST['elegir'];
              foreach ($lista_id as $id) {
                $query2 = "select * from type where idtype='".$id."'";
                $resultado2 = mysqli_query($conexion,$query2) or die ("no se puede ejecutar la query".mysqli_error());
                while($i = mysqli_fetch_array($resultado2)){
                  echo '<div style="padding-left: 5%; padding-right: 5%;">';
                  echo "<h4>Editar ".$i['Name']."</h4>";
                  echo '<form method="post" name="formualrio">
                    <div class="form-group">
                    <input type=hidden name=idtipo value='.$i['idtype'].'>
                    Nombre: <font color=red>*</font>
                    <input type="text" class="form-control" name="nombretipo" value='.$i['Name'].' placeholder="Nombre" required>
                    Descripción: <font color=red>*</font>
                    <textarea class="form-control" name="descripciontipo" cols="60" rows="4" style="resize: none; height:150" placeholder="Descripción hasta 250 caracteres"required>'.$i['Description'].'</textarea>
                    </div><br>
                    <div class="table-responsive">
                    <h4>Precio e imagen</h4>
                    <table class="table table-bordered">
                    <tr class="active">
                    <th class="text-center"></th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Precio m<sup>2</sup></th>
                    <th class="text-center">Imagen</th>
                    </tr>';
                    $query3 = mysqli_query($conexion, "select c.Name as nombremat, b.idMat as mat, b.priceSM as precio, b.Image as imagen from type as a
                      join type_material as b on a.idtype=b.idtype join material as c on b.idMat=c.idMat where a.idtype ='".$id."'");
                    while($r = mysqli_fetch_array($query3)){
                    echo '<tr>
                      <td><input type="checkbox" name="idmaterial[]" value="'.$r['mat'].'"></td>
                      <input class="hidden" name="idtiponuevo" value="'.$id.'">
                      <input class="hidden" name="imagenantigua'.$r['mat'].'" value="'.$r['imagen'].'">
                      <input class="hidden" name="nombremate'.$r['mat'].'" value="'.$r['nombremat'].'">
                      <td class="text-center">'.$r['nombremat'].'</td>
                      <td class="text-center"><input class="text-center" type="text" name="precionuevo'.$r['mat'].'" value="'.$r['precio'].'"</td>
                    <td class="text-center"><input type="file" name="nuevaimagen'.$r['mat'].'" ></td>
                    </tr>';
                    }
                   echo '</table>
                    </div>
                    <div class="form-grpup">';
                    $x = mysqli_query($conexion, "select * from type where idtype='".$id."'");
                    while($w = mysqli_fetch_array($x)){
                      if($w['offered'] == 1){
                        echo '<div class="col-md-4">
                                  <input type="submit" name="dejarTipo" value="Dejar de ofrecer" class="btn btn-danger btn-block">
                              </div>';
                      }else{
                        echo '<div class="col-md-4">
                                  <input type="submit" name="Ofrecertipo" value="Ofrecer tipo" class="btn btn-danger btn-block">
                              </div>';
                      }
                    }
                 echo '<div class="col-sm-4 col-sm-offset-4">
                      <input type="submit" class="btn btn-primary btn-block" name="editarnuevotipo" value="Guardar">
                    </div>
                    </div>
                    </form>';
                  echo "</div>";
                }
              }
            }
          }
          if(isset($_POST['editarnuevotipo'])){
            $query3 = "update type set Name ='".$_POST['nombretipo']."', Description = '".$_POST['descripciontipo']."' where idtype ='".$_POST['idtipo']."'";
            $resultado3 = mysqli_query($conexion  , $query3);

            $p = $_POST['idtiponuevo'];
            $cortina = mysqli_query($conexion,"select b.idProd, b.Name as cate, a.Name from type as a join product as b on a.idProd=b.idProd where a.idtype = $p");
            $idcate; $nomcate; $nomtipo;
            while($a = mysqli_fetch_array($cortina)){
                $idcate = $a['idProd'];
                $nomcate = $a['cate'];
                $nomtipo = $a['Name'];
            }
            $lista_id = $_POST['idmaterial'];
            foreach ($lista_id as $id) {
              var_dump($_FILES['nuevaimagen'.$id]['name']);
                if(isset($_FILES['nuevaimagen'.$id]['name']) !=""){
                    $allowedExts = array("image/jpg", "image/jpeg", "image/gif", "image/png", "image/JPG", "image/GIF", "image/PNG");
                    if (in_array($_FILES['nuevaimagen'.$id]['type'],$allowedExts) && $_FILES['nuevaimagen'.$id]['size'] <= 1048576) {
                                $extension = end(explode('.', $_FILES['nuevaimagen'.$id]['name']));
                                $nombrefoto = $nomcate.$nomtipo.$_POST['nombremate'.$id].".".$extension;
                                $pathfoto ="../../image/productos/".$nombrefoto;
                                unlink('../../image/productos/'.$_POST['imagenantigua'.$id]);

                                $query2 = "update type_material set priceSM='".$_POST['precionuevo'.$id]."',
                                Image='".$nombrefoto."' where idtype='".$p."', and idMat='".$id."'";
                                $resultado2 = mysqli_query($conexion,$query2) or die ("no se puede ejecutar la query".mysqli_error());
                                move_uploaded_file($_FILES['nuevaimagen'.$id]['tmp_name'], $pathfoto);
                            }else{
                                echo "<script>alert('El formato de imagen o el tamaño no es correcto')</script>";
                            }
                }else{
                    echo "<script>alert('No se ha seleccionado imagen')</script>";
                    $otra = mysqli_query($conexion, "update type_material set priceSM='".$_POST['precionuevo'.$id]."',
                                where idtype='".$p."', and idMat='".$id."'");            }
              }
              echo "<script> location.href='inventory.php'</script>";
          }
          if(isset($_POST['NuevoTipo'])){
            $qu = "select * from product where Name ='".$_POST['cortina']."'";
            $r = mysqli_query($conexion, $qu);
            while($a = mysqli_fetch_array($r)){
              echo '<div style="padding-left: 5%; padding-right: 5%;">';
              echo "<h4>Nuevo tipo para ".$_POST['cortina']."</h4>";
              echo '<form method="post" name="formualrio">';
              echo '<input type=hidden name="idproducto" value="'.$a['idProd'].'">
                <div class="form-group">
                ID:<font color=red>*</font>
                <input type="text" class="form-control" name="idtiponuevo" placeholder="identificador" required>
                Nombre: <font color=red>*</font>
                <input type="text" class="form-control" name="nombretipo" placeholder="Nombre" required>
                Descripción: <font color=red>*</font>
                <textarea class="form-control" name="descripciontipo" cols="60" rows="4" style="resize: none; height:150" placeholder="Descripción hasta 250 caracteres"required></textarea>
                </div><br>
                <div class="form-grpup">
                <div class="col-sm-3 col-sm-offset-6">
                  <input type="submit" class="btn btn-primary btn-block" name="siguientenuevotipo" value="Siguiente">
                </div>
                </div>
                </form>
                <div class="col-sm-3">
                  <a href="inventory.php" name="" class="btn btn-default btn-block">Cancelar</a>
                </div>';
              echo "</div>";
            }

          }
          if(isset($_POST['siguientenuevotipo'])){
            $query3 = "insert into type values('".$_POST['idtiponuevo']."', '".$_POST['nombretipo']."', '".$_POST['descripciontipo']."', '".$_POST['idproducto']."', '1')";
            $resultado3 = mysqli_query($conexion  , $query3);
            $quer = "select * from material";
            $res = mysqli_query($conexion, $quer);
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
                    <br>
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
                                $query2 = "insert into type_material values('".$id."', '".$p."', '".$_POST['preciomc'.$id]."', '".$nombrefoto."')";
                                $resultado2 = mysqli_query($conexion,$query2) or die ("no se puede ejecutar la query".mysqli_error());
                                move_uploaded_file($_FILES['fotof'.$id]['tmp_name'], $pathfoto);

                            }else{
                                echo "<script>alert('El formato de imagen o el tamaño no es correcto')</script>";
                            }
                }else{
                    echo "<script>alert('No se selecciono imagen para el material') </script>";            }
            }
            echo "<script> location.href='inventory.php'</script>";
          }
          if(isset($_POST['dejarTipo'])){
            $query2 = mysqli_query($conexion, "update type set offered = 0 where idtype ='".$_POST['idtiponuevo']."'");
          }
          if(isset($_POST['dejar'])){
            $query2 = mysqli_query($conexion, "update product set offered = 0 where Name  ='".$_POST['cortina']."'");
          }
          if(isset($_POST['ofrecer'])){
            $query2 = mysqli_query($conexion, "update product set offered = 1 where Name ='".$_POST['cortina']."'");
          }
          if(isset($_POST['Ofrecertipo'])){
            $query2 = mysqli_query($conexion, "update type set offered = 1 where idtype ='".$_POST['idtiponuevo']."'");
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
