<?php
include('conexion.php');

$id_poder        = $_POST["id_poder"];
$id_contrata     = $_POST["id_contrata"];
$fec_ingreso    = $_POST["fec_ingreso"];

$dato = explode("/", $fec_ingreso); 

$anio=$dato[2];




$c_codcontrat    = $_POST["c_codcontrat"];
$c_descontrat    = $_POST["c_descontrat"];
$c_condicontrat  = $_POST["c_condicontrat"];


$savepodercontratante = "INSERT INTO protesto_participantes(id_protesto,id_participante,num_docparti,descri_parti,tip_condi,anio)
 VALUES ('$id_poder ',NULL,'$c_codcontrat','$c_descontrat','$c_condicontrat','$anio')";
mysql_query($savepodercontratante, $conn) or die(mysql_error());
mysql_close($conn);
?>
