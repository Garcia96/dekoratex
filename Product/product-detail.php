<!DOCTYPE html>
<?php session_start();?>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="shortcut icon" type="image/x-icon" href="../image/favicon.ico">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../estilo_index.css">
        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="../css/jquery.simplecolorpicker.css">
        <link rel="stylesheet" href="../css/jquery.simplecolorpicker-regularfont.css">
        <link rel="stylesheet" href="../css/jquery.simplecolorpicker-glyphicons.css">
        <link rel="stylesheet" href="../css/jquery.simplecolorpicker-fontawesome.css">

        <title>Detalle de Producto </title>
        <style >
        .panel {
  position: fixed;
  left: -15.625em; /*left or right and the width of your navigation panel*/
  width: 15.625em; /*should match the above value*/
} wait
.wrap {
    position: relative;
}
        </style>
    </head>
    <body style="padding-top: 50px;">

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
                <a class="navbar-brand " href="../index.php"><img src="../image/logo2.png"  class="imagenheader" alt="Logo" /></a>
              </div>

              <!-- Collect the nav links, forms, and other content for toggling -->
              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                  <li class=""><a href="../index.php"><span class="glyphicon glyphicon-globe "></span> Inicio <span class="sr-only">(current)</span></a></li>
                  <li class="dropdown active">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-shopping-cart glyphicon-shopping-cart"></span> Productos <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <?php
                      include "../login/conexion.php";

                      $resultado=mysqli_query($conexion,"select * from product where offered=1 ");
                      while($f=mysqli_fetch_array($resultado)){
                       ?>
                      <li><a href=index.php?idp=<?php echo $f['idProd'];?>&np=<?php echo $f['Name']?>><?php echo $f['Name']; ?></a></li>
                      <?php
                      }
                       ?>
                    </ul>
                  </li>
                  <li ><a href="../us.php"><span class="glyphicon glyphicon-info-sign glyphicon-info-sign"></span> Nosotros</a></li>
                  <li><a href="../contact.php"><span class="glyphicon glyphicon-envelope glyphicon-envelope"></span> Contacto</a></li>
                  <?php if(isset($_SESSION['username'])){
                    if($_SESSION['role']== false){
                      echo '<li><a href="cart.php"><span class="glyphicon glyphicon-list-alt"></span> Carro de compras</a></li>';
                    }
                  } ?>
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
                        echo "<li><a href='../user/index.php'>Ver mi cuenta</a></li>";
                        echo "<li><a href='../login/logout.php'>Cerrar Sesion</a></li>";
                      }else{
                        echo "<li><a href='../user/admin/admin.php'>Administrar</a></li>";
                        echo "<li><a href='../user/index.php'>Ver mi cuenta</a></li>";
                        echo "<li><a href='../login/logout.php'>Cerrar Sesion</a></li>";
                      }
                      echo "</ul>";
                      echo "</li>";
                  }else{
                      echo "<li style='align:center'><a href='../login/index.php'><strong>Inicia Sesion / Registrarse</strong></a></li>";
                  } ?>
                </ul>
              </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
          </nav>
        </header>
        <div class="modal fade" id="ventana1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h2 class="modal-title">Buscar</h4>
              </div>
              <form method="get" action="Search.php">
                <div class="modal-body">
                  <div class="form-group"><br>
                      <input class="form-control" type="text" name="s" placeholder="keywords" required>
                  </div><br>
                  <input type="submit" value="Buscar" class="btn btn-primary">
                </div>
              </form>
            </div>
          </div>
        </div><br>

        <br>
        <?php
        $im=$_GET["im"];
         ?>
        <div class="container registro " style="padding: 5%;">
            <div class="row">
                <div class="col-sm-6">
                    <a href=""><img src="../image/productos/<?php echo $im ?>" class="img-responsive img-rounded" alt="" /></a>
                    <input type="hidden" name="name" value="<?php echo $im ?>" id="imagenpro">
                    <?php
                    $quer="select *,d.Name as Namet,b.Name as Namep,c.idtype as idut,c.idMat as idum from product as a JOIN type as b on a.idProd=b.idProd JOIN type_material as c on b.idtype=c.idtype join material as d on c.idMat=d.idMat WHERE c.Image='$im' ";
                    $info=mysqli_query($conexion,$quer);
                     ?>
                </div>
                <div class="col-sm-6" >
                  <?php
                  $nombre_pro=$_GET["n"];
                  while ($informacion=mysqli_fetch_array($info)) {
                    $precio=$informacion['priceSM'];
                    $tela=$informacion['Namet'];
                    $idtipo=$informacion['idut'];
                    $idmat=$informacion['idum'];
                    $nombreparacarro = $nombre_pro."&nbsp;".$informacion['Namep'];
                    ?>
                    <h3 id="nombre_producto"><?php echo $nombre_pro ?>&nbsp;<?php echo $informacion['Namep']; ?></h3><br>
                    <input type="hidden" name="name" id="nombrepro" value="<?php echo $nombre_pro ?>&nbsp;<?php echo $informacion['Namep'] ?>" >
                    <p>
                        <?php echo $informacion['Description'] ?>
                    </p>
                    <br>
                    <?php
                    }
                    ?>
                    <form class="" action="index.html" method="post" >
                      <input type="hidden" name="name" value="<?php echo $precio  ?>" id="preciopro">
                      <div class="form-inline" style="padding-left: 18%;">
                      <div class="form-group">
                          <label for="tipo_tela">Tipo de tela: </label>
                          <label for="tipo_tela" name="" id="tipo_tela"><?php echo $tela ?></label><br>
                          <input type="hidden" name="telacp" value="<?php echo $tela ?>">

                          <label for="color-select" style="padding-right: 2%;">Color:</label>
                          <select class="" name="" id="color-select" >
                            <option class="colors" value="#B0E0E6" style="padding: 10%;">Polvo azul</option>
                            <option class="colors" value="#D3D3D3">Gris claro</option>
                            <option class="colors" value="#D8BFD8">Cardo</option>
                            <option class="colors" value="#98FB98">Verde palido</option>
                            <option class="colors" value="#F0D58C">Caqui</option>
                            <option class="colors" value="#7FFFD4">Aguamarina</option>
                            <option class="colors" value="#B0C4DE">Azul acero claro</option>
                            <option class="colors" value="#DEB887">Madera fornida</option>
                            <option class="colors" value="#48D1CC">Turquesa medio</option>
                            <option class="colors" value="#DDA0DD">Ciruela</option>
                            <option class="colors" value="#66CDAA">Aguamarina medio</option>
                            <option class="colors" value="#8FBC8F">Verde mar intenso</option>
                            <option class="colors" value="#EE82EE">Violeta</option>
                            <option class="colors" value="#87CEFA">Azul cielo claro</option>
                            <option class="colors" value="#FFA07A">Salmon claro</option>
                            <option class="colors" value="#FFA07A">Salmon claro</option>
                            <option class="colors" value="#BDB76B">Caqui oscuro</option>
                            <option class="colors" value="#F4A460">Marron arena</option>
                          </select>
                          <input type="text" class="form-control " id="recibe_color" value="Polvo azul" name="" disabled="disabled" style="padding-left: 6%;">

                      </div>
                    </div>
                      <div class="form-inline" style="padding-left: 15%;">
                        <div class="form-group " >
                          <br>
                          <?php $indentificador=$idtipo.$idmat; ?>
                          <label class="control-label col-md-3" for="alto">Alto: </label>
                          <div class="input-group">
                            <input type="text" name="alto" id="alto" value="" class="form-control input-sm " placeholder="Alto" ></h5>
                            <div class="input-group-addon">Metros</div>
                          </div><br>
                          <label class="control-label col-md-3" for="ancho">Ancho:</label>
                          <div class="input-group">
                            <input type="text" name="ancho" id="ancho" value="" class="form-control input-sm" placeholder="Ancho" required></h5>
                            <div class="input-group-addon">Metros</div>
                          </div>

                        </div>
                      </div>
                    <div class="col-md-offset-2" style="padding:1.5%">
                      <div class="form-inline">
                        <div class="form-group"><br>
                          <label for="cantidadprod">Cantidad:</label>
                          <select name="cant" class="form-control" id="cantidadprod">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                          </select>
                          </div>
                        </div>
                    </div>
              </div>
            </form>
            <!-- <div class="quitar"><div id="noprod" class="container-fluid  border-image eliminar-sli" >\
                <div class="col-md-6 " style="padding:5%;" >\
                </div>\
                <div class="col-md-6 col-sm-6" style="padding:5%; margin-top:-10% ; padding-right:0%">\
                  <br><a href="#" type="button" id="prueba" class="close eliminarsli" data-dismiss="modal" aria-hidden="true" data-id="'+id+'">&times;</a>\
                  <input type="hidden" value="'+id+'">\
                </div>\
              </div>\
              </div> -->
            <?php

            if(isset(  $_SESSION['username']) && ($_SESSION['role'] == false)){
                echo "
                      <button type='submit' href='#menu-link' data-placement='top' class= 'menu-link btn btn-primary col-md-offset-10 '  data-toggle='tooltip 'data-placement='top 'id='tooltip' title='Añadir al carrito'  ><span class='glyphicon glyphicon-shopping-cart'></span></button>
                ";
            }else{
              echo "
                  <a  href='#tootltip_nots ' data-toggle='modal' data-placement='top' class= ' btn btn-primary col-md-offset-11'  data-toggle='tooltip 'data-placement='top 'id='tooltip_ns' title='Añadir al carrito' ><span class='glyphicon glyphicon-shopping-cart'></span></a>
              ";
              }?>
              <div class="modal fade" id="tootltip_nots">
                  <div class="modal-dialog ">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                              <h2 class="modal-title">Sesion no iniciada</h4>
                          </div>

                          <div class="modal-body">
                          <h4>No se pueden añadir productos al carrito por que no se ha iniciado sesion</h4>
                          <h4>Porfavor iniciar sesion</h4>
                          </div>

                          <div class="modal-footer">
                              <a href='../login/index.php' class="btn btn-primary">Inicia Sesion / Registrarse</a>
                          </div>
                      </div>
                  </div>
              </div>


        </div>
      </div>
          <div id="menu" class=" slidepanel  " >
                <div class="divslide container-fluid">
                  <div class="col-md-4  " style="padding: 5%;">
                    <a id="button-modal-close" href="#"><span class=" menu-link glyphicon glyphicon-chevron-right "></span></a>
                  </div>
                  <h3 class="col-md-8 col-sm-8" style="color:white;">Carrito</h3>
                </div>

                <div  class="pre-scrollable eliminar-slider"  id="contiene-productos">
                </div>
                </div><br>

    <footer class="footer-basic-centered">
        <div class="container-fluid">
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
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="../js/jquery.simplecolorpicker.js"></script>
    <script src="/Decoratex/js/bigSlide.min.js"></script>
    <script src="../js/codjs_product.js"></script>
    <script src="../js/codjs_carrito.js"></script>
    <script src="../js/codjs_product2.js"></script>
    <script src="../js/js.cookie.js"></script>
    </body>
</html>
