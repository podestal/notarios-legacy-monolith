<?php 
include("conexion.php");

$idusuario=$_POST['idusuario'];
$loginusuario=$_POST['loginusuario'];
$apepat=strtoupper(str_replace("ñ","Ñ",$_POST['apepat']));
$apemat=strtoupper(str_replace("ñ","Ñ",$_POST['apemat']));
$prinom=strtoupper(str_replace("ñ","Ñ",$_POST['prinom']));
$segnom=strtoupper(str_replace("ñ","Ñ",$_POST['segnom']));
$fecnac=$_POST['fecnac'];
$domicilio=strtoupper(str_replace("ñ","Ñ",$_POST['domicilio']));
//$idubigeo=$_POST['idubigeo'];
$telefono=$_POST['telefono'];
$dni=$_POST['dni'];
$idcargo=intval($_POST['idcargo']);

$sql="UPDATE usuarios set loginusuario='$loginusuario', apepat='$apepat', apemat='$apemat', prinom='$prinom', segnom='$segnom', fecnac='$fecnac', domicilio='$domicilio', telefono='$telefono', idcargo='$idcargo', dni='$dni' WHERE idusuario='$idusuario'"; 
mysql_query($sql,$conn) or die(mysql_error());

?>
<script language='javascript'>alert('Actualización de usuario correcta');</script>
<script type="text/javascript">window.location="new_usuarios.php"; </script>