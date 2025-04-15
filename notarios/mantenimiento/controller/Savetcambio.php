<?php 

include("../../conexion.php");
	$fecha_tcambio		= $_POST['fecha_tcambio'];
	$tcambio_dol 		= $_POST['tcambio_dol'];
	$tcambio_eur 	    = $_POST['tcambio_eur'];


	// busca si la fecha existe : 
	$busfecha_tcambio = "SELECT DATE_FORMAT(tipocambio.tc_fecha,'%d/%m/%Y') AS 'fecha_busqueda' FROM tipocambio WHERE DATE_FORMAT(tipocambio.tc_fecha,'%Y-%m-%d') = STR_TO_DATE('$fecha_tcambio','%d/%m/%Y')";
	$fecha_tc = mysql_query($busfecha_tcambio,$conn) or die(mysql_error());
	$fec = mysql_fetch_array($fecha_tc);
	$newfecha_tc  = $fec[0];
	
	// si no se encuentra registrada la fecha :
	if($newfecha_tc == '')
	{
		$grabatcambio = "INSERT INTO tipocambio(idtipocamb , tc_dol , tc_eur, tc_fecha, swt_activo) VALUES (NULL, $tcambio_dol, $tcambio_eur, str_to_date('$fecha_tcambio','%d/%m/%Y'), '1')";
		mysql_query($grabatcambio,$conn) or die(mysql_error());
	}
	
	// actualiza la fecha del tipo de cambio : 
	else if($newfecha_tc != '')
	{
		$updatetcambio = "UPDATE tipocambio SET tc_dol = $tcambio_dol, tc_eur = $tcambio_eur WHERE DATE_FORMAT(tipocambio.tc_fecha,'%Y-%m-%d') = STR_TO_DATE('$fecha_tcambio','%d/%m/%Y')";
		mysql_query($updatetcambio,$conn) or die(mysql_error());
	}

?>