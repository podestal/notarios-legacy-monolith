<?php 
include("conexion.php");

$des_contra=$_POST['des_contra'];
$tip_karx=$_POST['tip_karx'];

$sql="INSERT INTO tipocontratante (idtipocont,descon,idtipkar) VALUES (NULL,'$des_contra','$tip_karx')";
mysql_query($sql,$conn) or die(mysql_error());

?>
<script language='javascript'>alert('El tipo de contratante se grabo satisfactoriamente');</script>
<script type="text/javascript">window.location="http://jvwebdesigner.com/fernando/notarios/tipo_contratante.php"; </script> 

