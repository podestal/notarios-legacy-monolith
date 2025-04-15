<?php
include('../../conexion.php');

$id_cambio   = $_POST["id_cambio"];
$detalle     = $_POST["detalle"];

$consulkar = mysql_query("SELECT id_dato from det_cambiocarac WHERE id_cambio = '$id_cambio' AND id_dato = '$detalle'", $conn) or die(mysql_error());
$rowkar    = mysql_fetch_array($consulkar);
$rowcambio = $rowkar[0];

if($detalle == $rowkar[0])
{ 
echo "<div class='ui-state-error' style='font-family: Calibri; font-style: italic; font-size: 14px;'><center>No puede agregar la misma caracteristica</center></div>";
}
else 
{
$savedetcambioc = "INSERT INTO det_cambiocarac(id_cambio, id_dato, descripcion) VALUES('$id_cambio', '$detalle', '')";
mysql_query($savedetcambioc, $conn) or die(mysql_error());

echo "<div></div>";

}
mysql_close($conn);
?>
