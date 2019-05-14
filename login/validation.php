<?php
session_start();
require("conexion.php");
if(isset($_POST['email']) && isset($_POST['pass']) ){
    $query = "select * from user where email = '".$_POST['email']."' ";
    $respuesta = mysqli_query($conexion, $query);

    if($dato = mysqli_fetch_array($respuesta)){
    $nombre = $dato['Name'];
    $contras = sha1(md5($_POST['pass']));
    // $contras = $_POST['pass'];
        if($contras==$dato['password']){
            if($dato['idrole']==2){
                if($dato['state']==1){
                $_SESSION['autentificado']= true;
                $_SESSION['role'] = false;
                $_SESSION['username']= $nombre;
                echo "<script> location.href='../index.php'</script>";
            }else{
                echo "Su cuenta no ha sido verificada";
                echo "<script> location.href='index.php?respuesta=Su cuenta no ha sido activada'</script>";
            }
            }else{
                $_SESSION['autentificado']= true;
                $_SESSION['role'] = true;
                $_SESSION['username']= $nombre;
                echo "<script> location.href='../user/admin/admin.php'</script>";
            }
        }else{
            echo "Algo salio mal<br>";
            echo "Contraseña incorrecta";
            echo "<script> location.href='index.php?respuesta=La contraseña es incorrecta'</script>";
        }
    }else{
        echo "Algo salio mal<br>";
        echo "Usuario no encontrado";
        echo "<script> location.href='index.php?respuesta=El correo no ha sido encontrado en nuestras bases de datos'</script>";
    }
}else{
    echo "Debe llenar los campos";
}
mysqli_close($conexion);
 ?>
