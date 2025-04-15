<?php

	session_start();
	
	include("../../extraprotocolares/view/funciones.php");
		
	$conexion = Conectar();
	
	$tip_comp = $_REQUEST['tip_comp'];
    $ser_ncre = $_REQUEST['d_serie'];
	$fecha_emision2 = $_REQUEST['fecha_emision2'];
	$egre_descripcion= $_REQUEST['egre_descripcion'];
	$cod_proveedor = $_REQUEST['cod_proveedor'];


	
	$serie1 =  $_REQUEST['serie1'];
	$numdoc1 = $_REQUEST['numdoc1'];
	$fecha_emision1 = $_REQUEST['fecha_emision1'];
	$serie2 = $_REQUEST['serie2'];
	$numdoc2 = $_REQUEST['numdoc2'];
	$select_doc = $_REQUEST['select_doc'];
	$doic = $_REQUEST['doic'];
	$telefono = $_REQUEST['telefono'];
	$nom_cliente = strtoupper($_REQUEST['nom_cliente']);
	$direccion = $_REQUEST['direccion'];
	$slc_tippag = $_REQUEST['slc_tippago'];
	$slc_area = $_REQUEST['slc_area'];
	$slc_usuario = $_REQUEST['slc_usuario'];
	

$subtotal = $_REQUEST['subtotal'];
	$igv = $_REQUEST['igv'];
	$total = $_REQUEST['total'];

	
	


	$consulta_idregventas = "SELECT CONCAT(YEAR(NOW()),REPEAT('0',6-LENGTH((MAX(CAST(RIGHT(tb_egreso.c_c_egreso,6) AS DECIMAL))+1))),
	(MAX(CAST(RIGHT(tb_egreso.c_c_egreso,6) AS DECIMAL))+1)) AS c_c_egreso FROM tb_egreso";
	
	$resultado_idregventas = mysql_query($consulta_idregventas, $conexion);
	
	$row_idregventas = mysql_fetch_array($resultado_idregventas);
	
	$new_idregventas = $row_idregventas[0];
	
		if($new_idregventas == '')
		{
			$new_idregventas =  date('Y').'000001';
		}
		
		if($new_idregventas != '')
		{
			$id_regventas = $new_idregventas;
		}
		
		$id_regventas =  $id_regventas;
		
	// verficar si existe
	
	
	$sql_buscardoc = "SELECT c_c_egreso from tb_egreso where='$id_regventas'";
	
	$resultado_buscardoc = mysql_query($sql_buscardoc, $conexion);
	
	$existe_doc = mysql_num_rows($resultado_buscardoc);
	
	if($existe_doc==0){
	

	$sql_insertregventas = "INSERT INTO tb_egreso(c_c_egreso,c_tipo_documento,c_participante,ddt_fecha,c_numero_comprobante,d_monto,b_estado) VALUES ('$id_regventas', '$tip_comp','$cod_proveedor','$fecha_emision1','$ser_ncre',$total,'1')";
								
		$resultado_insertregventas = mysql_query($sql_insertregventas, $conexion);
		
		
	$sql_insertdetventas = "INSERT INTO tb_detalle_egreso (c_c_egreso,n_monto,c_descripcion) VALUES ('$id_regventas', $total,'$egre_descripcion')";
								
			$resultado_insertdetventas = mysql_query($sql_insertdetventas, $conexion);					
	
	
		$arr_ventas[0] = "Se guardo satisfactoriamente";
		$arr_ventas[1] = $id_regventas;
		$arr_ventas[2] = "true";
		echo json_encode($arr_ventas);
		
	}else{
		$arr_ventas[3] = "El comprobante ya exite";
		echo json_encode($arr_ventas);
	}
	
	
	

?>