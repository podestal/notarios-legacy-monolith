<?php 
session_start();
include("conexion.php");
$pass=strtoupper($_POST['pass']);
$idusuario=$_SESSION["id_usu"];
mysql_query("update usuarios set password='$pass' where idusuario='$idusuario'", $conn) or die(mysql_error());
?>
<script language="javascript"> alert('Cambio de clave satisfactorio');
</script>