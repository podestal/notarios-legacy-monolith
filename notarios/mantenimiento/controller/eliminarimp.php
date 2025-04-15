<?php 
$codigo=$_GET['id_cliente'];
include("conexion.php");

$sqlquery = "DELETE FROM cliente WHERE idcliente ='$codigo'";
mysql_query($sqlquery, $conn);

?>
<script language='javascript'>alert('Registro eliminado correctamente');</script>
<script type="text/javascript">window.location="../view/ImpedidosVie.php"; </script> 