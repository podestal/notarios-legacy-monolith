<?php 

include("conexion.php");


$nombre     = strtoupper($_POST['nombre']);
$apellido   = strtoupper($_POST['apellido']);
$ruc        = strtoupper($_POST['ruc']);
$telefono   = $_POST['telefono'];
$direccion  = strtoupper($_POST['direccion']);
$distrito   = strtoupper($_POST['notariode']);
$codnotario = strtoupper($_POST['codnotario']);
$codoficial = strtoupper($_POST['codoficial']);
$coduif = strtoupper($_POST['coduif']);
$nombrenot   = strtoupper($_POST['nombrenot']);
$resolucion = strtoupper($_POST['resolucion']);
$inicio = strtoupper($_POST['inicio']);
$fin = strtoupper($_POST['fin']);


$email      = $_POST['correo'];


$grabarnota="UPDATE confinotario SET  nombre='$nombre', apellido='$apellido', ruc='$ruc', telefono='$telefono',
 correo='$email', distrito='$distrito', direccion='$direccion', codnotario='$codnotario', codoficial='$codoficial', 
 coduif='$coduif', notario='$nombrenot ', resolucion='$resolucion', fechainicio='$inicio', fechafin='$fin'  WHERE idnotar='1'"; 
mysql_query($grabarnota,$conn) or die(mysql_error());

?>

<script language='javascript'>alert('Actualizado satisfactoriamente');</script> 
