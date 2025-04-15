<?php
include('../../conexion.php');
	
	$codigoservi  = $_POST['codigoservi'];
	$descriservi  = strtoupper($_POST['descriservi']);
	$tiposervi    = $_POST['tiposervi'];
	$precio1      = $_POST['precio1'];
	$abrevservi   = $_POST['abrevservi'];
	$precio2      = $_POST['precio2'];
	$gruposervi   = $_POST['gruposervi'];
	$porcenservi  = $_POST['porcenservi'];
	$kardexservi  = $_POST['kardexservi'];
	$infservi     = $_POST['infservi'];
	$actiservi    = $_POST['actiservi'];
	$areaservi    = $_POST['areaservi'];
	$serarea      = $_POST['serarea'];
	
	$ctaserv      = $_POST['ctaserv'];



// verifica la existendia del numero de carta, sino edita

if($codigoservi =='')
	{
	// se arma el numero de la carta  formato:  'año + 000001';
	$buscodigo   = "SELECT CONCAT(REPEAT('0',4-LENGTH((MAX(CAST(RIGHT(servicios.codigo,4) AS DECIMAL))+1))),(MAX(CAST(RIGHT(servicios.codigo,4) AS DECIMAL))+1)) AS codigo FROM servicios";
	$numcartabus = mysql_query($buscodigo,$conn) or die(mysql_error());
	$rownum      = mysql_fetch_array($numcartabus);
	$codigoo     = $rownum[0];
	
	echo "<input name='codigoservi' id='codigoservi' readonly='readonly' type='text' value='".$codigoo."' style='font-family:Calibri; font-size:16px; color:#003366; border:none;' size='8'>";
	
	########
	if($porcenservi==''){
	$grabacartas = "INSERT INTO servicios(id_servicio,codigo,descrip,tipo,abrev,grupo,precio1,precio2,porcentaje,kardex,infrrpp,activo,area1,serarea)
	VALUES(NULL,'$codigoo','$descriservi','$tiposervi','$abrevservi','$gruposervi','$precio1','$precio2',0,
	'$kardexservi','$infservi','$actiservi','$areaservi','$serarea')";
	mysql_query($grabacartas,$conn) or die(mysql_error());
	}
	else{
		$grabacartas = "INSERT INTO servicios(id_servicio,codigo,descrip,tipo,abrev,grupo,precio1,precio2,porcentaje,kardex,infrrpp,activo,area1,serarea)
	VALUES(NULL,'$codigoo','$descriservi','$tiposervi','$abrevservi','$gruposervi','$precio1','$precio2','$porcenservi',
	'$kardexservi','$infservi','$actiservi','$areaservi','$serarea')";
	mysql_query($grabacartas,$conn) or die(mysql_error());
	}
}

# edicion
if($codigoservi!= '')
{

$updatecarta="UPDATE servicios SET descrip='$descriservi',tipo='$tiposervi',abrev='$abrevservi',grupo='$gruposervi',precio1='$precio1',precio2='$precio2',porcentaje='$porcenservi',kardex='$kardexservi',infrrpp='$infservi',activo='$actiservi',area1='$areaservi',serarea='$serarea' WHERE servicios.codigo='$codigoservi'";
mysql_query($updatecarta,$conn) or die(mysql_error());

echo "<input name='codigoservi' id='codigoservi' readonly='readonly' type='text' value='".$codigoservi."' style='font-family:Calibri; font-size:16px; color:#003366; border:none;' size='8'>";
################
	
}
mysql_close($conn);

?>


