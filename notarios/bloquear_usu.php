<?php 
include("conexion.php");
$codigo=$_GET['idusu'];
$sql1="UPDATE usuarios SET estado='0' WHERE idusuario ='$codigo'";
mysql_query($sql1, $conn);
?>

<script language='javascript'>alert('El usuario se bloqueo satisfactoriamente');</script>
<script type="text/javascript">window.location="new_usuarios.php"; </script>