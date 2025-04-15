<?php
include('../../conexion.php');

$id_viaje        = $_POST["id_viaje"];
//$id_contratante  = $_POST["id_contratante"];
$c_codcontrat    = $_POST["c_codcontrat"];

$apepatexto=strtoupper($_POST['c_descontrat']);
$cabioapostroa=str_replace("'","?",$apepatexto);
$c_descontrat=strtoupper($cabioapostroa);

$c_fircontrat    = $_POST["c_fircontrat"];
$c_condicontrat  = $_POST["c_condicontrat"];

$edad			 = $_POST["edad"];
$condi_edad		 = $_POST["condi_edad"];
// NUEVO PARA TESTIGO
$codi_testigo	 = $_POST["codi_testigo"];
$codi_tiptestigo = $_POST["codi_tiptestigo"];


// NUEVO PARA APODERADO
$codi_apoderado   = $_POST["codi_apoderado"];
$partida_numero   = $_POST["partida_numero"];
$sede_registral_a = $_POST["sede_registral_a"];


$saveviajecontratante = "INSERT INTO viaje_contratantes(id_viaje, id_contratante, c_codcontrat, c_descontrat, c_fircontrat, c_condicontrat, edad, condi_edad, codi_testigo, tip_incapacidad, codi_podera, partida_e, sede_regis)
VALUES ('$id_viaje', NULL , '$c_codcontrat', '$c_descontrat', '$c_fircontrat', '$c_condicontrat', '$edad', '$condi_edad', '$codi_testigo', '$codi_tiptestigo', '$codi_apoderado', '$partida_numero', '$sede_registral_a' )";
mysql_query($saveviajecontratante, $conn) or die(mysql_error());

// ACTUALIZA LOS NUEVOS DATOS: partida_e, sede_regis 
//$saveAdicionalViaje = "UPDATE permi_viaje SET permi_viaje.partida_e = '$partida_numero', permi_viaje.sede_regis = '$sede_registral_a' WHERE permi_viaje.id_viaje = '$id_viaje'";
//mysql_query($saveAdicionalViaje, $conn) or die(mysql_error());

mysql_close($conn);
?>
