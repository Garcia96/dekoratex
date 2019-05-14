<?php
    require('conexion.php');
    $id = mysqli_query($conexion,"select idUser from user where idUser = '".$_POST['cedula']."'");
    $num = mysqli_num_rows($id);
    $co = mysqli_query($conexion,"select email from user where email = '".$_POST['correo']."'");
    $nu = mysqli_num_rows($co);
    if($num == 0){
        if($nu == 0){
            echo "No se encontro el cor";
            if( isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['cedula']) && isset($_POST['fecha']) && isset($_POST['direccion'])
            && isset($_POST['telefono']) && isset($_POST['correo']) && isset($_POST['contraseña']) && isset($_POST['contraseña2'])
            && ($_POST['contraseña2'] == $_POST['contraseña'])){
                $query = "insert into user values ('$_POST[cedula]','$_POST[nombre]','$_POST[apellido]','$_POST[correo]','". sha1(md5($_POST[contraseña]))."'
                ,'$_POST[direccion]','$_POST[telefono]','$_POST[fecha]',CURDATE(),'2','0','')";
                $respuesta = mysqli_query($conexion,$query);
                // echo "registro exitoso"; 
                        $code = rand(100000000,999999999);
                        mysqli_query($conexion,"update user set cod = '$code' where email = '".$_POST['correo']."'");
                      include_once("../extras/class.phpmailer.php");
                      include_once("../extras/class.smtp.php");

                        $mensaje ="Env&iacuteo desde formulario de Registro de Dekoratex.co<br><br>";
                        $mensaje .="Felicidades, se ha creado la cuenta para ".$_POST['nombre']." ".$_POST['apellido'].".<br>";
                        $mensaje .="Para activar su cuenta, por favor haga click en el enlace a continuaci&oacuten ";
                        $mensaje .="<a href='http://localhost/Decoratex/login/active.php?valide=$code'>Activar cuenta</a><br><br>";
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
                        $mail->AddAddress($_POST['correo'], $_POST['nombre']);
                        $mail->Subject = "Verificacion de cuenta";
                        $mail->MsgHTML($mensaje);

                        if($mail->Send()){
                          $respuesta = "Se ha enviado un correo ha ".$_POST['correo']." para continuar con la activación de su cuenta";
                        }else{
                          $respuesta ="No se pudo enviar el mensaje. Error: ".$mail->ErrorInfo;
                        }
                        header("Location: index.php?respuesta=$respuesta");
            }else{
                $respuesta = "Las contraseñas no coinciden";
                header("Location: index.php?respuesta=$respuesta");
            }
        }else{
            $respuesta = "El correo suministrado ya se encuentra registrado";
            header("Location: index.php?respuesta=$respuesta");
        }
    }else{
        $respuesta = "El numero de identificación suministrado ya se encuentra registrado";
        header("Location: index.php?respuesta=$respuesta");
    }
 ?>
