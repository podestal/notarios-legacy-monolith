<?php 

include("conexion.php");

$cod_bien=$_POST['cod_bien'];
$des_Tipobien=$_POST['des_Tipobien'];

$sql="INSERT INTO tipobien (idtipbien,codbien,desbien) VALUES (NULL,'$cod_bien','$des_Tipobien')";
mysql_query($sql,$conn) or die(mysql_error());

?>

<script language='javascript'>alert('El tipo de bien se grabo satisfactoriamente');</script>
<script type="text/javascript">window.location="http://jvwebdesigner.com/fernando/notarios/tipo_bien.php"; </script> 

