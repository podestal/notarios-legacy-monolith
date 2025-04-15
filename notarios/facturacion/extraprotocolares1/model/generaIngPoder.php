<?php
include('../../conexion.php');

$id_poder    = $_POST["id_poder"];

$num_kardex    = $_POST["num_kardex"];
$num_formu     = $_POST["num_formu"];
$fec_crono     = $_POST["fecha_crono"];

// NUM_KARDEX AUTOGENERADO:

$busnumkardex = "SELECT CONCAT(YEAR(NOW()),REPEAT('0',6-LENGTH((MAX(CAST(RIGHT(ingreso_poderes.num_kardex,6) AS DECIMAL))+1))),
(MAX(CAST(RIGHT(ingreso_poderes.num_kardex,6) AS DECIMAL))+1)) AS numkar FROM ingreso_poderes WHERE swt_est='' OR ISNULL(swt_est) ";

$numkarbus = mysql_query($busnumkardex,$conn) or die(mysql_error());
$rownum = mysql_fetch_array($numkarbus);
$newnumkar  = $rownum[0];

if($newnumkar == '')
{
	$new_num_kar = date('Y').'000001';
}
else if($newnumkar != '')
{
	$new_num_kar = $newnumkar;
}

$updatepoderes = "UPDATE ingreso_poderes SET num_kardex = '$new_num_kar', fec_crono = STR_TO_DATE('$fec_crono','%d/%m/%Y'), num_formu = '$num_formu'  WHERE id_poder = '$id_poder'";

echo "<input name='muestraCodkar' id='muestraCodkar' readonly='readonly' type='hidden' value='".$new_num_kar."' style='font-family:Calibri; font-size:20px; color:#003366; border:none;' size='8'>";

// Muestra el ID en la forma:  000001-2013
$numkar = $new_num_kar;
$numkar2 = substr($numkar,4,6).'-'.substr($numkar,0,4);

echo "<input name='num_crono' id='num_crono' type='text' value='".$numkar2."' style='font-family:Calibri; font-size:24px; color:#003366; border:none;' size='8'>";

mysql_query($updatepoderes, $conn) or die(mysql_error());
	
mysql_close($conn);

?>


