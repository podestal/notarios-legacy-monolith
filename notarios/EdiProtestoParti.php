<?php
include('conexion.php');

$id_poder        = $_POST["id_poder"];
$id_contrata     = $_POST["id_contrata"];
$c_codcontrat    = $_POST["c_codcontrat"];

$apepatexto=strtoupper($_POST['c_descontrat']);
$cabioapostroa=str_replace("'","?",$apepatexto);
$c_descontrat=strtoupper($cabioapostroa);

$c_fircontrat    = $_POST["c_fircontrat"];
$c_condicontrat  = $_POST["c_condicontrat"];

$savepodercontratante = "UPDATE protesto_participantes SET num_docparti = '$c_codcontrat', descri_parti = '$c_descontrat',  tip_condi = '$c_condicontrat' WHERE id_protesto = '$id_poder' AND id_participante = '$id_contrata'";

mysql_query($savepodercontratante, $conn) or die(mysql_error());
mysql_close($conn);
?>
