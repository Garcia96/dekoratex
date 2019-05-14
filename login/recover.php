<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../estilo_index.css">
  <title>Dekoratex - Registro</title>
</head>

<body style="padding-top: 100px;">

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
                include "login/conexion.php";

                $resultado=mysqli_query($conexion,"select * from product ");
                while($f=mysqli_fetch_array($resultado)){
                 ?>
                <li><a href=../Product/index.php?idp=<?php echo $f['idProd']; ?>&np=<?php echo $f['Name']?>><?php echo $f['Name']; ?></a></li>
                <?php
                }
                 ?>
              </ul>
            </li>
            <li><a href="../us.php"><span class="glyphicon glyphicon-info-sign glyphicon-info-sign"></span> Nosotros</a></li>
            <li><a href="../contact.php"><span class="glyphicon glyphicon-envelope glyphicon-envelope"></span> Contacto</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li style="display:inline-block"><a href="#ventana1" data-toggle="modal"><span class="glyphicon glyphicon-search"></span></a>

            </li>
            <li style="display:inline-block" class="facebook"><a href="https://www.facebook.com/Decoratex-1397698147200574/?fref=ts" target="_blank" class=""><i class="fa fa-facebook color_fb"></i></a></li>
            <li style="display:inline-block" class="twitter"><a href="https://twitter.com/Decoratex3" target="_blank" class=""><i class="fa fa-twitter color_tt"></i></a></li>
            <?php
            session_start();
            if(isset($_SESSION['username'])){
                echo "<li class='dropdown'>
                  <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'><span class='glyphicon glyphicon-user'></span> CUENTA <span class='caret'></span></a>
                  <ul class='dropdown-menu'>
                    <li><a href='user/index.php'>Ver mi cuenta</a></li>
                    <li><a href='login/logout.php'>Cerrar Sesion</a></li>
                  </ul>
                </li>";
            }else{
                echo "<li style='align:center'><a href='index.php'><strong>Inicia Sesion / Registrarse</strong></a></li>";
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

        <div class="container registro">
          <div class="col-md-12 "  style="padding: 5%;">
              <div class="form-group">
                <h3>Recuperar contraseña</h3><br>
                <form action="" method="post">
                  <label for="">Correo</label>
                  <input name="corr" class="form-control" type="email" required placeholder="example@example.com"><br>
                  <input name="olvidar" value="Enviar" class="btn btn-primary" type="submit">
                </form>
                <?php
                require("conexion.php");
                  if(isset($_POST['olvidar'])){
                    $code = rand(100000000,999999999);
                    mysqli_query($conexion,"update user set cod = '$code' where email = '".$_POST['corr']."'");
                    $query = mysqli_query($conexion,"select * from user where email = '".$_POST['corr']."'");
                    if($i = mysqli_fetch_array($query)){
                      include_once("../extras/class.phpmailer.php");
                      include_once("../extras/class.smtp.php");

                      $mensaje ="Env&iacuteo desde formulario de Inicio de Sesi&oacuten de Dekoratex.co<br><br>";
                      $mensaje .="Hola ".$i['Name'].". Vemos que has olvidado tu contrase&ntildea. ";
                      $mensaje .="No te preocupes, podras cambiarla en el enlace a continuaci&oacuten ";
                      $mensaje .="<a href='http://localhost/Decoratex/login/recovered.php?valid=$code'>Recuperar contrase&ntildea</a><br><br>";
                      $mensaje .='Si tiene alguna pregunta o necesita ayuda. Pregunte al <a href="mailto:cngarciag@gmail.com">administrador</a> del sitio <br><br><br>';
                      $mensaje .="Gracias por escoger a Dekoratex, esperamos que disfrute nuestros servicios.<br><br>No responder. Este correo es enviado desde el m&oacutedulo de env&iacuteo autom&aacutetico";

                      $mail = new PHPMailer();
                      $mail->IsSMTP();
                      $mail->SMTPDebug = 0;
                      $mail->Host = "smtp.gmail.com";
                      $mail->Port = 587;
                      $mail->SMTPSecure = "tls";
                      $mail->SMTPAuth = true;
                      $mail->Username = "cngarciag@gmail.com";
                      $mail->Password = "mine06lol";
                      $mail->SetFrom("cngarciag@gmail.com", "Dekoratex");
                      $mail->AddAddress($i['email'], $i['Name']);
                      $asunto = "Recuperar contraseña";
                      $asunto = "=?ISO-8859-1?B?".base64_encode($asunto)."=?=";
                      $mail->Subject = $asunto;
                      $mail->MsgHTML($mensaje);

                      if($mail->Send()){
                        $respuesta = "Se ha enviado un correo ha ".$_POST['corr']." para continuar con la recuperación de su contraseña";
                        echo "<script> location.href='index.php?respuesta=$respuesta'</script>";
                      }else{
                        $respuesta = "No se pudo concretar la operación";
                        echo "<script> location.href='index.php?respuesta=$respuesta'</script>";
                      }
                    }
                  }

                ?>
            </div>
          </div>
        </div>

  <br>
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>
