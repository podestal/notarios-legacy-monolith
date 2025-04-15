<?php
include('../../conexion.php');


$id_cambio 				 = $_POST["id_cambio"];
$id_cambio2              = intval($_POST["id_cambio"]);
$nombre     			 = $_POST["nombre"];
$tipdoc					 = $_POST["tipdoc"];
$num_docu				 = $_POST["num_docu"];
$direccion			   	 = $_POST["direccion"];
$ecivil					 = $_POST["ecivil"];
$representacion			 = $_POST["representacion"];
$poder_inscrito			 = $_POST["poder_inscrito"];
$int_legitimo			 = $_POST["int_legitimo"];


$grabaclientecambios = 
"UPDATE ccaracter_solicitantes SET  tipdoc_solicitante = '$tipdoc', numdocu_solicitante = '$num_docu',
 descri_solicitante = '$nombre', 
domic_solicitante = '$direccion', ecivil_solicitante = '$ecivil', representante = '$representacion', poder_inscrito = '$poder_inscrito',
 tercero = '$int_legitimo'
WHERE ccaracter_solicitantes.id_cambio = '$id_cambio'";
mysql_query($grabaclientecambios,$conn) or die(mysql_error());



?>