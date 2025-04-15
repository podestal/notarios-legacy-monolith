<?php
include('../../conexion.php');

$id_poder        = $_POST["id_poder"];
$id_contrata     = $_POST["id_contrata"];
$c_codcontrat    = $_POST["c_codcontrat"];

$apepatexto=strtoupper($_POST['c_descontrat']);
$cabioapostroa=str_replace("'","?",$apepatexto);
$c_descontrat=strtoupper($cabioapostroa);

$c_fircontrat    = $_POST["c_fircontrat"];
$c_condicontrat  = $_POST["c_condicontrat"];

$codi_asegurado	 = $_POST["codi_asegurado"];


$codi_testigo	 = $_POST["codi_testigo"];
$codi_tiptestigo = $_POST["codi_tiptestigo"];

$savepodercontratante = "INSERT INTO poderes_contratantes(id_poder, id_contrata, c_codcontrat, c_descontrat, c_fircontrat, c_condicontrat, codi_asegurado, codi_testigo, tip_incapacidad) VALUES('$id_poder', NULL, '$c_codcontrat', '$c_descontrat', '$c_fircontrat', '$c_condicontrat', '$codi_asegurado', '$codi_testigo', '$codi_tiptestigo')";

mysql_query($savepodercontratante, $conn) or die(mysql_error());
mysql_close($conn);

?>
