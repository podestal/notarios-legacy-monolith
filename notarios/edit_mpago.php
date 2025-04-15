<?php 
include("conexion.php");

$codkardex=$_POST['codkardex'];
$mediopago=$_POST['mediopago'];
$entidadfinanciera=$_POST['entidadfinanciera'];
$impmediopago=$_POST['impmediopago'];
$fechaoperacion=$_POST['fechaoperacion'];
$documentos=$_POST['documentos'];
$itemmpp=$_POST['itemmpp'];

mysql_query("INSERT INTO detallemediopago(detmp, itemmp, kardex, codmepag, idbancos, importemp, foperacion, documentos) VALUES (NULL,'$itemmpp','$codkardex','$mediopago','$entidadfinanciera','$impmediopago','$fechaoperacion','$documentos')", $conn) or die(mysql_error());

?>