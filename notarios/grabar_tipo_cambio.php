<?php 
include("conexion.php");

$tip_cambio=$_POST['tip_cambio'];
$fecha=$_POST['fecha'];

$sql="INSERT INTO tipocambio (idtipocamb,tipocambio,fecha) VALUES (NULL,'$tip_cambio','$fecha')";
mysql_query($sql,$conn) or die(mysql_error());
?>
<script language='javascript'>alert('El tipo de cambio se grabo satisfactoriamente');</script>
<script type="text/javascript">window.location="http://jvwebdesigner.com/fernando/notarios/tipo_cambio.php";</script> 

