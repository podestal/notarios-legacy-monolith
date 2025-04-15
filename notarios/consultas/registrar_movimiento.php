	<?php
    
    include("../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
    
	$kardex = $_REQUEST['codkardex'];
	
	$sql_kmov =  "SELECT
				  movirrpp.idmovreg,
				  movirrpp.kardex
				  FROM
				  movirrpp
				  where movirrpp.kardex = $kardex";
				  
	$exe_kmov = mysql_query($sql_kmov, $conexion);			  
	
	$i=0;
	
	while ($row_kmov = mysql_fetch_array($exe_kmov, MYSQL_ASSOC)){
		$kmov[0] = $row_kmov['idmovreg'];
		$i++;
	}
	
	if($i==0){
	
		echo $sql_mov = "insert into movirrpp (kardex) values('$kardex')";
		
		$exe_mov = mysql_query($sql_mov, $conexion);			  
		
		$sql_idmov = "SELECT
					  movirrpp.idmovreg,
					  movirrpp.kardex
					  FROM
					  movirrpp
					  ORDER BY cast(movirrpp.idmovreg as unsigned)  DESC";
					  
		$exe_idmov = mysql_query($sql_idmov, $conexion);			  
		
		$row_idmov = mysql_fetch_array($exe_idmov, MYSQL_ASSOC);
		
		$new_idmov = $row_idmov['idmovreg'];
		
		$idmovreg = correlativo_numero10($new_idmov);
	
	}else{
		
		$new_idmovreg = $kmov[0];
		
		$idmovreg = correlativo_numero10($new_idmovreg);
		
	}
	
	$fechamov = $_REQUEST['mov_fecha'];
	$vencimiento = $_REQUEST['mov_venc'];
	$titulorp = strtoupper($_REQUEST['mov_titulo']);
	$idsedereg = $_REQUEST['mov_ofreg'];
	$idsecreg = $_REQUEST['mov_secreg'];
	$idtiptraoges = $_REQUEST['mov_tramite'];
	$idestreg = $_REQUEST['mov_estado'];
	$encargado = strtoupper($_REQUEST['mov_encargado']);
	$anotacion = strtoupper($_REQUEST['mov_anotacion']);
	$importee = $_REQUEST['mov_importe'];
	$observa = strtoupper($_REQUEST['mov_obs']);
	/*$numeroo = $_REQUEST[''];
	$mayorderecho = $_REQUEST[''];*/
	
	echo $sql_detmov = "insert into detallemovimiento (idmovreg, fechamov, vencimiento, titulorp, idsedereg, idsecreg, idtiptraoges, idestreg, encargado, anotacion, importee, observa, numeroo, mayorderecho) values('$idmovreg', '$fechamov', '$vencimiento', '$titulorp', '$idsedereg', '$idsecreg', '$idtiptraoges', '$idestreg', '$encargado', '$anotacion', '$importee', '$observa', '$numeroo', '$mayorderecho')";

    $exe_detmov = mysql_query($sql_detmov, $conexion);
	
	?>