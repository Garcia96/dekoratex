<?php
require('../../extras/fpdf/fpdf.php');
include("../../login/conexion.php");
class PDF extends FPDF {
function Header() {
$this->SetFont('Arial','B',20);
$this->Ln(5);
$this->Cell(0,20,"Listado clientes",0,0,'C');
$this->Ln(20);
$this->SetFont('Arial','I',10);
$this->Cell(0,15,"Reporte creado:".date("y-m-d"),0,0,'C');
$this->Ln(5);
}
}
$pdf= new PDF('P', 'mm', 'A3');
$pdf->SetAutoPageBreak(false);
$pdf->AddPage();
$valor_inicial_eje_y = 70;
$pdf->SetFillColor(255, 255, 255);
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetY($valor_inicial_eje_y);
$pdf->SetX(3);
$pdf->Cell(26, 10, 'ID', 1, 0, 'L', 1);
$pdf->Cell(30, 10, 'Nombre', 1, 0, 'L', 1);
$pdf->Cell(30, 10, 'Apellido', 1, 0, 'L', 1);
$pdf->Cell(65, 10, 'Email', 1, 0, 'L', 1);
$pdf->Cell(36, 10, 'Direccion', 1, 0, 'L', 1);
$pdf->Cell(25, 10, 'Telefono', 1, 0, 'L', 1);
$pdf->Cell(30, 10, 'Nacimiento', 1, 0, 'L', 1);
$pdf->Cell(30, 10, 'Regsitro', 1, 0, 'L', 1);
$pdf->Cell(15, 10, 'Role', 1, 0, 'L', 1);
$eje_y = 80;
if($_POST['componente']=="todos"){
  $q="select idUser,Name,Lastname,email,Address,phone,birthdate,admission,idRole from user where idrole=2 ORDER BY ".$_POST['orden']." ";
}else {
  if($_POST['fecha-hasta'] === ""){
    $_POST['fecha-hasta']=date("y-m-d");
  }
  $q="select idUser,Name,Lastname,email,Address,phone,birthdate,admission,idRole from user where idrole=2 and ".$_POST['componente']." BETWEEN '".$_POST['fecha-dese']."' AND '".$_POST['fecha-hasta']."' ORDER BY ".$_POST['orden']."";
}
$r=mysqli_query($conexion,$q);
$i=0;
$max=25;
$altura_fila=10;
while($fila=mysqli_fetch_row($r)){
  if($i==$max){
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'I', 12);
    $pdf->SetY($valor_inicial_eje_y);
    $pdf->SetX(3);
    $pdf->Cell(26, 10, 'ID', 1, 0, 'L', 1);
    $pdf->Cell(30, 10, 'Nombre', 1, 0, 'L', 1);
    $pdf->Cell(30, 10, 'Apellido', 1, 0, 'L', 1);
    $pdf->Cell(65, 10, 'Email', 1, 0, 'L', 1);
    $pdf->Cell(36, 10, 'Direccion', 1, 0, 'L', 1);
    $pdf->Cell(25, 10, 'Telefono', 1, 0, 'L', 1);
    $pdf->Cell(30, 10, 'Fecha nacimiento', 1, 0, 'L', 1);
    $pdf->Cell(30, 10, 'Fecha de regsitro', 1, 0, 'L', 1);
    $pdf->Cell(15, 10, 'Role', 1, 0, 'L', 1);
    $eje_y= $eje_y + $altura_fila;
    $i=0;
  }
  $id=$fila[0];
  $name=$fila[1];
  $last=$fila[2];
  $email=$fila[3];
  $dir=$fila[4];
  $tel=$fila[5];
  $birth=$fila[6];
  $admi=$fila[7];
  if($role=$fila[8]==1){
    $role="Admin";
  }else {
    $role="User";
  }
  $pdf->SetFont('Arial', 'I', 12);
  $pdf->SetY($eje_y);
  $pdf->SetX(3);
  $pdf->Cell(26, 10, $id, 1, 0, 'L', 1);
  $pdf->Cell(30, 10, $name, 1, 0, 'L', 1);
  $pdf->Cell(30, 10, $last, 1, 0, 'L', 1);
  $pdf->Cell(65, 10, $email, 1, 0, 'L', 1);
  $pdf->Cell(36, 10, $dir, 1, 0, 'L', 1);
  $pdf->Cell(25, 10, $tel, 1, 0, 'L', 1);
  $pdf->Cell(30, 10, $birth, 1, 0, 'L', 1);
  $pdf->Cell(30, 10, $admi, 1, 0, 'L', 1);
  $pdf->Cell(15, 10, $role, 1, 0, 'L', 1);
  $eje_y = $eje_y + $altura_fila;
  $i = $i + 1;
}
mysqli_close($conexion);
$pdf->Output("clientes.pdf",'F');
echo "<script language='javascript'>window.open('clientes.pdf','_self');</script>";

 ?>
