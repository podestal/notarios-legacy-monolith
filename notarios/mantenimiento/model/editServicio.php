<?php
include('../../conexion.php');
	$codigoservi = $_POST['codigoservi'];
	$descriservi = $_POST['descriservi'];
	$tiposervi = $_POST['tiposervi'];
	$precio1 = $_POST['precio1'];
	$abrevservi = $_POST['abrevservi'];
	$precio2 = $_POST['precio2'];
	$gruposervi = $_POST['gruposervi'];
	$porcenservi = $_POST['porcenservi'];
	$kardexservi = $_POST['kardexservi'];
	$infservi = $_POST['infservi'];
	$actiservi = $_POST['actiservi'];
	$areaservi = $_POST['areaservi'];
	$serarea = $_POST['serarea'];
	

$grabcertidom = "UPDATE servicios SET descrip='$descriservi',tipo='$tiposervi',abrev='$abrevservi',grupo='$gruposervi',precio1='$precio1',precio2='$precio2',porcentaje='$porcenservi',kardex='$kardexservi',infrrpp='$infservi',activo='$actiservi',area1='$areaservi',serarea='$serarea' WHERE servicios.codigo='$codigoservi'";

mysql_query($grabcertidom,$conn) or die(mysql_error());
mysql_close($conn);
?>


