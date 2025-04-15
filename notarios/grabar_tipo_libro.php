<?php 
include("conexion.php");

$cod_libro=$_POST['cod_libro'];
$deno_libro=$_POST['deno_libro'];

$sql="INSERT INTO tipolibro (idtiplib,coddlib,destiplib) VALUES (NULL,'$cod_libro','$deno_libro')";
mysql_query($sql,$conn) or die(mysql_error());
?>
<script language='javascript'>alert('El tipo de libro se grabo satisfactoriamente');</script>
<script type="text/javascript">window.location="http://jvwebdesigner.com/fernando/notarios/tipo_libro.php";</script> 