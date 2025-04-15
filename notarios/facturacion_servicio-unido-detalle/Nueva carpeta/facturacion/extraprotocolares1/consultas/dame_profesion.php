	<?php
    
	function dame_profesion($id){
		
		$conexion = Conectar();
		
		$i=0;
		 
		$consulta = "SELECT
 				 	 profesiones.idprofesion,
					 profesiones.codprof,
					 profesiones.desprofesion
					 FROM
					 profesiones
					 WHERE 
					 profesiones.idprofesion = '$id'";
		 
		$ejecuta = mysql_query($consulta, $conexion);
		 
		while($ubigeos = mysql_fetch_array($ejecuta, MYSQL_ASSOC))
		{
			$arr_ubigeos["idprofesion"] = $ubigeos["idprofesion"];
			$arr_ubigeos["codprof"] = $ubigeos["codprof"];
			$arr_ubigeos["desprofesion"] = $ubigeos["desprofesion"];
		}
		 
		// var_dump($datos);
		 
		return $arr_ubigeos["desprofesion"];
	
	}
    
	?>