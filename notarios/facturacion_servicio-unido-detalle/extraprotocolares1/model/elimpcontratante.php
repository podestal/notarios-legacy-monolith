<?php
include('../../conexion.php');

$id_poder = $_POST["id_poder"];
$id_contrata = $_POST["id_contrata"];

$elimpcontratantes = "DELETE FROM poderes_contratantes WHERE poderes_contratantes.id_poder = '$id_poder' AND poderes_contratantes.id_contrata = '$id_contrata'";
mysql_query($elimpcontratantes,$conn) or die(mysql_error());
mysql_close($conn);

?>