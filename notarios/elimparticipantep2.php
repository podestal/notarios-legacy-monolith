<?php
include('conexion.php');

$id_poder = $_POST["id_poder"];
$id_contrata = $_POST["id_contrata"];
$anio = $_POST["anio"];
$elimpcontratantes = "DELETE FROM protesto_participantes WHERE protesto_participantes.id_protesto = '$id_poder' AND protesto_participantes.id_participante = '$id_contrata' and protesto_participantes.anio='$anio'";
mysql_query($elimpcontratantes,$conn) or die(mysql_error());
mysql_close($conn);

?>