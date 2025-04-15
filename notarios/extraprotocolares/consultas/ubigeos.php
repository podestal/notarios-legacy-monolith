<?php

	include("../../extraprotocolares/view/funciones.php");
	
	$term=$_GET['term'];
		
	$conexion = Conectar();
 	
	$i=0;
	 
	$consulta = "SELECT
				 ubigeo.coddis as id,
				 ubigeo.nomdpto as departamento,
				 ubigeo.nomprov as provincia,
				 ubigeo.nomdis as distrito,
				 ubigeo.codpto as id_dpto,
				 ubigeo.codprov as id_prov,
				 ubigeo.coddist as id_dist
				 FROM
				 ubigeo
				 WHERE 
				 concat(ubigeo.nomdis,'/',ubigeo.nomprov) like '%$term%' 
 				 ORDER BY ubigeo.nomdis ASC";
	 
	$ejecuta = mysql_query($consulta, $conexion);
	 
	while($ubigeos = mysql_fetch_array($ejecuta, MYSQL_ASSOC))
	{
		$arr_ubigeos[$i]["id"] = $ubigeos["id"];
		$arr_ubigeos[$i]["departamento"] = $ubigeos["departamento"];
		$arr_ubigeos[$i]["provincia"] = $ubigeos["provincia"];
		$arr_ubigeos[$i]["distrito"] = $ubigeos["distrito"];
	$i++;
	}
	 
	$j=0;
	 
	foreach($arr_ubigeos as $row)
	{
		$row=(array)$row;
		$datos[]=array("id" => $row["id"], "value" => $row['distrito'].'/'.$row['provincia'].'/'.$row['departamento']);
	}
	 
	// var_dump($datos);
	 
	echo json_encode($datos);
 
?>