<?php
include('../../conexion.php');

$id_viaje       = $_POST["id_viaje"];
$id_contratante = $_POST["id_contratante"];
$c_codcontrat   = $_POST["c_codcontrat"];

$apepatexto=strtoupper($_POST['c_descontrat']);
$cabioapostroa=str_replace("'","?",$apepatexto);
$c_descontrat=strtoupper($cabioapostroa);

$c_fircontrat   = $_POST["c_fircontrat"];
$c_condicontrat = strtoupper($_POST["c_condicontrat"]);

$edad_menor     = $_POST["edad_menor"];
$condi_edad     = $_POST["condi_edad"];

$codi_apoderado   = $_POST["codi_apoderado"];
$partida_numero   = $_POST["partida_numero"];
$sede_registral_a = $_POST["sede_registral_a"];

$updateviajecontratante = "UPDATE viaje_contratantes SET viaje_contratantes.c_codcontrat = '$c_codcontrat', viaje_contratantes.c_descontrat = '$c_descontrat', 
viaje_contratantes.c_fircontrat = '$c_fircontrat', viaje_contratantes.c_condicontrat = '$c_condicontrat', viaje_contratantes.edad = '$edad_menor', viaje_contratantes.condi_edad = '$condi_edad' ,codi_podera = '$codi_apoderado' , partida_e = '$partida_numero', sede_regis='$sede_registral_a' WHERE viaje_contratantes.id_viaje = '$id_viaje' AND viaje_contratantes.id_contratante = '$id_contratante'";
mysql_query($updateviajecontratante, $conn) or die(mysql_error());
mysql_close($conn);
?>
