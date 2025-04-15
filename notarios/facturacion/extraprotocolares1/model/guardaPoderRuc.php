<?php
include('../../conexion.php');

$id_poder        = $_POST["id_poder"];
$id_contrata     = $_POST["id_contrata"];
$c_codcontrat    = $_POST["c_codcontrat"];
$c_descontrat    = $_POST["c_descontrat"];
$c_fircontrat    = $_POST["c_fircontrat"];
$c_condicontrat  = $_POST["c_condicontrat"];

$codi_asegurado	 = "";

$savepodercontratante = "INSERT INTO poderes_contratantes(id_poder, id_contrata, c_codcontrat, c_descontrat, c_fircontrat, c_condicontrat, codi_asegurado) VALUES('$id_poder', NULL, '$c_codcontrat', '$c_descontrat', '$c_fircontrat', '$c_condicontrat', '$codi_asegurado')";

mysql_query($savepodercontratante, $conn) or die(mysql_error());
mysql_close($conn);
?>
