<?php
include('../../conexion.php');

$id_viaje  = $_POST["id_viaje"];
$num_kardex  = $_POST["num_kardex"];
$fecha_crono = $_POST["fecha_crono"];
$num_formu = $_POST["num_formu"];

//guarda el cronologico.
$busnumkardex = "SELECT CONCAT(YEAR(NOW()),REPEAT('0',6-LENGTH((MAX(CAST(RIGHT(permi_viaje.num_kardex,6) AS DECIMAL))+1))),
(MAX(CAST(RIGHT(permi_viaje.num_kardex,6) AS DECIMAL))+1)) AS numkardex FROM permi_viaje WHERE swt_est='' OR ISNULL(swt_est) ";

$numkarbus = mysql_query($busnumkardex,$conn) or die(mysql_error());
$rownum = mysql_fetch_array($numkarbus);
$newnumkar  = $rownum[0];

if($newnumkar == '')
{
	$new_num_kar = date("Y").'000001';
}
else if($newnumkar != '')
{
	$new_num_kar = $newnumkar;
}

	$updatepermiviaje="UPDATE permi_viaje SET num_kardex = '$new_num_kar', fecha_crono = STR_TO_DATE('$fecha_crono','%d/%m/%Y'), num_formu = '$num_formu' WHERE permi_viaje.id_viaje = '$id_viaje'";
	
	echo "<input name='muestraCodkar' id='muestraCodkar' readonly='readonly' type='hidden' value='".$new_num_kar."' style='font-family:Calibri; font-size:20px; color:#003366; border:none;' 																																																										size='8'>";
	
	// Muestra el ID en la forma:  000001-2013
	$numkarE = $new_num_kar;
	$numkar3 = substr($numkarE,5,6).'-'.substr($numkarE,0,4);
	echo "<input name='num_crono' id='num_crono' readonly='readonly' type='text' value='".$numkar3."' style='font-family:Calibri; font-size:20px; color:#003366; border:none;' size='8'>";

	mysql_query($updatepermiviaje,$conn) or die(mysql_error());
    mysql_close($conn);

?>


