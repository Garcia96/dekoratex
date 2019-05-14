<?php
session_start();
$arreglo2=$_SESSION['carrito'];
$suma=0;
for($i = 0; $i<count($arreglo2);$i++){
  $suma=$_POST['Total']+$suma ;
}
$_SESSION['carrito'] = $arreglo2;
echo $suma;
 ?>
