<?php
include('../../conexion.php');

$id_viaje = $_POST["id_viaje"];

$updatepviaje = "UPDATE permi_viaje SET permi_viaje.swt_est= 'NC' WHERE permi_viaje.id_viaje = '$id_viaje'";
mysql_query($updatepviaje,$conn) or die(mysql_error());
mysql_close($conn);
?>


