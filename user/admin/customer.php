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
  <title>Dekoratex - Admin - Clientes</title>
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
            <li class="active"><a href="customer.php"><span class="glyphicon glyphicon-user cli"></span> Usuarios</a></li>
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
    <div class="border-image">
    <div class="container"><h2>Listado Clientes</h2><br></div>
    <div class="container">
      <form action="" method="post">
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <input type="text" name="busqueda" class="form-control" placeholder="Busqueda por ID ...  Dejar en blanco para mostrar todos">
            </div>
          </div>
          <div class="col-sm-2">
            <input type="submit" name="buscar" class="btn btn-primary btn-block" value="Buscar">
          </div>
        </div>
      </form>
      <?php

      require("../../login/conexion.php");
      if(isset($_POST['buscar'])){
        if(!(empty($_POST['busqueda'])) ){
          $query = "select * , b.type from user as a join role as b on a.idrole=b.idrole where b.idrole = 2 and a.idUser = '".$_POST['busqueda']."'";
          $resutado = mysqli_query($conexion,$query) or die ("no se puede ejecutar la consulta".mysqli_error());

          echo '<form method="post">';
          echo '<div class="col-sm-12 ">';
          echo '<div class="table-responsive">';
          echo '<table class="table table-bordered">';
          echo '<p class="text-primary"></p>';
          echo '<tr class="active">';
          echo '<th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Direccion</th>
                <th>Telefono</th>
                <th>Fecha Nacimiento</th>
                <th>Fecha Registro</th>
                <th>Role</th>';
          echo '</tr>';
          while($i = mysqli_fetch_array($resutado)){
            echo "<tr>";

            echo "<input type=hidden name=id value=".$i['idUser']." >";
            echo "<td>".$i['idUser']."</td>";
            echo "<td>".$i['Name']."</td>";
            echo "<td>".$i['Lastname']."</td>";
            echo "<td>".$i['email']."</td>";
            echo "<td>".$i['Address']."</td>";
            echo "<td>".$i['phone']."</td>";
            echo "<td>".$i['birthdate']."</td>";
            echo "<td>".$i['admission']."</td>";
            echo "<td>".$i['type']."</td>";
            echo "</tr>";
          }

          echo '</table>';
          echo '</div>';
          echo '</div><br>';

          echo '<div class="col-md-2 col-sm-offset-10">
                    <input type="submit" name="eliminar" value="Eliminar" class="btn btn-default btn-block"><br>
                </div><br>';
          echo '</form>';

        }else{
          $query = "select * , b.type from user as a join role as b on a.idrole=b.idrole where b.idrole = 2";
          $resutado = mysqli_query($conexion,$query) or die ("no se puede ejecutar la consulta".mysqli_error());

          echo '<form method="post">';
          echo '<div class="col-sm-12">';
          echo '<div class="table-responsive">';
          echo '<table class="table table-bordered">';
          echo '<p class="text-primary"></p>';
          echo '<tr class="active">';
          echo '<th>     </th>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Direccion</th>
                <th>Telefono</th>
                <th>Fecha Nacimiento</th>
                <th>Fecha Registro</th>
                <th>Role</th>';
          echo '</tr>';

          while($i = mysqli_fetch_array($resutado)){
            echo "<tr>";
            echo "<td> <input type='checkbox' name='elegir[]' value='".$i['idUser']."' > </td>";
            echo "<td>".$i['idUser']."</td>";
            echo "<td>".$i['Name']."</td>";
            echo "<td>".$i['Lastname']."</td>";
            echo "<td>".$i['email']."</td>";
            echo "<td>".$i['Address']."</td>";
            echo "<td>".$i['phone']."</td>";
            echo "<td>".$i['birthdate']."</td>";
            echo "<td>".$i['admission']."</td>";
            echo "<td>".$i['type']."</td>";
            echo "</tr>";
          }

          echo '</table>';
          echo '</div>';
          echo '</div><br>';
          echo '<div class="col-md-2">
                    <input type="submit" name="eliminar2" value="Eliminar" class="btn btn-default btn-block"><br>
                </div><br>';
          echo '</form>';
        }
      }else{
        if(isset($_POST['eliminar2'])){
            $lista_id[] = $_POST['elegir'];
            foreach ($lista_id as $id) {
              $query2 = "delete from user where idUser='".$id."'";
              $resultado2 = mysqli_query($conexion,$query2) or die ("no se puede ejecutar la query".mysqli_error());
            }
            echo "<script> location.href='admin.php'</script>";
        }
        if(isset($_POST['eliminar'])){
            $id = $_POST['id'];
            $query2 = "delete from user where idUser='".$id."'";
            $resultado2 = mysqli_query($conexion,$query2) or die ("no se puede ejecutar la query".mysqli_error());
            echo "<script> location.href='admin.php'</script>";
          }
      }
      ?>
    </div><br><br>
    </div><br><br>
    <form class="" action="reportecustomer.php" method="post" target="_blank">
    <div class="container ">
      <div class="row">
        <div class="col-md-6 ">
              <h5 class="text-muted">Seleccione los componentes a mostrar:</h5><br>
              <select class="form-control" name="componente" id="comp">
                <option value="todos">Mostrar todo</option>
                <option value="admission">Fecha de ingreso</option>
                <option value="birthdate">Fecha de nacimiento</option>
              </select>
        </div>
        <div class="col-md-6 ">
              <h5 class="text-muted ">Seleccione el orden:</h5><br>
              <select class="form-control" name="orden">
                <option value="idUser">ID</option>
                <option value="Name">Nombre</option>
                <option value="birthdate">Fecha de nacimiento</option>
                <option value="admission">Fecha de registro</option>
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
            <button type="submit" class="btn btn-primary" name="button" target="_blank"><span class="glyphicon glyphicon-file"></span> Generar pdf</button>
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
