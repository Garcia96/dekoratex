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
  <title>Dekoratex - Admin</title>
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
            <li class="active"><a href="admin.php"><span class="glyphicon glyphicon-globe glyphicon-globe"></span> Inicio <span class="sr-only">(current)</span></a></li>
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
  <div class="col-sm-2 col-sm-offset-10">
    <a href="new-admin.php" class="btn btn-default btn-block">Nuevo administrador <span class="glyphicon glyphicon-exclamation-sign"></span></a>
  </div><br>
    <div class="container"><h2><?php echo "Bienvenido ".$_SESSION['username']."" ?></h2><br></div>
    <div class="container">
      <div class="row">
        <div class="col-sm-2">
          <h4>Numero de clientes registrados</h4>
          <p>Seleccione el año:</p>
          <select id="" onChange="mostrarResultados(this.value,'clientes');" name="date" size="1" class="form-control">
            <?php
            for($i= 2014; $i<=date("Y"); $i++){
              if($i == date("Y")){
                echo "<option selected value='".$i."'>".$i."</option>";
              }else{
                echo "<option value='".$i."'>".$i."</option>";
              }
            }
             ?>
          </select>
        </div>
        <div class="col-sm-10">
          <canvas id="clientes" width="100%" height="40"></canvas>
        </div>
      </div><br><br>
      <div class="row">
        <div class="col-sm-2">
          <h4>Ventas concretadas</h4>
          <p>Seleccion el año</p>
          <select id="" onChange="mostrarResultados(this.value,'ventas');" name="date" size="1" class="form-control">
            <?php
            for($i= 2014; $i<=date("Y"); $i++){
              if($i == date("Y")){
                echo "<option selected value='".$i."'>".$i."</option>";
              }else{
                echo "<option value='".$i."'>".$i."</option>";
              }
            }
             ?>
          </select>
        </div>
        <div class="col-sm-10">
          <canvas id="ventas" width="100%" height="40"></canvas>
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
  <script type="text/javascript" language="javascript" src="../../extras/chartJS/Chart.min.js"></script>
  <script>
    $(document).ready(mostrarResultados(2016,"clientes"));
    $(document).ready(mostrarResultados(2016,"ventas"));
          function color(){
            return "rgba("+Math.round(Math.random() * 255)+", "+Math.round(Math.random() * 255)+", "+Math.round(Math.random() * 255)+", .9)";
          }

          function mostrarResultados(año, opc){
              $.ajax({
                  type:'POST',
                  url:'procesar.php',
                  data:'año='+año+'&opcion='+opc,
                  success:function(data){

                      var valores = eval(data);

                      var e   = valores[0];
                      var f   = valores[1];
                      var m   = valores[2];
                      var a   = valores[3];
                      var ma  = valores[4];
                      var j   = valores[5];
                      var jl  = valores[6];
                      var ag  = valores[7];
                      var s   = valores[8];
                      var o   = valores[9];
                      var n   = valores[10];
                      var d   = valores[11];
                      // document.write(ma);

                      var Datos = {
                              labels : ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                              datasets : [
                                  {
                                      fillColor : color(), //COLOR DE LAS BARRAS
                                      highlightFill : color(), //COLOR "HOVER" DE LAS BARRAS
                                      data : [e, f, m, a, ma, j, jl, ag, s, o, n, d]
                                  }
                              ]
                          }

                      var contexto = document.getElementById(opc).getContext('2d');
                      window.Barra = new Chart(contexto).Bar(Datos, { responsive : true });
                  }
              });
              return false;
          }
    </script>
</body>
</html>
