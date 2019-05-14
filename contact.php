<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head>
  <link rel="shortcut icon" type="image/x-icon" href="image/favicon.ico">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="estilo_index.css">
  <title>Dekoratex - Contacto</title>
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
          <a class="navbar-brand " href=""><img src="image/logo2.png" class="imagenheader" alt="Logo" /></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class=""><a href="index.php"><span class="glyphicon glyphicon-globe glyphicon-globe"></span> Inicio <span class="sr-only">(current)</span></a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-shopping-cart glyphicon-shopping-cart"></span> Productos <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <?php
                include "login/conexion.php";

                $resultado=mysqli_query($conexion,"select * from product ");
                while($f=mysqli_fetch_array($resultado)){
                 ?>
                <li><a href=Product/index.php?idp=<?php echo $f['idProd'];?>&np=<?php echo $f['Name']?>><?php echo $f['Name']; ?></a></li>
                <?php
                }
                 ?>
              </ul>
            </li>
            <li ><a href="us.php"><span class="glyphicon glyphicon-info-sign glyphicon-info-sign"></span> Nosotros</a></li>
            <li class="active"><a href="contact.php"><span class="glyphicon glyphicon-envelope glyphicon-envelope"></span> Contacto</a></li>
            <?php if(isset($_SESSION['username'])){
              if($_SESSION['role']== false){
                echo '<li><a href="Product/cart.php"><span class="glyphicon glyphicon-list-alt"></span> Carro de compras</a></li>';
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
                  echo "<li><a href='user/index.php'>Ver mi cuenta</a></li>";
                  echo "<li><a href='login/logout.php'>Cerrar Sesion</a></li>";
                }else{
                  echo "<li><a href='user/admin/admin.php'>Administrar</a></li>";
                  echo "<li><a href='user/index.php'>Ver mi cuenta</a></li>";
                  echo "<li><a href='login/logout.php'>Cerrar Sesion</a></li>";
                }
                echo "</ul>";
                echo "</li>";
            }else{
                echo "<li style='align:center'><a href='login/index.php'><strong>Inicia Sesion / Registrarse</strong></a></li>";
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
  </div>
  <br>
  <div class="registro">
    <div class="container">
      <br>
      <div class="row">
        <div class="col-sm-7">
          <div style="padding: 5%;">
            <h2>Contactanos</h2>
            <form method="post">
              <input type="text" class="form-control" name="nombre" required placeholder="Nombre"><br>
              <input type="email" class="form-control" name="correo" required placeholder="Correo"><br>
              <input type="text" class="form-control" name="asunto" required placeholder="Asunto"><br>
              <textarea name="texto" cols="60" rows="5" style="resize: none; height:200" class="form-control" placeholder="Dudas e inquietudes..." required></textarea><br>
              <input type="submit" class="btn btn-primary center-block" style="width: 25%" name="contactar" value="Enviar">
              <?php
                error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
                if(isset($_GET['respuesta'])){
                  echo "<span>".$_GET['respuesta']."</span>";
                }
               ?>
            </form>
            <?php
              include_once("extras/class.phpmailer.php");
              include_once("extras/class.smtp.php");
              if(isset($_POST['contactar'])){
                $mensaje ="Envio desde formulario de contacto de Dekoratex\n\n";
                $mensaje .="Nombre: ". $_POST['nombre'] . "\n";
                $mensaje .="Email: " . $_POST['correo'] . "\n";
                $mensaje .="Mensaje: " . $_POST['texto'] . "\n";

                $mail = new PHPMailer();
                $mail->IsSMTP();
                $mail->SMTPDebug = 0;
                $mail->Host = "smtp.gmail.com";
                $mail->Port = 587;
                $mail->SMTPSecure = "tls";
                $mail->SMTPAuth = true;
                $mail->Username = "cngarciag@gmail.com";
                $mail->Password = "mine06lol";
                $mail->SetFrom($_POST['correo'], $_POST['nombre']);
                $mail->AddAddress("cngarciag@gmail.com");
                $mail->Subject = $_POST['asunto'];
                $mail->MsgHTML($mensaje);
                $mail->AltBody = $mensaje;

                if($mail->Send()){
                  echo "El mensaje se envió con exito";
                }else{
                  echo "No se pudo enviar el mensaje. Error: ".$mail->ErrorInfo;
                }
              }
             ?>
          </div>
        </div>
        <div class="col-sm-5">
          <div style="padding: 5%">
            <h4>Barrio Alqueria - Bogotá - Colombia</h4>
            <h5><span class="glyphicon glyphicon-phone"></span> Telefono: 310 291 5905 </h5><br>
            <div class="embed-responsive embed-responsive-4by3">
              <iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7953.935838079851!2d-74.
              13555890910735!3d4.59976928415822!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3f9ecfa5cd3b69%3A0x868ea50cc1038
              a7d!2sCl.+40+Sur+%2353-3%2C+Bogot%C3%A1!5e0!3m2!1ses-419!2sco!4v1463784877722" width="600" height="450" style="border:0;
              padding: 0%;" allowfullscreen>
              </iframe>
            </div>
          </div>
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
