<?php
include('../../conexion.php');

$id_supervivencia = $_POST["id_supervivencia"];

$elimsupervivencia="DELETE FROM cert_supervivencia WHERE cert_supervivencia.id_supervivencia = '$id_supervivencia' AND swt_capacidad = 'C'";
mysql_query($elimsupervivencia,$conn) or die(mysql_error());
mysql_close($conn);

?>