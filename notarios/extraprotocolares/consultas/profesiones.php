<?php

	include("../../extraprotocolares/view/funciones.php");
	
	$term=$_GET['term'];
		
	$conexion = Conectar();
 	
	$i=0;
	 
	$consulta = "SELECT
				 profesiones.idprofesion,
				 profesiones.codprof,
				 profesiones.desprofesion
				 FROM
				 profesiones
				 WHERE 
				 profesiones.desprofesion like '%$term%' 
 				 ORDER BY profesiones.desprofesion ASC";
	 
	$ejecuta = mysql_query($consulta, $conexion);
	 
	while($ubigeos = mysql_fetch_array($ejecuta, MYSQL_ASSOC))
	{
		$arr_ubigeos[$i]["idprofesion"] = $ubigeos["idprofesion"];
		$arr_ubigeos[$i]["codprof"] = $ubigeos["codprof"];
		$arr_ubigeos[$i]["desprofesion"] = $ubigeos["desprofesion"];
	$i++;
	}
	 
	$j=0;
	 
	foreach($arr_ubigeos as $row)
	{
		$row=(array)$row;
		$datos[]=array("id" => $row["idprofesion"], "value" => $row['desprofesion']);
	}
	 
	// var_dump($datos);
	 
	echo json_encode($datos);
 
?>