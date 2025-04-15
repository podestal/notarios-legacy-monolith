<?php
include('conexion.php');

$id_poder        = $_POST["id_poder"];
echo"hola".$id_poder;
$id_contrata     = $_POST["id_contrata"];
$c_codcontrat    = $_POST["c_codcontrat"];

$apepatexto=strtoupper($_POST['c_descontrat']);
$cabioapostroa=str_replace("'","?",$apepatexto);
$c_descontrat=strtoupper($cabioapostroa);

$c_condicontrat  = $_POST["c_condicontrat"];
$direccion = $_POST["direccion"];

$fec_ingreso    = $_POST["fec_ingreso"];

$dato = explode("/", $fec_ingreso); 

$anio=$dato[2];



$savepodercontratante = "INSERT INTO protesto_participantes(id_protesto,id_participante,num_docparti,descri_parti,tip_condi,direccion,anio)
 VALUES ('$id_poder ',NULL,'$c_codcontrat','$c_descontrat','$c_condicontrat','$direccion','$anio')";

mysql_query($savepodercontratante, $conn) or die(mysql_error());
mysql_close($conn);

?>
