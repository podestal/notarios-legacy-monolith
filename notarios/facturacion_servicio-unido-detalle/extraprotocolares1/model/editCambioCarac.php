<?php
include('../../conexion.php');

$id_cambio      = $_POST["id_cambio"];
$num_crono		= $_POST["num_crono"];
$fec_ingreso	= $_POST["fec_ingreso"];
$num_formu		= $_POST["num_formu"];
$nombre			= $_POST["nombre"];
$tipdoc			= $_POST["tipdoc"];
$num_docu		= $_POST["num_docu"];
$direccion		= $_POST["direccion"];
$ecivil			= $_POST["ecivil"];
$c_nombre		= $_POST["c_nombre"];
$c_tipdoc		= $_POST["c_tipdoc"];
$c_numdoc		= $_POST["c_numdoc"];
$representacion = $_POST["representacion"];
$poder_inscrito = $_POST["poder_inscrito"];
$int_legitimo 	= $_POST["int_legitimo"];



$updatecarta="UPDATE cambio_caracter SET fec_ingreso = STR_TO_DATE('$fec_ingreso','%d/%m/%Y'), num_formu = '$num_formu', nombre = '$nombre', tipdoc = '$tipdoc', num_docu = '$num_docu' ,
direccion = '$direccion' ,ecivil = '$ecivil' ,c_nombre = '$c_nombre' ,c_tipdoc = '$c_tipdoc' ,c_numdoc = '$c_numdoc', representacion = '$representacion', 
poder_inscrito = '$poder_inscrito', int_legitimo = '$int_legitimo' WHERE num_crono = '$num_crono'";
mysql_query($updatecarta,$conn) or die(mysql_error());
mysql_close($conn);
?>