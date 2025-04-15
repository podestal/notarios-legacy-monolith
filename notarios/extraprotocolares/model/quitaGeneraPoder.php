<?php
include('../../conexion.php');

$id_poder    = $_POST["id_poder"];

//$num_kardex    = $_POST["num_kardex"];
$num_formu     = $_POST["num_formu"];
//$fec_crono     = $_POST["fecha_crono"];
/*
$updatepoderes = "UPDATE ingreso_poderes SET num_kardex = '', fec_crono = STR_TO_DATE('','%d/%m/%Y'), num_formu = ''  WHERE id_poder = '$id_poder'";
*/
$updatepoderes = "UPDATE ingreso_poderes SET  num_formu = '$num_formu'  WHERE id_poder = '$id_poder'";


/*echo "<input name='muestraCodkar' id='muestraCodkar'  type='hidden' value='' >";

echo "<input name='num_crono' id='num_crono' type='text' value='' style='font-family:Calibri; font-size:24px; color:#003366; border:none;' size='8'>";
*/
mysql_query($updatepoderes, $conn) or die(mysql_error());
	
mysql_close($conn);

?>

