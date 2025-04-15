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

$savepodercontratante = "UPDATE poderes_contratantes SET c_codcontrat = '$c_codcontrat', c_descontrat = '$c_descontrat', c_fircontrat = '$c_fircontrat', c_condicontrat = '$c_condicontrat' WHERE id_poder = '$id_poder' AND id_contrata = '$id_contrata'";

mysql_query($savepodercontratante, $conn) or die(mysql_error());
mysql_close($conn);
?>
