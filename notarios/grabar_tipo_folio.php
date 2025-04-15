<?php 
include("conexion.php");

$des_folio=$_POST['des_folio'];


$sql="INSERT INTO tipofolio (idtipfol,destipfol) VALUES (NULL,'$des_folio')";
mysql_query($sql,$conn) or die(mysql_error());
?>
<script language='javascript'>alert('El tipo de folio se grabo satisfactoriamente');</script>
<script type="text/javascript">window.location="http://jvwebdesigner.com/fernando/notarios/tipo_folio.php";</script> 

