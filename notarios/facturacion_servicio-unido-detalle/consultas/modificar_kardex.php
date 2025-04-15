	<?php

	include("../../extraprotocolares/view/funciones.php");
		
	$conexion = Conectar();
	
	$id_dregventas = $_REQUEST['id'];
	
	$kardex = $_REQUEST['kardex'];

	$sql_upkardex = "UPDATE d_regventas SET kardex = '$kardex' WHERE d_regventas.id_dregventas = '$id_dregventas'";
	
	$exe_upkardex = mysql_query($sql_upkardex, $conexion);
	
	?>