<?php
session_start();
  $arreglo2=$_SESSION['carrito'];
  for($i = 0; $i<count($arreglo2);$i++){
      if($arreglo2['identificador']== $_POST['id']){
        $nuevosdatos[] =array(
          'nombre'=>$arreglo2[$i]["nombre"],
          'imagen'=>$arreglo2[$i]["imagen"],
          'alto'=>$arreglo2[$i]["alto"],
          'ancho'=>$arreglo2[$i]["ancho"],
          'cantidad'=>$arreglo2[$i]["cantidad"],
          'color'=>$arreglo2[$i]["color"],
          'tela'=>$arreglo2[$i]["tela"],
          'total'=>$arreglo2[$i]["total"]);
      }
    }
      if (isset($nuevosdatos)) {
        $_SESSION['carrito']=$nuevosdatos;
      }
 ?>
