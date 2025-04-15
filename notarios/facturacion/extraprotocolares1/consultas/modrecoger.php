	<?php
	
    include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
	
	$totallibros = $_REQUEST['numlibros'];
	
	$l_cliente = strtoupper($_REQUEST['l_cliente']);
	$l_doi = $_REQUEST['l_doi'];	
	$l_fecha = $_REQUEST['l_fecha'];
	$l_anio = $_REQUEST['l_anio'];
	$l_comprobante = strtoupper($_REQUEST['l_comprobante']);	
	
	for($i=1; $i<=$totallibros; $i++){
		$cod = correlativo_numero($i);
		if(isset($_REQUEST['idlibro'.$cod])){
			$numlibro = $_REQUEST['idlibro'.$cod];
			$sql_updlibro = "update libros set libros.flag=1 where libros.numlibro = $numlibro and libros.ano= $l_anio";
			$exe_updlibro = mysql_query($sql_updlibro, $conexion);
			
			$sql_insrecogio = "insert into recogio_libro (numlibro, nomape, documen, fecha, comprobante) values('$l_anio.$numlibro', '$l_cliente', '$l_doi', '$l_fecha', '$l_comprobante')";
			$exe_insrecogio = mysql_query($sql_insrecogio, $conexion);
			
		}
	}

	?>