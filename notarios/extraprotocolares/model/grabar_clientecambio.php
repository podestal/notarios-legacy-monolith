<?php
include('../../conexion.php');


$id_cambio 				 = $_POST["id_cambio"];
$id_cambio2              = intval($_POST["id_cambio"]);

$apepatexto=strtoupper($_POST['nombre']);
$cabioapostroa=str_replace("'","?",$apepatexto);
$nombre=strtoupper($cabioapostroa);

$tipdoc					 = $_POST["tipdoc"];
$num_docu				 = $_POST["num_docu"];

$direccionp=strtoupper($_POST['direccion']);
$cabioapostroa=str_replace("'","?",$direccionp);
$direccion=strtoupper($cabioapostroa);


$ecivil					 = $_POST["ecivil"];

$representacionp=strtoupper($_POST['representante']);
$cabioapostroa=str_replace("'","?",$representacionp);
$representacion=strtoupper($cabioapostroa);


$poder_inscrito			 = $_POST["poder_inscrito"];
$int_legitimo			 = $_POST["int_legitimo"];

$distrito_solic			 = $_POST["distrito_solic"];
$numdoc_rep			 	 = $_POST["numdoc_rep"];
$tipdoc_rep				 = $_POST["tipdoc_rep"];
	
$grabaclientecambios = "INSERT INTO ccaracter_solicitantes
(id_cambio, id_solicitante, tipdoc_solicitante, numdocu_solicitante,
 descri_solicitante, domic_solicitante, ecivil_solicitante ,
 swt_solicitante ,representante ,poder_inscrito ,tercero, ubigeo,tipdoc_representante,numdocu_representante)
VALUES 
('$id_cambio2',NULL,'$tipdoc','$num_docu','$nombre','$direccion','$ecivil',NULL,
'$representacion','$poder_inscrito','$int_legitimo', '$distrito_solic','$tipdoc_rep','$numdoc_rep')";
mysql_query($grabaclientecambios,$conn) or die(mysql_error());



?>