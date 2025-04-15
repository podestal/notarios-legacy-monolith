<?php 
include("conexion.php");

$idusuario=$_POST['idusuario'];
$clave=strtoupper($_POST['clave']);


$sql="UPDATE usuarios set password='$clave' WHERE idusuario='$idusuario'"; 
mysql_query($sql,$conn) or die(mysql_error());

?>
<script language='javascript'>alert('Cambio de clave satisfactoria');</script>
<script type="text/javascript">window.location="new_usuarios.php"; </script>