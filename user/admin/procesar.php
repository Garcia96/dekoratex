<?php
	include('../../login/conexion.php');

	$año = $_POST['año'];
	$opc = $_POST['opcion'];
	if($opc == "clientes"){
		$enero = mysqli_fetch_array(mysqli_query($conexion, "SELECT COUNT(idUser) AS r FROM user WHERE MONTH(admission)=1 AND YEAR(admission)='$año' and idrole=2"));
		$febrero = mysqli_fetch_array(mysqli_query($conexion, "SELECT COUNT(idUser) AS r FROM user WHERE MONTH(admission)=2 AND YEAR(admission)='$año' and idrole=2"));
		$marzo = mysqli_fetch_array(mysqli_query($conexion, "SELECT COUNT(idUser) AS r FROM user WHERE MONTH(admission)=3 AND YEAR(admission)='$año' and idrole=2"));
		$abril = mysqli_fetch_array(mysqli_query($conexion, "SELECT COUNT(idUser) AS r FROM user WHERE MONTH(admission)=4 AND YEAR(admission)='$año' and idrole=2"));
		$mayo = mysqli_fetch_array(mysqli_query($conexion, "SELECT COUNT(idUser) AS r FROM user WHERE MONTH(admission)=5 AND YEAR(admission)='$año' and idrole=2"));
		$junio = mysqli_fetch_array(mysqli_query($conexion, "SELECT COUNT(idUser) AS r FROM user WHERE MONTH(admission)=6 AND YEAR(admission)='$año'and idrole=2"));
		$julio = mysqli_fetch_array(mysqli_query($conexion, "SELECT COUNT(idUser) AS r FROM user WHERE MONTH(admission)=7 AND YEAR(admission)='$año' and idrole=2"));
		$agosto = mysqli_fetch_array(mysqli_query($conexion, "SELECT COUNT(idUser) AS r FROM user WHERE MONTH(admission)=8 AND YEAR(admission)='$año' and idrole=2"));
		$septiembre = mysqli_fetch_array(mysqli_query($conexion, "SELECT COUNT(idUser) AS r FROM user WHERE MONTH(admission)=9 AND YEAR(admission)='$año' and idrole=2"));
		$octubre = mysqli_fetch_array(mysqli_query($conexion, "SELECT COUNT(idUser) AS r FROM user WHERE MONTH(admission)=10 AND YEAR(admission)='$año' and idrole=2"));
		$noviembre = mysqli_fetch_array(mysqli_query($conexion, "SELECT COUNT(idUser) AS r FROM user WHERE MONTH(admission)=11 AND YEAR(admission)='$año' and idrole=2"));
		$diciembre = mysqli_fetch_array(mysqli_query($conexion, "SELECT COUNT(idUser) AS r FROM user WHERE MONTH(admission)=12 AND YEAR(admission)='$año' and idrole=2"));

		$data = array(0 => $enero['r'],
					  1 => $febrero['r'],
					  2 => $marzo['r'],
					  3 => $abril['r'],
					  4 => $mayo['r'],
					  5 => $junio['r'],
					  6 => $julio['r'],
					  7 => $agosto['r'],
					  8 => $septiembre['r'],
					  9 => $octubre['r'],
					  10 => $noviembre['r'],
					  11 => $diciembre['r']
					  );
		echo json_encode($data);
	}else if($opc == "ventas"){
		$enero = mysqli_fetch_array(mysqli_query($conexion, "SELECT SUM(total) AS r FROM sale WHERE MONTH(sale_date)=01 AND YEAR(sale_date)='$año' and state=1"));
		$febrero = mysqli_fetch_array(mysqli_query($conexion, "SELECT SUM(total) AS r FROM sale WHERE MONTH(sale_date)=02 AND YEAR(sale_date)='$año' and state=1"));
		$marzo = mysqli_fetch_array(mysqli_query($conexion, "SELECT SUM(total) AS r FROM sale WHERE MONTH(sale_date)=03 AND YEAR(sale_date)='$año' and state=1"));
		$abril = mysqli_fetch_array(mysqli_query($conexion, "SELECT SUM(total) AS r FROM sale WHERE MONTH(sale_date)=04 AND YEAR(sale_date)='$año' and state=1"));
		$mayo = mysqli_fetch_array(mysqli_query($conexion, "SELECT SUM(total) AS r FROM sale WHERE MONTH(sale_date)=05 AND YEAR(sale_date)='$año' and state=1"));
		$junio = mysqli_fetch_array(mysqli_query($conexion, "SELECT SUM(total) AS r FROM sale WHERE MONTH(sale_date)=06 AND YEAR(sale_date)='$año' and state=1"));
		$julio = mysqli_fetch_array(mysqli_query($conexion, "SELECT SUM(total) AS r FROM sale WHERE MONTH(sale_date)=07 AND YEAR(sale_date)='$año' and state=1"));
		$agosto = mysqli_fetch_array(mysqli_query($conexion, "SELECT SUM(total) AS r FROM sale WHERE MONTH(sale_date)=08 AND YEAR(sale_date)='$año' and state=1"));
		$septiembre = mysqli_fetch_array(mysqli_query($conexion, "SELECT SUM(total) AS r FROM sale WHERE MONTH(sale_date)=09 AND YEAR(sale_date)='$año' and state=1"));
		$octubre = mysqli_fetch_array(mysqli_query($conexion, "SELECT SUM(total) AS r FROM sale WHERE MONTH(sale_date)=10 AND YEAR(sale_date)='$año' and state=1"));
		$noviembre = mysqli_fetch_array(mysqli_query($conexion, "SELECT SUM(total) AS r FROM sale WHERE MONTH(sale_date)=11 AND YEAR(sale_date)='$año' and state=1"));
		$diciembre = mysqli_fetch_array(mysqli_query($conexion, "SELECT SUM(total) AS r FROM sale WHERE MONTH(sale_date)=12 AND YEAR(sale_date)='$año' and state=1"));

		$data = array(0 => $enero['r'],
					  1 => $febrero['r'],
					  2 => $marzo['r'],
					  3 => $abril['r'],
					  4 => $mayo['r'],
					  5 => $junio['r'],
					  6 => $julio['r'],
					  7 => $agosto['r'],
					  8 => $septiembre['r'],
					  9 => $octubre['r'],
					  10 => $noviembre['r'],
					  11 => $diciembre['r']
					  );
		echo json_encode($data);
	}
?>
