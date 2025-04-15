
<?php

	function dame_ubigeo($id){
		
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
					 ubigeo.coddis = '$id'";
		 
		$ejecuta = mysql_query($consulta, $conexion);
		 
		while($ubigeos = mysql_fetch_array($ejecuta, MYSQL_ASSOC))
		{
			$arr_ubigeos["id"] = $ubigeos["id"];
			$arr_ubigeos["departamento"] = $ubigeos["departamento"];
			$arr_ubigeos["provincia"] = $ubigeos["provincia"];
			$arr_ubigeos["distrito"] = $ubigeos["distrito"];
		}
		 
		// var_dump($datos);
		 
		return $arr_ubigeos["distrito"].'/'.$arr_ubigeos["provincia"].'/'.$arr_ubigeos["departamento"];
	
	}
 
?>