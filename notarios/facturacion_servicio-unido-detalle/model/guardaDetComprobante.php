<?php
include('../../conexion.php');

$id_regventas  = $_POST["id_regventas"];
$codigo		   = $_POST["codigo"];
$serie		   = $_POST["serie"];
$documento	   = $_POST["documento"];
$tipo_docu	   = $_POST["tipo_docu"];
$kardex		   = $_POST["kardex"];
$detalle       = $_POST["detalle"];
$precio		   = $_POST["precio"];
$cantidad	   = $_POST["cantidad"];
$grupo		   = $_POST["grupo"];
$monedatipo	   = $_POST["monedatipo"];
$monto_igv	   = $_POST["monto_igv"];
$grupempl	   = $_POST["grupempl"];
$total	       = $_POST["total"];
$detalle_fac   = $_POST["detalle_fac"];

$savedetcomprobante = "INSERT INTO d_regventas(id_regventas, codigo, serie, documento, tipo_docu, kardex, detalle, precio, cantidad, grupo, monedatipo, monto_igv, grupempl, total, detalle_fac) VALUES('$id_regventas', '$codigo', '$serie', '$documento', '$tipo_docu', '$kardex', '$detalle', '$precio', '$cantidad', '$grupo', '$monedatipo', '$monto_igv', '$grupempl', '$total', '$detalle_fac')";
mysql_query($savedetcomprobante, $conn) or die(mysql_error());

mysql_close($conn);
?>