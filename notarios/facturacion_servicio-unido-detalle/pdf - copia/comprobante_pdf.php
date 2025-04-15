<?php

	include("conexion.php");
	include("../../extraprotocolares/view/funciones.php");

	$id_regventas  = $_REQUEST['id_regventas'];
	$conexion = conection();

	$sql_cuentas = "SELECT
					m_regventas.concepto AS concepto,
					m_regventas.fecha AS fecha,
					m_regventas.num_docu AS doic,
					d_regventas.id_regventas AS id_regventas,
					d_regventas.cantidad AS cantidad,
					d_regventas.detalle AS detalle,
					d_regventas.precio AS precio,
					m_regventas.subtotal AS subtotal,
					m_regventas.impuesto AS impuesto,
					m_regventas.imp_total AS total
					FROM
					d_regventas
					Inner Join m_regventas ON d_regventas.id_regventas = m_regventas.id_regventas
					where d_regventas.id_regventas ='$id_regventas'";
	
    $datos_cuentas = mysql_query($sql_cuentas, $conexion);	
    $dato_cuentas_cli = mysql_fetch_array($datos_cuentas);
   
    while($dato_cuentas = mysql_fetch_array($datos_cuentas)){
		
	      
	}

	

?>