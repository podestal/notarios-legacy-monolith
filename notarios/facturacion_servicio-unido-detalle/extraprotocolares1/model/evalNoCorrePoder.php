<?php
include('../../conexion.php');

$id_poder = $_POST["id_poder"];

$updatepoder = "UPDATE ingreso_poderes SET ingreso_poderes.swt_est= 'NC' WHERE ingreso_poderes.id_poder = '$id_poder'";
mysql_query($updatepoder,$conn) or die(mysql_error());
mysql_close($conn);
?>


