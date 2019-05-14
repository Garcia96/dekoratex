<?php
require('../../extras/fpdf/fpdf.php');
include("../../login/conexion.php");
class PDF extends FPDF {
function Header() {
$this->SetFont('Arial','B',20);
$this->Ln(5);
$this->Cell(0,20,"Ventas",0,0,'C');
$this->Ln(20);
$this->SetFont('Arial','I',10);
$this->Cell(0,15,"Reporte creado:".date("y-m-d"),0,0,'C');
$this->Ln(5);
}
}
$pdf= new PDF('P', 'mm', 'A4');
$pdf->SetAutoPageBreak(false);
$pdf->AddPage();
$valor_inicial_eje_y = 60;
$pdf->SetFillColor(255, 255, 255);
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetY($valor_inicial_eje_y);
$pdf->SetX(20);
$pdf->Cell(30, 10, 'No.', 1, 0, 'C', 1);
$pdf->Cell(40, 10, 'Fecha', 1, 0, 'L', 1);
$pdf->Cell(40, 10, 'Total', 1, 0, 'L', 1);
$pdf->Cell(50, 10, 'Estado', 1, 0, 'C', 1);
$eje_y = 70;
if($_POST['componente']=="todos"){
  $q="select idSale,sale_date,total,state from sale  ORDER BY ".$_POST['orden']." ";
}elseif ($_POST['componente']=="sale_date") {
  if($_POST['fecha-hasta'] === ""){
    $_POST['fecha-hasta']=date("y-m-d");
  }
  $q="select idSale,sale_date,total,state from sale where ".$_POST['componente']." BETWEEN '".$_POST['fecha-dese']."' and '".$_POST['fecha-hasta']."'  ORDER BY ".$_POST['orden']." ";
}elseif ($_POST['componente']=="total") {
  $q="select idSale,sale_date,total,state from sale where ".$_POST['componente']." >= '".$_POST['valor-venta']."'  ORDER BY ".$_POST['orden']." ";
}else{
  $q="select idSale,sale_date,total,state from sale where ".$_POST['componente']." = ".$_POST['estadov']."  ORDER BY ".$_POST['orden']." ";
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
    $pdf->SetX(20);
    $pdf->Cell(30, 10, 'No.', 1, 0, 'L', 1);
    $pdf->Cell(40, 10, 'Fecha', 1, 0, 'L', 1);
    $pdf->Cell(40, 10, 'Total', 1, 0, 'L', 1);
    $pdf->Cell(50, 10, 'Estado', 1, 0, 'L', 1);
    $eje_y= $eje_y + $altura_fila;
    $i=0;
  }
  $no=$fila[0];
  $fecha=$fila[1];
  $total=$fila[2];
  $estado=$fila[3];

  if($es=$fila[3]==1){
    $es="Finalizado";
  }else if($es=$fila[3]==2) {
    $es="Pendiente";
  }else if($es=$fila[3]==3) {
    $es="Cancelado";
  }else{
    $es="Sin confirmar";
  }
  $pdf->SetFont('Arial', 'I', 12);
  $pdf->SetY($eje_y);
  $pdf->SetX(20);
  $pdf->Cell(30, 10, $no, 1, 0, 'C', 1);
  $pdf->Cell(40, 10, $fecha, 1, 0, 'L', 1);
  $pdf->Cell(40, 10, $total, 1, 0, 'L', 1);
  $pdf->Cell(50, 10, $es, 1, 0, 'C', 1);

  $eje_y = $eje_y + $altura_fila;
  $i = $i + 1;
}
mysqli_close($conexion);
$pdf->Output("ventas.pdf",'F');
echo "<script language='javascript'>window.open('ventas.pdf','_self');</script>";
 ?>
