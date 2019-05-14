<?php
    $conexion = mysqli_connect("localhost","root","1234","dekoratex");
    if(!$conexion)
      echo "Problemas de conexion con el servidor o la base de datos".mysqli_connect_error();
 ?>
