<?php
include('../../conexion.php');

$id_cambio         = $_POST["id_cambio"];
$id_solicitante    = $_POST["id_solicitante"];
$nombre0           = strtoupper($_POST['nombre']);
$nombre1           = str_replace("'","?",$nombre0);
$nombre            = strtoupper($nombre1);
$tipdoc  		   = strtoupper($_POST["tipdoc"]);
$num_docu 		   = $_POST["num_docu"];
$direccion0        = strtoupper($_POST['direccion']);
$direccion1        = str_replace("'","?",$direccion0);
$direccion         = strtoupper($direccion1);
$ecivil            = $_POST["ecivil"];
$representacion0   = strtoupper($_POST['representacion']);
$representacion1   = str_replace("'","?",$representacion0);
$representacion    = strtoupper($representacion1);
$poder_inscrito    = $_POST["poder_inscrito"];
$int_legitimo      = $_POST["int_legitimo"];
$tipdoc_repedit      = $_POST["tipdoc_repedit"];
$numdocu_repedit      = $_POST["numdocu_repedit"];


# new segun requerimiento
$distrito_solic    = $_POST["distrito_solic"];


$updateviajecontratante =
"UPDATE ccaracter_solicitantes SET
 ccaracter_solicitantes.descri_solicitante = '$nombre', 
 ccaracter_solicitantes.tipdoc_solicitante = '$tipdoc', 
 ccaracter_solicitantes.numdocu_solicitante = '$num_docu', 
 ccaracter_solicitantes.domic_solicitante = '$direccion',
 ccaracter_solicitantes.ecivil_solicitante = '$ecivil', 
 ccaracter_solicitantes.representante = '$representacion' ,
 ccaracter_solicitantes.poder_inscrito = '$poder_inscrito' ,
 ccaracter_solicitantes.tercero = '$int_legitimo',
 ccaracter_solicitantes.ubigeo = '$distrito_solic',
 ccaracter_solicitantes.tipdoc_representante = '$tipdoc_repedit', 
 ccaracter_solicitantes.numdocu_representante = '$numdocu_repedit'
 WHERE ccaracter_solicitantes.id_cambio = '$id_cambio' 
 AND ccaracter_solicitantes.id_solicitante = '$id_solicitante'";
mysql_query($updateviajecontratante, $conn) or die(mysql_error());
mysql_close($conn);
?>
