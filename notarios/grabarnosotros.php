<?php

include('conexion.php');
$misi=$_POST['pagmisi'];
$sql2 = "update paginas set despagina='".$misi."'WHERE idpagina='13'";
mysql_query($sql2,$conn) or die(mysql_error());

?>
<script language='javascript'>alert('Se modifico Satisfactoriamente');</script> 
<script type="text/javascript">window.location="modificarnosotros.php"; </script>