<?php
include('../../conexion.php');

$id_viaje    = $_POST["id_viaje"];

/*
num_formu  NUMERO DE PAPEL
num_crono  NUMERO CRONOLOGICO
fecha_crono FECHA 
*/

$num_formu     = $_POST["num_formu"];
$num_kardex    = $_POST["num_crono"];
$fec_crono     = $_POST["fecha_crono"];


$num_arr=explode('-', $num_kardex);
$num_kardex=$num_arr[1].str_pad($num_arr[0], 6,'0',STR_PAD_LEFT);

$fecha=explode('/', $fec_crono);
$fec_crono=$fecha[2].'-'.$fecha[1].'-'.$fecha[0];


$updatepoderes = "UPDATE permi_viaje SET num_kardex = '$num_kardex', fecha_crono = '$fec_crono', num_formu = '$num_formu'  WHERE id_viaje = '$id_viaje'";

mysql_query($updatepoderes, $conn) or die(mysql_error());
	
mysql_close($conn);

?>

