<?php  
	session_start();

	if(isset($_SESSION['autentificado'])){
		if(($_SESSION['role']) == false){
		echo "<script> location.href='../../index.php'</script>";
		}
	}else{
		echo "<script> location.href='../../index.php'</script>";
	}
?>